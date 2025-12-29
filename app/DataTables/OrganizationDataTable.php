<?php

namespace App\DataTables;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class OrganizationDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()->addColumn('phone', function ($user) {
                return countryCode($user->phone_country_id).$user->phone;
            })
            ->addColumn('status', function ($organization) {
                return view('backend.admin.organization.status', compact('organization'));
            })->addColumn('name', function ($organization) {
                return view('backend.admin.organization.name', compact('organization'));
            })->addColumn('action', function ($organization) {
                return view('backend.admin.organization.action', compact('organization'));
            })->addColumn('logo', function ($organization) {
                return view('backend.admin.organization.image', compact('organization'));
            })->setRowId('id');
    }

    public function query(): QueryBuilder
    {
        $model = new Organization();

        return $model
            ->when($this->request->search['value'] ?? false, function ($query, $search) {
                $query->where('org_name', 'like', "%$search%")
                    ->orWhere('phone', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            })
            ->latest()
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
                    'lengthMenu'        => '_MENU_ '.__('organization_per_page'),
                    'search'            => '',
                ],
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('id')->data('DT_RowIndex')->title('#')->searchable(false)->width(10),
            Column::computed('logo')->title(__('logo')),
            Column::computed('name')->title(__('name')),
            Column::make('email')->title(__('email')),
            Column::computed('phone')->title(__('phone')),
            Column::computed('status')->title(__('status'))->searchable(false)->exportable(false)->printable(false),
            Column::computed('action')->addClass('action-card')->title(__('action'))->searchable(false)->exportable(false)->printable(false),
        ];
    }

    protected function filename(): string
    {
        return 'Currency_'.date('YmdHis');
    }
}
