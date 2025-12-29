<?php

namespace App\DataTables;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CouponDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function ($coupon) {
                return view('backend.admin.marketing.coupon.action', compact('coupon'));
            })->addColumn('status', function ($coupon) {
                return view('backend.admin.marketing.coupon.status', compact('coupon'));
            })->addColumn('discount', function ($coupon) {
                return $coupon->discount_type == 'flat' ? get_price($coupon->discount, userCurrency()) : $coupon->discount.'%';
            })->addColumn('title', function ($coupon) {
                return $coupon->lang_title;
            })->setRowId('id');
    }

    public function query(): QueryBuilder
    {
        $model = new Coupon();

        return $model->with('language')
            ->when($this->request->search['value'] ?? false, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%$search%")
                        ->orwhere('type', 'like', "%$search%")
                        ->orwhere('code', 'like', "%$search%")
                        ->orwhere('discount', 'like', "%$search%")
                        ->orWhereHas('language', function ($query) use ($search) {
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
                    'lengthMenu'        => '_MENU_ '.__('coupon_per_page'),
                    'search'            => '',
                ],
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('id')->data('DT_RowIndex')->title('#')->searchable(false)->width(10),
            Column::make('title')->title(__('title'))->searchable(false),
            Column::make('type')->title(__('coupon_type'))->searchable(false),
            Column::make('code')->title(__('coupon_code'))->searchable(false),
            Column::computed('discount')->title(__('discount'))->searchable(false),
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
        return 'blog_'.date('YmdHis');
    }
}
