<?php

namespace App\DataTables;

use App\Models\Enroll;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PaymentReportDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('course', function ($enroll) {
                return $enroll->enrollable->title ?? '';
            })->addColumn('checkout', function ($enroll) {
                return $enroll->checkout->trx_id;
            })->addColumn('organization', function ($enroll) {
                return $enroll->enrollable->organization->org_name ?? '';
            })->addColumn('payment_type', function ($enroll) {
                return $enroll->checkout->payment_type;
            })->addColumn('payment_amount', function ($enroll) {
                return get_price($enroll->checkout->payable_amount, userCurrency());
            })->addColumn('dateTime', function ($enroll) {
                return Carbon::parse($enroll->created_at)->format('d-m-y  h:i:s A');
            })
            ->setRowId('id');
    }

    public function query(): QueryBuilder
    {
        $model = Enroll::with('enrollable')->where('enrollable_type', 'App\Models\Course')
            ->when($this->payment_type, function ($query) {
                $query->whereHas('checkout', function ($query) {
                    $query->where('payment_type', $this->payment_type);
                });
            })
            ->when($this->dateRange, function ($query) {
                $query->whereRaw("date(created_at) between '$this->start_date' and '$this->end_date'");
            })->latest('id');

        return $model
            ->when($this->request->search['value'] ?? false, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->whereHas('checkout', function ($query) use ($search) {
                        $query->where('trx_id', 'like', "%$search%");
                    })->orWhereHas('enrollable', function ($query) use ($search) {
                        $query->where('title', 'like', "%$search%");
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
                    'lengthMenu'        => '_MENU_ '.__('payment_per_page'),
                    'search'            => '',
                ],
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('id')->data('DT_RowIndex')->title('#')->searchable(false)->width(10),
            Column::computed('course')->title(__('course_title'))->searchable(false)->exportable(false)
                ->printable(false),
            Column::computed('checkout')->title(__('transaction_id'))->searchable(false)->exportable(false)
                ->printable(false),
            Column::computed('organization')->title(__('transaction_to'))->exportable(false)
                ->printable(false),
            Column::computed('payment_type')->title(__('payment_type'))->exportable(false)
                ->printable(false),
            Column::computed('payment_amount')->title(__('payment_amount'))->exportable(false)
                ->printable(false),
            Column::computed('dateTime')->title(__('date_&_time'))->exportable(false)
                ->printable(false),

        ];
    }

    protected function filename(): string
    {
        return 'payment_story_'.date('YmdHis');
    }
}
