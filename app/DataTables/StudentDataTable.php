<?php

namespace App\DataTables;

use App\Models\Course;
use App\Models\Enroll;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class StudentDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('status', function ($user) {
                return view('backend.admin.student.status', compact('user'));
            })->addColumn('action', function ($user) {
                return view('backend.admin.student.action', compact('user'));
            })->addColumn('name', function ($user) {
                return view('backend.admin.student.name', compact('user'));
            })->addColumn('country', function ($user) {
                return @$user->country->name;
            })->addColumn('phone_details', function ($user) {
                return config('app.demo_mode') ? '' : countryCode($user->phone_country_id).$user->phone;
            })->addColumn('enrolled_course', function ($user) {
                return Enroll::whereHas('checkout', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })->where('enrollable_type', Course::class)->count();
            })->setRowId('id');
    }

    public function query(): QueryBuilder
    {
        $model = new User();

        return $model->with('country')->when($this->id, function ($query) {
            $query->whereHas('checkout.enrolls', function ($query) {
                $query->where('enrollable_type', Course::class)->where('enrollable_id', $this->id);
            });
        })
            ->when($this->request->search['value'] ?? false, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('first_name', 'like', "%$search%")
                        ->orWhere('last_name', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%")
                        ->orWhere('phone', 'like', "%$search%");
                });
            })
            ->where('role_id', 3)->latest()->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->responsive()
            ->scrollCollapse()
            ->selectStyleSingle()
            ->setTableAttribute('style', 'width:99.8%')
            ->footerCallback('function ( row, data, start, end, display ) {

                $(".dataTables_length select").addClass("form-select form-select-lg without_search mb-3");
                selectionFields();
            }')
            ->parameters([
                'dom'          => 'Blfrtip',
                'drawCallback' => 'function(settings) {
                    // Iterate over each td element in the body of the table
                    $("#dataTableBuilder tbody tr td").each(function (index) {
                        var class_name = $("thead th").eq(index).attr("class");
                        var text = $("thead th").eq(index).text();
                        if(class_name && class_name.includes("sg_td")) {
                            $(this).attr("data-column", text);
                        }
                    });
                }',
                'buttons'      => [
                    [],
                ],
                'lengthMenu'   => [[10, 25, 50, 100, 250], [10, 25, 50, 100, 250]],
                'language'     => [
                    'searchPlaceholder' => __('search'),
                    'lengthMenu'        => '_MENU_ '.__('student_per_page'),
                    'search'            => '',
                ],
            ]);
    }

    public function getColumns(): array
    {
        $columns = [
            Column::computed('id')->data('DT_RowIndex')->title('#')->searchable(false)->width(10),
            Column::computed('name')->title(__('name_and_mail'))->searchable(false)->exportable(false)->printable(false),
            Column::computed('phone_details')->title(__('phone')),
            Column::computed('country')->title(__('country')),
            Column::computed('enrolled_course')->title(__('enrolled_course')),
            Column::computed('status')->title(__('status'))->searchable(false)->exportable(false)->printable(false),
            Column::computed('action')->addClass('action-card')->title(__('action'))->searchable(false)->exportable(false)->printable(false),
            Column::make('phone')->title(__('phone'))->addClass('d-none'),
            Column::make('email')->title(__('email'))->addClass('d-none'),
            Column::make('first_name')->title(__('name'))->addClass('d-none'),
            Column::make('last_name')->title(__('name'))->addClass('d-none'),

        ];

        return $columns;
    }

    protected function filename(): string
    {
        return 'instructor_'.date('YmdHis');
    }
}
