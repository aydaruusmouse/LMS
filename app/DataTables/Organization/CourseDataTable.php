<?php

namespace App\DataTables\Organization;

use App\Models\Course;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CourseDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))

            ->addIndexColumn()

            ->addColumn('is_published', function ($course) {
                return view('backend.organization.course.stage', compact('course'));
            })->addColumn('status', function ($course) {
                return view('backend.organization.course.status', compact('course'));
            })->addColumn('category', function ($course) {
                return @$course->category->lang_title;
            })->filterColumn('category', function ($query, $keyword) {
                $query->whereHas('category', function ($query) use ($keyword) {
                    $query->where('title', 'like', '%'.$keyword.'%');
                });
            })->addColumn('action', function ($course) {
                return view('backend.organization.course.action', compact('course'));
            })->addColumn('enrolled_student', function ($course) {
                return $course->enrolls_count;
            })->addColumn('price', function ($course) {
                return get_price($course->price, userCurrency());
            })->setRowId('id')->rawColumns(['is_published', 'status', 'action']);
    }

    public function query(): QueryBuilder
    {

        return Course::with('category.language')->withCount('enrolls')
            ->where('organization_id', authOrganizationId())
            ->when($this->instructor_ids, function ($query) {
                $query->whereHas('users', function ($query) {
                    $query->where('users.id', $this->instructor_ids);
                });
            })
            ->when($this->category_ids, function ($query) {
                $query->whereIn('category_id', $this->category_ids);
            })
            ->when($this->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->whereNull('deleted_at')
            ->latest('id')
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
                    'lengthMenu'        => '_MENU_ '.__('course_per_page'),
                    'search'            => '',
                ],
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('id')->data('DT_RowIndex')->title('#')->searchable(false)->width(10),
            Column::make('title')->title(__('title')),
            Column::computed('category')->title(__('category')),
            Column::computed('enrolled_student')->title(__('enrolled_student')),
            Column::computed('price')->title(__('price')),
            Column::computed('status')->title(__('status'))->searchable(false)->exportable(false)->printable(false),
            Column::computed('is_published')->title(__('published')),
            Column::computed('action')->addClass('action-card')->title(__('action'))->searchable(false)->exportable(false)->printable(false),
        ];
    }

    protected function filename(): string
    {
        return 'Currency_'.date('YmdHis');
    }
}
