<?php

namespace App\DataTables;

use App\Models\Enroll;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CourseSaleDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('course', function ($enroll) {
                return view('backend.admin.report.course_details', compact('enroll'));
            })->addColumn('category', function ($enroll) {
                return $enroll->enrollable->category->title;
            })->addColumn('organization', function ($enroll) {
                return $enroll->enrollable->organization->org_name;
            })->addColumn('total_sale', function ($enroll) {
                return get_price($enroll->total_earn, userCurrency());
            })->addColumn('earning_details', function ($enroll) {
                return view('backend.admin.report.earning_details', compact('enroll'));
            })
            ->setRowId('id');
    }

    public function query(): QueryBuilder
    {
        $model = Enroll::with('enrollable', 'checkout')->where('enrollable_type', 'App\Models\Course');
        $model->when($this->course_ids, function ($query) {
            $query->whereIn('enrollable_id', $this->course_ids);
        });
        $model->when($this->category_id, function ($query) {
            $query->whereHas('enrollable', function ($query) {
                $query->where('category_id', $this->category_id);
            });
        });
        $model->when($this->organization_id, function ($query) {
            $query->whereHas('enrollable', function ($query) {
                $query->where('organization_id', $this->organization_id);
            });
        });
        $model->when($this->dateRange, function ($query) {
            $query->whereRaw("date(created_at) between '$this->start_date' and '$this->end_date'");
        });
        $model->select('*', DB::raw('sum(sub_total) as total_earn '));
        $model->groupBy('enrollable_id');

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
                    'lengthMenu'        => '_MENU_ '.__('course_sale_per_page'),
                    'search'            => '',
                ],
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('id')->data('DT_RowIndex')->title('#')->searchable(false)->width(10),
            Column::computed('course')->title(__('course_details'))->exportable(false)
                ->printable(false),
            Column::computed('category')->title(__('category'))->exportable(false)
                ->printable(false),
            Column::computed('organization')->title(__('organisation'))->exportable(false)
                ->printable(false),
            Column::computed('total_sale')->title(__('total_sale'))->exportable(false)
                ->printable(false),
            Column::computed('earning_details')->title(__('earning_details'))->exportable(false)
                ->printable(false),
        ];
    }

    protected function filename(): string
    {
        return 'course_sale_'.date('YmdHis');
    }
}
