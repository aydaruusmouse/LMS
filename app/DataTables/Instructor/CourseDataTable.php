<?php

namespace App\DataTables\Instructor;

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
                return $course->is_published == 1 ? 'Published' : 'Unpublished';
            })

            ->addColumn('category', function ($course) {
                return @$course->category->lang_title;
            })->addColumn('action', function ($course) {
                return view('backend.instructor.course.action', compact('course'));
            })->addColumn('enrolled_student', function ($course) {
                return $course->enrolls_count;
            })->addColumn('price', function ($course) {
                return get_price($course->price, userCurrency());
            })->addColumn('status', function ($course) {
                return view('backend.instructor.course.status', compact('course'));
            })->setRowId('id');
    }

    public function query(): QueryBuilder
    {

        return Course::with('category.language')->withCount('enrolls')
            ->where('organization_id', authOrganizationId())
            ->whereHas('users', function ($query) {
                $query->where('users.id', auth()->id());
            })
            ->when($this->category_ids, function ($query) {
                $query->whereIn('category_id', $this->category_ids);
            })->when($this->status, function ($query) {

                $status = $this->status == 'active' ? 1 : 0;

                $query->where('status', $status);
            })->whereNull('deleted_at')->latest('id')->newQuery();
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
            Column::make('status')->title(__('status')),
            Column::computed('is_published')->title(__('published')),
            Column::computed('action')->addClass('action-card')->title(__('action'))->searchable(false)->exportable(false)->printable(false),
        ];
    }

    protected function filename(): string
    {
        return 'Currency_'.date('YmdHis');
    }
}
