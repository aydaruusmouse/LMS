<?php

namespace App\DataTables;

use App\Models\Checkout;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CommissionReportDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))

            ->addIndexColumn()

            ->addColumn('instructor', function ($checkout) {
                return view('backend.admin.report.course_instructors', compact('checkout'));
            })

            ->addColumn('organisation_commission', function ($checkout) {

                return $checkout->organization_commission;

            })

            ->addColumn('admin_commission', function ($checkout) {

                return $checkout->system_commission;

            })

            ->addColumn('order_code', function ($checkout) {

                return $checkout->trx_id;

            })

            ->addColumn('dateTime', function ($checkout) {

                return Carbon::parse($checkout->created_at)->format('d-m-y  h:i:s A');

            })

            ->addColumn('sale_amount', function ($checkout) {

                return $checkout->payable_amount;

            })

            ->setRowId('id');

    }

    public function query(): QueryBuilder
    {
        return Checkout::with(['enrolls' => function ($query) {
            $query->with('enrollable');
        }])
            ->when($this->dateRange, function ($query) {
                $query->where('checkouts.created_at', '>=', $this->start_date)
                    ->where('checkouts.created_at', '<=', $this->end_date);
            })
            ->when($this->request->search['value'] ?? false, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('trx_id', 'like', "%$search%");
                });
            })
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
                    'lengthMenu'        => '_MENU_ '.__('commission_per_page'),
                    'search'            => '',
                ],
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('id')->data('DT_RowIndex')->title('#')->searchable(false)->width(10),
            Column::make('trx_id')->title(__('order_code')),
            Column::computed('instructor')->title(__('instructor'))->exportable(false)->printable(false)
                ->searchable(false),
            Column::computed('sale_amount')->title(__('sale_amount'))->exportable(false)->printable(false)
                ->searchable(false),
            Column::computed('organisation_commission')->title(__('organisation_commission'))->exportable(false)
                ->printable(false),
            Column::computed('admin_commission')->title(__('admin_commission'))->exportable(false)
                ->printable(false),
            Column::computed('dateTime')->title(__('date_&_time'))->exportable(false)
                ->printable(false),

        ];
    }

    protected function filename(): string
    {
        return 'commission_history_'.date('YmdHis');
    }
}
