<?php

namespace App\Http\Controllers\Organization;

use App\DataTables\TicketDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\DepartmentRepository;
use App\Repositories\TicketRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    protected $ticket;

    public function __construct(TicketRepository $ticket)
    {
        $this->ticket = $ticket;
    }

    public function index(TicketDataTable $dataTable)
    {
        try {
            $data = [
                'open'     => $this->ticket->countByStatus('open'),
                'pending'  => $this->ticket->countByStatus('pending'),
                'answered' => $this->ticket->countByStatus('answered'),
                'close'    => $this->ticket->countByStatus('close'),
                'hold'     => $this->ticket->countByStatus('hold'),
            ];

            return $dataTable->render('backend.organization.ticket.index', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function create(DepartmentRepository $departmentRepository): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $data = [
                'departments' => $departmentRepository->activeDepartments(),
            ];

            return view('backend.organization.ticket.create', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }
        $request->validate([
            'department_id' => 'required',
            'subject'       => 'required',
            'first_name'    => 'required',
            'last_name'     => 'required',
            'email'         => 'required|email',
            'priority'      => 'required',
            'status'        => 'required',
        ]);

        try {
            $this->ticket->store($request->all());
            Toastr::success(__('create_successful'));

            return response()->json([
                'success' => __('create_successful'),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function show($id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $ticket = $this->ticket->find($id);

            $ticket->replies()->update(['viewed' => 1]);

            $data   = [
                'ticket'  => $ticket,
                'replies' => $ticket->replies,
            ];

            return view('backend.admin.support_system.ticket.reply', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        if (config('app.demo_mode')) {
            Toastr::info(__('this_function_is_disabled_in_demo_server'));

            return back();
        }
        try {
            $ticket = $this->ticket->find($id);
            $ticket->update($request->all());

            return redirect()->route('tickets.show', $id);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function reply(Request $request): \Illuminate\Http\JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }
        $request->validate([
            'reply' => 'required',
        ]);

        try {
            $this->ticket->reply($request->all());
            Toastr::success(__('reply_successful'));

            $data = [
                'success' => __('reply_successful'),
            ];

            if ($request->return_to_list == 1) {
                $data['route'] = route('tickets.index');
            }

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function replyEdit($id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {

            $data = [
                'reply' => $this->ticket->replyFind($id),
            ];

            return view('backend.admin.support_system.ticket.reply_edit', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function replyUpdate(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }
        $request->validate([
            'reply' => 'required',
        ]);

        try {
            $reply = $this->ticket->replyUpdate($request->all(), $id);

            Toastr::success(__('reply_updated'));

            $data  = [
                'success' => __('reply_updated'),
                'route'   => route('tickets.show', $reply->ticket_id),
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function replyDelete($id): \Illuminate\Http\JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status'  => 'danger',
                'message' => __('this_function_is_disabled_in_demo_server'),
                'title'   => 'error',
            ];

            return response()->json($data);
        }
        try {
            $this->ticket->replyDelete($id);
            Toastr::success(__('delete_successful'));
            $data = [
                'status'  => 'success',
                'message' => __('delete_successful'),
                'title'   => __('success'),
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            $data = [
                'status'  => 'danger',
                'message' => $e->getMessage(),
                'title'   => __('error'),
            ];

            return response()->json($data);
        }
    }
}
