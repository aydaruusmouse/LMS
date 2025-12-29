<?php

namespace App\DataTables;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Carbon;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CertificateDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))

            ->addIndexColumn()

            ->addColumn('action', function ($course) {
                $view = view('backend.admin.course.certificate.action', compact('course'))->render();
                if ($this->instructor_id) {
                    $view = view('backend.instructor.certificate.action', compact('course'))->render();
                }

                return $view;
            })->addColumn('date', function ($course) {
                return $course->certificate ? Carbon::parse($course->certificate->created_at)->format('d M, Y') : '';
            })->addColumn('organization', function ($course) {
                return $course->organization->org_name;
            })->addColumn('instructor', function ($course) {
                $instructors = User::whereIn('id', $course->instructor_ids)->get();

                return view('backend.admin.course.certificate.instructor', compact('course', 'instructors'));
            })->setRowId('id');
    }

    public function query(Course $model): QueryBuilder
    {
        $model = new Course();

        return $model->with('certificate', 'organization', 'user')
            ->when($this->instructor_id, function ($query) {
                $query->whereHas('users', function ($query) {
                    $query->where('users.id', $this->instructor_id);
                });
            })
            ->when($this->request->search['value'] ?? false, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->Where('title', 'like', "%$search%")
                        ->orWhereHas('user', function ($Query) use ($search) {
                            $Query->where('last_name', 'like', "%$search%")
                                ->orwhere('first_name', 'like', "%$search%");
                        })
                        ->WhereHas('organization', function ($Query) use ($search) {
                            $Query->where('org_name', 'like', "%$search%");
                        });
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
                    'lengthMenu'        => '_MENU_ '.__('certificate_per_page'),
                    'search'            => '',
                ],
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('id')->data('DT_RowIndex')->title('#')->searchable(false)->width(10),
            Column::make('title')->title(__('course'))->searchable(false),
            Column::computed('organization')->title(__('organization')),
            Column::computed('instructor')->title(__('instructor'))->searchable(false),
            Column::computed('date')->title(__('added_date'))->searchable(false),
            Column::computed('action')->title(__('action'))
                ->exportable(false)
                ->printable(false)
                ->searchable(false),

        ];
    }

    protected function filename(): string
    {
        return 'success_story_'.date('YmdHis');
    }
}
