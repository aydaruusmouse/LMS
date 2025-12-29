<?php

namespace App\DataTables;

use App\Models\OnBoard;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class OnBoardDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function ($onboard) {
                return view('backend.admin.mobile-app.onboard.action', compact('onboard'));
            })->addColumn('status', function ($onboard) {
                return view('backend.admin.mobile-app.onboard.status', compact('onboard'));
            })->addColumn('image', function ($onboard) {
                return view('backend.admin.mobile-app.onboard.image', compact('onboard'));
            })->setRowId('id');
    }

    public function query(): QueryBuilder
    {
        $model = new OnBoard();

        return $model->newQuery();
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
                    'lengthMenu'        => '_MENU_ '.__('on_board_per_page'),
                    'search'            => '',
                ],
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('id')->data('DT_RowIndex')->title('#')->searchable(false),
            Column::computed('image')->title(__('image')),
            Column::make('title')->title(__('title')),
            Column::make('description')->title(__('description')),
            Column::computed('status')->title(__('status')),
            Column::computed('action')->addClass('action-card')->title(__('Option'))
                ->exportable(false)
                ->printable(false)
                ->searchable(false),

        ];
    }

    protected function filename(): string
    {
        return 'Onboard_'.date('YmdHis');
    }
}
