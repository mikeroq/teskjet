<?php

namespace App\DataTables;

use App\Models\Brand;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;


class BrandsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('website', function($item) {
                return '<a href="'.$item->website.'" target="_blank">'.$item->website.'</a>';
            })
            ->editColumn('action', function($item) {
                return '
                    <div class="btn-group" role="group">
                        <button  class="btn btn-sm btn-danger delete" data-delete="'.$item->id.'" data-name="'.$item->name.'"><i class="far fa-trash-alt"></i></button>
                        <button  class="btn btn-sm btn-success edit" data-id="'.$item->id.'"><i class="fas fa-pencil-alt"></i></button>
                    </div>
                ';
            })
            ->rawColumns(['website','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Brand $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Brand $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('brands-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom("<'row'<'col-12 mb-3'B>><'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" .
                    "<'row'<'col-sm-12'tr>>" .
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>")
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create')->addClass('btn-primary')->text('<i class="fas fa-plus"></i> Add')->action("$('#brand_create_modal').modal('toggle');"),
                        Button::make('export')->addClass('btn-primary'),
                        Button::make('print')->addClass('btn-primary'),
                        Button::make('reset')->addClass('btn-primary')->text('<i class="fas fa-sync-alt"></i> Refresh')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('website'),
            Column::make('support_number'),
            Column::computed('action')->exportable(false)->printable(false)->orderable(false)->searchable(false)->class("text-right")
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Brands_' . date('YmdHis');
    }
}
