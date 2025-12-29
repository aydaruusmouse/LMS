<?php

namespace App\DataTables;

use App\Models\Subscriber;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SubscriberDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function ($subscriber) {
                return view('backend.admin.marketing.subscriber.action', compact('subscriber'));
            })->addColumn('subscribe_at', function ($subscriber) {
                return Carbon::parse($subscriber->created_at)->format('M d, Y h:i A');
            })->setRowId('id');
    }

    public function query(): QueryBuilder
    {
        $model = new Subscriber();

        return $model->latest('id')->newQuery();
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
            Column::make('email')->title(__('email')),
            Column::computed('subscribe_at')->title(__('subscribe_at')),
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
