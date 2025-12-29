<?php

namespace App\DataTables;

use App\Models\Checkout;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class EnrollmentDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function ($checkout) {
                return view('backend.admin.enrollment.action', compact('checkout'));
            })->addColumn('courses', function ($checkout) {
                return view('backend.admin.checkout.course', compact('checkout'));
            })->addColumn('student', function ($checkout) {
                $user = $checkout->user;
                return view('backend.admin.student.name', compact('user'));
            })->addColumn('status', function ($checkout) {
                return view('backend.admin.enrollment.status', compact('checkout'));
            })->addColumn('payment_method', function ($checkout) {
                return ucwords(str_replace('_', ' ', $checkout->payment_type));
            })->addColumn('date', function ($checkout) {
                return Carbon::parse($checkout->invoice_date)->format('M d, Y - h:i A');
            })->addColumn('amount', function ($checkout) {
                return get_price($checkout->payable_amount, userCurrency());
            })->setRowId('id');
    }

    public function query(): QueryBuilder
    {
        $model = new Checkout();

        return $model->with('enrolls.enrollable','user')->whereHas('enrolls.enrollable')->newQuery();
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
            Column::computed('student')->title(__('student')),
            Column::computed('courses')->title(__('courses')),
            Column::computed('invoice_no')->title(__('invoice_no')),
            Column::computed('payment_method')->title(__('payment_method')),
            Column::computed('date')->title(__('date')),
            Column::computed('amount')->title(__('payable_amount')),
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
        return 'checkout_'.date('YmdHis');
    }
}
