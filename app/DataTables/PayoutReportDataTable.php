<?php

namespace App\DataTables;

use App\Models\Payout;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PayoutReportDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('organisation', function ($payout) {
                return $payout->organization->org_name;
            })->addColumn('status', function ($payout) {
                return view('backend.admin.payout.status', compact('payout'));
            })->addColumn('dateTime', function ($payout) {
                return Carbon::parse($payout->created_at)->format('d-m-y  h:i:s A');
            })->addColumn('amount', function ($payout) {
                return get_price($payout->amount, userCurrency());
            })->setRowId('id');
    }

    public function query(): QueryBuilder
    {
        $model = Payout::when($this->payment_method != '', function ($query) {
            $query->where('payment_method', $this->payment_method);
        })
            ->when($this->dateRange, function ($query) {
                $query->whereRaw("date(created_at) between '$this->start_date' and '$this->end_date'");
            })->latest('id');

        return $model->newQuery();

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
                    'lengthMenu'        => '_MENU_ '.__('payout_per_page'),
                    'search'            => '',
                ],
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('id')->data('DT_RowIndex')->title('#')->searchable(false)->width(10),
            Column::make('payout_id')->title(__('payout_id')),
            Column::make('payment_method')->title(__('payment_method')),
            Column::computed('organisation')->title(__('organisation'))->exportable(false)->printable(false)
                ->searchable(false),
            Column::computed('amount')->title(__('withdraw_amount'))->exportable(false)
                ->printable(false),
            Column::computed('status')->title(__('status'))->exportable(false)
                ->printable(false),
            Column::computed('dateTime')->title(__('date_&_time'))->exportable(false)
                ->printable(false),

        ];
    }

    protected function filename(): string
    {
        return 'payout_story_'.date('YmdHis');
    }
}
