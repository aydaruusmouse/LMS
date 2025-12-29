<?php

namespace App\DataTables;

use App\Models\OfflineMethod;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class OfflineMethodDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function ($offline_method) {
                return view('backend.admin.offline_methods.action', compact('offline_method'));
            })->addColumn('status', function ($offline_method) {
                return view('backend.admin.offline_methods.status', compact('offline_method'));
            })->addColumn('image', function ($offline_method) {
                return view('backend.admin.offline_methods.image', compact('offline_method'));
            })->addColumn('name', function ($offline_method) {
                return $offline_method->lang_name;
            })->addColumn('type', function ($offline_method) {
                return ucfirst(str_replace('_', ' ', $offline_method->type));
            })->setRowId('id');
    }

    public function query(): QueryBuilder
    {
        $model = new OfflineMethod();

        return $model->with('language')
            ->when($this->request->search['value'] ?? false, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%")
                        ->orwhere('type', 'like', "%$search%");
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
                    'lengthMenu'        => '_MENU_ '.__('offline_methods_per_page'),
                    'search'            => '',
                ],
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('id')->data('DT_RowIndex')->title('#')->searchable(false)->width(10),
            Column::make('image')->title(__('image')),
            Column::make('name')->title(__('name')),
            Column::make('type')->title(__('type')),
            Column::computed('status')->title(__('status'))->exportable(false)
                ->printable(false)->width(10),
            Column::computed('action')->title(__('action'))
                ->exportable(false)
                ->printable(false)
                ->searchable(false)->addClass('action-card')->width(10),

        ];
    }

    protected function filename(): string
    {
        return 'offline_method_'.date('YmdHis');
    }
}
