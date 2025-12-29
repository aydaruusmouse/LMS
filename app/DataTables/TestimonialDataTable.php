<?php

namespace App\DataTables;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TestimonialDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function ($testimonial) {
                return view('backend.admin.website_setting.testimonial.action', compact('testimonial'));
            })->addColumn('status', function ($testimonial) {
                return view('backend.admin.website_setting.testimonial.status', compact('testimonial'));
            })->addColumn('image', function ($testimonial) {
                return view('backend.admin.website_setting.testimonial.image', compact('testimonial'));
            })->addColumn('name', function ($testimonial) {
                return $testimonial->lang_name;
            })->setRowId('id');
    }

    public function query(): QueryBuilder
    {
        $model = new Testimonial();

        return $model->with('language')
            ->when($this->request->search['value'] ?? false, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->Where('description', 'like', "%$search%")
                        ->orWhere('name', 'like', "%$search%");
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
                    'lengthMenu'        => '_MENU_ '.__('testimonial_per_page'),
                    'search'            => '',
                ],
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('id')->data('DT_RowIndex')->title('#')->searchable(false)->width(10),
            Column::make('name')->title(__('name'))->searchable(false),
            Column::computed('image')->title(__('image')),
            Column::make('description')->title(__('description'))->searchable(false),
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
        return 'testimonial_'.date('YmdHis');
    }
}
