<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Repositories\DepartmentRepository;
use App\Repositories\StudentFaqRepository;
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

    public function support(StudentFaqRepository $studentFaqRepository)
    {
        $data = [
            'faqs' => $studentFaqRepository->activeFaqs(),
        ];

        return view('frontend.ticket.support', $data);
    }

    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $tickets = $this->ticket->all([
                'user_id'  => auth()->id(),
                'paginate' => 5,
            ], ['lastReply']);
            if (request()->ajax()) {
                $view = '';
                foreach ($tickets as $key => $ticket) {
                    $view_vars = [
                        'key'     => $key,
                        'ticket'  => $ticket,
                        'tickets' => $tickets,
                    ];
                    $view .= view('frontend.ticket.component.ticket', $view_vars)->render();
                }

                return response()->json([
                    'html'      => $view,
                    'next_page' => $tickets->nextPageUrl(),
                ]);
            }
            $data    = [
                'tickets' => $tickets,
            ];

            return view('frontend.ticket.index', $data);
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

            return view('frontend.ticket.create', $data);
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
        ]);

        try {
            $this->ticket->store($request->all());
            Toastr::success(__('create_successful'));

            return response()->json([
                'success'   => __('create_successful'),
                'route'     => route('support-tickets.index'),
                'is_reload' => 1,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function show($id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $ticket = $this->ticket->find($id);
            $data   = [
                'ticket'  => $ticket,
                'replies' => $ticket->replies()->with('user')->latest()->get(),
            ];

            return view('frontend.ticket.show', $data);
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
                'success'   => __('reply_successful'),
                'route'     => url()->previous(),
                'is_reload' => 1,
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
