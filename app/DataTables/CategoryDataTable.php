<?php

namespace App\DataTables;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function ($category) {
                return view('backend.admin.category.action', compact('category'));
            })->addColumn('status', function ($category) {
                return view('backend.admin.category.status', compact('category'));
            })->addColumn('image', function ($category) {
                return view('backend.admin.category.image', compact('category'));
            })->addColumn('featured', function ($category) {
                return view('backend.admin.category.featured', compact('category'));
            })->addColumn('total_course', function ($category) {
                return $category->courses_count;
            })->addColumn('title', function ($category) {
                return $category->lang_title;
            })->setRowId('id')->rawColumns(['image', 'status', 'action', 'featured']);
    }

    public function query(): QueryBuilder
    {
        $model = new Category();

        return $model->with('language')->withCount('courses')->where('type', $this->type)
            ->when($this->request->search['value'] ?? false, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%$search%")
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
                    'lengthMenu'        => '_MENU_ '.__('category_per_page'),
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
            Column::make('featured')->title(__('featured')),
            Column::computed('total_course')->title(__('total_course')),
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
