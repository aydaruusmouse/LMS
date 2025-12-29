<?php

namespace App\DataTables;

use App\Models\LiveClass;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LiveClassDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function ($class) {
                return view('backend.admin.live_class.action', compact('class'));
            })->addColumn('status', function ($class) {
                return view('backend.admin.live_class.status', compact('class'));
            })->addColumn('course', function ($class) {
                return @$class->course->title;
            })
            ->setRowId('id');
    }

    public function query(): QueryBuilder
    {
        $model = new LiveClass();

        return $model->when($this->user_id, function ($query) {
            return $query->where('user_id', $this->user_id);
        })->latest('id')->newQuery();
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
                    'lengthMenu'        => '_MENU_ '.__('class_per_page'),
                    'search'            => '',
                ],
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('id')->data('DT_RowIndex')->title('#')->searchable(false),
            Column::computed('course')->title(__('course')),
            Column::make('title')->title(__(__('title'))),
            Column::make('meeting_method')->title(__('meeting_method')),
            Column::computed('status')->title(__('status'))->exportable(false)
                ->printable(false),
            Column::computed('action')->title(__('action'))
                ->exportable(false)
                ->printable(false)
                ->searchable(false)->addClass('action-card'),

        ];
    }

    protected function filename(): string
    {
        return 'Currency_'.date('YmdHis');
    }
}
