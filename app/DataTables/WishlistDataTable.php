<?php

namespace App\DataTables;

use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class WishlistDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('course_title', function ($wish) {
                return @$wish->course->title;
            })
            ->addColumn('category', function ($wish) {
                return @$wish->course->category->lang_title;
            })
            ->addColumn('organization', function ($wish) {
                return @$wish->course->organization->org_name;
            })
            ->setRowId('wishable_id');
    }

    public function query(): QueryBuilder
    {
        $model = Wishlist::whereHas('course')->with('course.category.language')->orderBy('wishable_id')->where('wishable_type', 'App\Models\Course')
            ->when($this->category_id, function ($query) {
                $query->whereHas('course', function ($query) {
                    $query->where('category_id', $this->category_id);
                });
            })
            ->when($this->organization_id, function ($query) {
                $query->whereHas('course', function ($query) {
                    $query->where('organization_id', $this->organization_id);
                });
            })
            ->when($this->request->search['value'] ?? false, function ($query, $search) {
                $query->whereHas('course', function ($query) use ($search) {
                    $query->where('title', 'like', "%$search%")
                        ->orWhereHas('category.language', function ($query) use ($search) {
                            $query->where('title', 'like', "%$search%");
                        })
                        ->orWhereHas('organization', function ($query) use ($search) {
                            $query->where('org_name', 'like', "%$search%");
                        });
                });
            })
            ->select(
                DB::raw('(count(user_id)) as total_wish'),
                DB::raw('wishable_id'),
            )
            ->groupBy('wishable_id')->latest('id');

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
                    'lengthMenu'        => '_MENU_ '.__('wishlist_per_page'),
                    'search'            => '',
                ],
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('id')->data('DT_RowIndex')->title('#')->searchable(false)->width(10),
            Column::make('course_title')->title(__('course_title'))->searchable(false)->exportable(false)->printable(false)
                ->searchable(false),
            Column::computed('category')->title(__('category'))->searchable(false)->exportable(false)->printable(false)
                ->searchable(false),
            Column::computed('organization')->title(__('organization'))->searchable(false)->exportable(false)->printable(false)
                ->searchable(false),
            Column::make('total_wish')->title(__('total_wish'))->searchable(false)->addClass('action-card'),

        ];
    }

    protected function filename(): string
    {
        return 'wishlist_'.date('YmdHis');
    }
}
