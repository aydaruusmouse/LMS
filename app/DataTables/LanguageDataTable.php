<?php

namespace App\DataTables;

use App\Models\Language;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LanguageDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function ($language) {
                return view('backend.admin.language.action', compact('language'));
            })->addColumn('status', function ($language) {
                return view('backend.admin.language.status', compact('language'));
            })->addColumn('rtl', function ($language) {
                return view('backend.admin.language.rtl', compact('language'));
            })
            ->setRowId('id');
    }

    public function query(): QueryBuilder
    {
        $model = new Language();

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
                    'lengthMenu'        => '_MENU_ '.__('language_per_page'),
                    'search'            => '',
                ],
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('id')->data('DT_RowIndex')->title('#')->searchable(false),
            Column::make('name')->title(__('language')),
            Column::make('locale')->title(__('locale')),
            Column::computed('rtl')->title(__('rtl')),
            Column::computed('status')->title(__('status')),
            Column::computed('action')->title(__('option'))->addClass('action-card')
                ->exportable(false)
                ->printable(false)
                ->searchable(false),

        ];
    }

    protected function filename(): string
    {
        return 'Language_'.date('YmdHis');
    }
}
