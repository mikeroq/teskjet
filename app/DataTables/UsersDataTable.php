<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
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
            ->editColumn('action', function($item) {
                return '
                    <div class="btn-group" role="group">
                        <button  class="btn btn-sm btn-danger delete" data-delete="'.$item->id.'" data-email="'.$item->email.'"><i class="far fa-trash-alt"></i></button>
                        <button  class="btn btn-sm btn-success edit" data-id="'.$item->id.'"><i class="fas fa-pencil-alt"></i></button>
                    </div>
                ';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
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
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom("<'row'<'col-12 mb-3'B>><'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" .
                    "<'row'<'col-sm-12'tr>>" .
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>")
                    ->orderBy(1)
                    ->buttons(
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
            Column::make('email'),
            Column::make('name'),
            Column::make('user_level'),
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
        return 'Users_' . date('YmdHis');
    }
}
