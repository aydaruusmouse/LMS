<?php

namespace App\DataTables;

use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BlogDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function ($blog) {
                return view('backend.admin.blog.action', compact('blog'));
            })->addColumn('badge_status', function ($blog) {
                return view('backend.admin.blog.status', compact('blog'));
            })->addColumn('category', function ($blog) {
                return @$blog->category->lang_title;
            })->addColumn('title', function ($blog) {
                return @$blog->lang_title;
            })->addColumn('created_at', function ($blog) {
                return Carbon::parse($blog->created_at)->format('M d, Y h:i A');
            })->setRowId('id');
    }

    public function query(): QueryBuilder
    {
        $model = new Blog();

        return $model->with('language', 'category.language')
            ->when($this->request->search['value'] ?? false, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%$search%")
                        ->orWhere('created_at', 'like', "%$search%")
                        ->orWhereHas('category.language', function ($categoryQuery) use ($search) {
                            $categoryQuery->where('title', 'like', "%$search%");
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
                    'lengthMenu'        => '_MENU_ '.__('blog_per_page'),
                    'search'            => '',
                ],
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('id')->data('DT_RowIndex')->title('#')->searchable(false)->width(10),
            Column::make('title')->title(__('title')),
            Column::computed('category')->title(__('category')),
            Column::computed('created_at')->title(__('created_at')),
            Column::computed('badge_status')->title(__('status'))->exportable(false)
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
