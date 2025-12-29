<?php

namespace App\DataTables;

use App\Models\CustomNotification;
use App\Models\Role;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CustomNotificationDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function ($notification) {
                return view('backend.admin.custom_notification.action', compact('notification'));
            })->addColumn('image', function ($notification) {
                return view('backend.admin.custom_notification.image', compact('notification'));
            })->addColumn('receiver', function ($notification) {
                $receivers = '';
                if ($notification->role_ids) {
                    $users = Role::whereIn('id', $notification->role_ids)->get();

                    foreach ($users as $key => $user) {
                        $comma = $key < count($users) - 1 ? ', ' : '';
                        $receivers .= $user->name.$comma;
                    }
                }

                return $receivers;
            })->setRowId('id');
    }

    public function query(): QueryBuilder
    {
        $model = new CustomNotification();

        return $model->latest('id')->newQuery();
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
                    'lengthMenu'        => '_MENU_ '.__('notification_per_page'),
                    'search'            => '',
                ],
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('id')->data('DT_RowIndex')->title('#')->searchable(false)->width(10),
            Column::make('title')->title(__('title')),
            Column::computed('image')->title(__('image')),
            Column::computed('receiver')->title(__('receiver')),
            Column::computed('action')->title(__('action'))
                ->exportable(false)
                ->printable(false)
                ->searchable(false)->addClass('action-card')->width(10),

        ];
    }

    protected function filename(): string
    {
        return 'notification_'.date('YmdHis');
    }
}
