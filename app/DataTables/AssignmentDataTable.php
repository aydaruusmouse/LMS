<?php

namespace App\DataTables;

use App\Models\Assignment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AssignmentDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()->addColumn('action', function ($assignment) {
                return view('backend.admin.course.assignment.action', compact('assignment'));
            })

            ->addColumn('instructor', function ($assignment) {

                return $assignment->instructor->name;
            })

            ->addColumn('deadline', function ($assignment) {
                return Carbon::parse($assignment->deadline)->format('d-F-Y H:i A');
            })

            ->setRowId('id');
    }

    public function query(): QueryBuilder
    {
        $model = new Assignment();

        return $model
            ->with('instructor')
            ->when($this->course_id, function ($query) {
                $query->where('course_id', $this->course_id);
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
                    'lengthMenu'        => '_MENU_ '.__('list_per_page'),
                    'search'            => '',
                ],
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('id')->data('DT_RowIndex')->title('#')->searchable(false)->width(10),
            Column::make('title')->title(__('title'))->width('10px'),
            Column::computed('instructor')->title(__('instructor')),
            Column::computed('pass_marks')->title(__('pass_marks')),
            Column::computed('total_marks')->title(__('total_marks')),
            Column::computed('deadline')->title(__('deadline')),
            Column::computed('action')->title(__('action'))
                ->exportable(false)
                ->printable(false)
                ->searchable(false)->addClass('action-card')->width(50),
        ];
    }

    protected function filename(): string
    {
        return 'assignment_'.date('YmdHis');
    }
}
