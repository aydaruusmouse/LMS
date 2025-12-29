<?php

namespace App\DataTables;

use App\Models\UserSubscription;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserSubscribeDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('image', function ($subscribe) {
                return view('backend.admin.package_subscription.image', compact('subscribe'));
            })->addColumn('name', function ($subscribe) {
                return $subscribe->user->first_name.' '.$subscribe->user->last_name;
            })->addColumn('price', function ($subscribe) {
                return get_price($subscribe->price, userCurrency());
            })->addColumn('facilities', function ($subscribe) {
                if ($subscribe->facilities == 1) {
                    return __('yes');
                } else {
                    return __('no');
                }

            })
            ->setRowId('id');
    }

    public function query(): QueryBuilder
    {
        $model = UserSubscription::with('user', 'subscribe')->latest('id');

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
                    'lengthMenu'        => '_MENU_ '.__('subscribe_per_page'),
                    'search'            => '',
                ],
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('id')->data('DT_RowIndex')->title('#')->searchable(false)->width(10),
            Column::make('subscribe.name')->title(__('package_name')),
            Column::make('user.first_name')->title(__('name')),
            Column::computed('image')->title(__('image'))->exportable(false)->printable(false)
                ->searchable(false),
            Column::computed('price')->title(__('price'))->exportable(false)->printable(false)
                ->searchable(false),
            Column::make('validity')->title(__('validity'))->exportable(false)->printable(false)
                ->searchable(false),
            Column::make('upload_limit')->title(__('upload_limit'))->exportable(false)->printable(false)
                ->searchable(false),
            Column::make('add_limit')->title(__('add_limit'))->exportable(false)->printable(false)
                ->searchable(false),
            Column::computed('facilities')->title(__('facilities'))->exportable(false)->printable(false)
                ->searchable(false),

        ];
    }

    protected function filename(): string
    {
        return 'subscribe_'.date('YmdHis');
    }
}
