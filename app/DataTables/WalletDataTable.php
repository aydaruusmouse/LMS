<?php

namespace App\DataTables;

use App\Models\Wallet;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class WalletDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('name', function ($wallet) {
                return view('backend.admin.wallet.name', compact('wallet'));
            })->addColumn('file', function ($wallet) {
                return view('backend.admin.wallet.file', compact('wallet'));
            })->addColumn('status', function ($wallet) {
                return view('backend.admin.wallet.status', compact('wallet'));
            })->addColumn('price', function ($wallet) {
                return get_price($wallet->amount, userCurrency());
            })->addColumn('payment_method', function ($wallet) {
                return ucwords(str_replace('_', '   ', $wallet->payment_method));
            })->addColumn('action', function ($wallet) {
                return view('backend.admin.wallet.action', compact('wallet'));
            })->setRowId('id');
    }

    public function query(): QueryBuilder
    {
        $model = new Wallet();

        return $model->with('user')->latest('id')->newQuery();
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
                    'lengthMenu'        => '_MENU_ '.__('wallet_per_page'),
                    'search'            => '',
                ],
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('id')->data('DT_RowIndex')->title('#')->width(10),
            Column::make('name')->title(__('student')),
            Column::make('payment_method')->title(__('category')),
            Column::make('price')->title(__('amount')),
            Column::computed('trx_id')->title(__('transaction_id')),
            Column::make('file')->title(__('file')),
            Column::make('status')->title(__('status')),
            Column::make('action')->title(__('option'))->searchable(false)->addClass('action-card'),
        ];
    }

    protected function filename(): string
    {
        return 'wishlist_'.date('YmdHis');
    }
}
