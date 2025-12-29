<?php

namespace App\DataTables;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SubjectDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function ($subject) {
                return view('backend.admin.subject.action', compact('subject'));
            })->addColumn('status', function ($subject) {
                return view('backend.admin.subject.status', compact('subject'));
            })->addColumn('image', function ($subject) {
                return view('backend.admin.subject.image', compact('subject'));
            })->addColumn('total_course', function ($subject) {
                return $subject->courses_count;
            })->addColumn('title', function ($subject) {
                return $subject->lang_title;
            })
            ->filterColumn('title', function ($query, $keyword) {
                $query->whereHas('language', function ($query) use ($keyword) {
                    $query->where('title', 'like', '%'.$keyword.'%');
                })->orWhereHas('languages', function ($query) use ($keyword) {
                    $query->where('title', 'like', '%'.$keyword.'%');
                });
            })->setRowId('id');
    }

    public function query(): QueryBuilder
    {
        $model = new Subject();

        return $model->with('language')->withCount('courses')->where('type', $this->type)->newQuery();
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
                    'lengthMenu'        => '_MENU_ '.__('subject_per_page'),
                    'search'            => '',
                ],
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('id')->data('DT_RowIndex')->title('#')->searchable(false)->width(10),
            Column::make('title')->title(__('title')),
            Column::computed('image')->title(__('image')),
            Column::computed('total_course')->title(__('total_course')),
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
        return 'blog_'.date('YmdHis');
    }
}
