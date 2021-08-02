<?php

namespace App\DataTables;

use App\Models\Customer;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CustomersDataTable extends DataTable
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
            ->editColumn('name', function($item) {
                return '<a href="'.route("customers.show", $item->id).'" class="font-w600">'.$item->name.'</a>';
            })
            ->editColumn('taxable', '{{$taxable ? "Taxable" : "Tax Exempt" }}')
            ->editColumn('action', function($item) {
                return '
                    <div class="btn-group" role="group">
                        <button  class="btn btn-sm btn-danger delete" data-delete="'.$item->id.'" data-name="'.$item->name.'"><i class="far fa-trash-alt fa-fw"></i></button>
                    </div>
                ';
            })
            ->rawColumns(['name','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Customer $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Customer $model)
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
                    ->setTableId('customers-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(0, 'desc')
                    ->dom("<'row'<'col-12 mb-3'B>><'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" .
                    "<'row'<'col-sm-12'tr>>" .
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>")
                    ->buttons(
                        Button::make('create')->addClass('btn-primary')->text('<i class="fas fa-plus fa-fw"></i> Add')->action("$('#customer_create_modal').modal('toggle');"),
                        Button::make('export')->addClass('btn-primary'),
                        Button::make('print')->addClass('btn-primary'),
                        Button::make('reset')->addClass('btn-primary')->text('<i class="fas fa-sync-alt fa-fw"></i> Refresh')
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
            Column::make('id')->footer('ID')->title('ID'),
            Column::make('name')->footer('Name'),
            Column::make('phone')->footer('Phone'),
            Column::make('type')->footer('Type'),
            Column::make('taxable')->footer('Taxable'),
            Column::computed('actions')->exportable(false)->printable(false)->orderable(false)->searchable(false)->class("text-right")->footer("Actions")
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Customers_' . date('YmdHis');
    }
}
