<?php

namespace App\DataTables;

use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TicketDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function ($ticket) {
                return view('backend.admin.support_system.ticket.action', compact('ticket'));
            })->addColumn('status', function ($ticket) {
                return view('backend.admin.support_system.ticket.status', compact('ticket'));
            })->addColumn('created_at', function ($ticket) {
                return Carbon::parse($ticket->created_at)->format('M d, Y h:i A');
            })->addColumn('department', function ($ticket) {
                return @$ticket->department->title;
            })->addColumn('name', function ($ticket) {
                return $ticket->name;
            })->setRowId('id');
    }

    public function query(): QueryBuilder
    {
        $model = new Ticket();

        return $model->with('department')->when(request('order')[0]['dir'] ?? false, function ($query, $orderBy) {
            $query->orderBy('id', $orderBy);
        })
            ->when($this->request->search['value'] ?? false, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('first_name', 'like', "%$search%")
                        ->orWhere('last_name', 'like', "%$search%")
                        ->orWhere('subject', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%")
                        ->orWhere('priority', 'like', "%$search%")
                        ->orWhere('created_at', 'like', "%$search%")
                        ->orWhereHas('department', function ($Query) use ($search) {
                            $Query->where('title', 'like', "%$search%");
                        });
                });
            })
            ->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->setTableAttribute('style', 'width:99.8%')
            ->footerCallback('function ( row, data, start, end, display ) {

                $(".dataTables_length select").addClass("form-select form-select-lg without_search mb-3");
                selectionFields();
            }')
            ->parameters([
                'dom'        => 'Blfrtip',
                'buttons'    => [
                    [],
                ],
                'lengthMenu' => [[10, 25, 50, 100, 250], [10, 25, 50, 100, 250]],
                'language'   => [
                    'searchPlaceholder' => __('search'),
                    'lengthMenu'        => '_MENU_ '.__('subscriber_per_page'),
                    'search'            => '',
                ],
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('id')->data('DT_RowIndex')->title('#')->searchable(false),
            Column::make('name')->title(__('name'))->searchable(false),
            Column::make('email')->title(__('email'))->searchable(false),
            Column::make('subject')->title(__('subject'))->searchable(false),
            Column::computed('department')->title(__('department'))->searchable(false),
            Column::computed('priority')->title(__('priority'))->searchable(false)->addClass('text-capitalize'),
            Column::computed('created_at')->title(__('created')),
            Column::computed('status')->title(__('status'))
                ->exportable(false)
                ->printable(false)
                ->searchable(false),
            Column::computed('action')->addClass('action-card')->title(__('Option'))
                ->exportable(false)
                ->printable(false)
                ->searchable(false),

        ];
    }

    protected function filename(): string
    {
        return 'subscriber_'.date('YmdHis');
    }
}
