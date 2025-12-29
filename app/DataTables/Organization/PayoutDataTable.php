<?php

namespace App\DataTables\Organization;

use App\Models\Payout;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PayoutDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('status', function ($payout) {
                return view('backend.organization.payout.status', compact('payout'));
            })->addColumn('request', function ($payout) {
                return view('backend.organization.payout.request_by', compact('payout'));
            })->addColumn('details', function ($payout) {
                return view('backend.organization.payout.payment_details', compact('payout'));
            })->addColumn('amount', function ($payout) {
                return sprintf('%.2f', $payout->amount);
            })->setRowId('id');
    }

    public function query(): QueryBuilder
    {
        $model = new Payout();

        return $model->latest('id')
            ->where('organization_id', authOrganizationId())
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
            Column::computed('request')->title(__('request_by'))->exportable(false)->printable(false)
                ->searchable(false)->addClass('action-card'),
            Column::computed('details')->title(__('payment_details'))->exportable(false)->printable(false)
                ->searchable(false)->addClass('action-card'),
            Column::computed('amount')->title(__('amount')),
            Column::make('transaction_id')->title(__('transaction_id')),
            Column::computed('status')->title(__('status'))->exportable(false)
                ->printable(false)->width(10),

        ];
    }

    protected function filename(): string
    {
        return 'payout_story_'.date('YmdHis');
    }
}
