<?php

namespace App\DataTables;

use App\Models\StudentFaq;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class StudentFaqDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function ($faq) {
                return view('backend.admin.support_system.faq.action', compact('faq'));
            })->addColumn('status', function ($faq) {
                return view('backend.admin.support_system.faq.status', compact('faq'));
            })->addColumn('question', function ($faq) {
                return $faq->lang_question;
            })->addColumn('answer', function ($faq) {
                $answer = strip_tags($faq->lang_answer);

                return strlen($answer) > 100 ? substr($answer, 0, 100).'...' : $answer;
            })->setRowId('id');
    }

    public function query(): QueryBuilder
    {
        $model = new StudentFaq();

        return $model
            ->when($this->request->search['value'] ?? false, function ($query, $search) {
                $query->where('question', 'like', "%$search%")
                    ->orWhere('answer', 'like', "%$search%");
            })
            ->with('language')->latest()->newQuery();
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
                    'lengthMenu'        => '_MENU_ '.__('faq_per_page'),
                    'search'            => '',
                ],
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('id')->data('DT_RowIndex')->title('#')->searchable(false)->width(10),
            Column::computed('question')->title(__('question')),
            Column::computed('answer')->title(__('answer')),
            Column::make('ordering')->title(__('order'))->searchable(false),
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
