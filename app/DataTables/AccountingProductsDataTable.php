<?php

namespace App\DataTables;

use App\Models\AccountingSystem\AccountingProduct;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AccountingProductsDataTable extends DataTable
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
            ->addIndexColumn()
            ->addColumn('action', fn ($product) =>view('AccountingSystem.products.actions', ['row'=>$product])->render())
            ->addColumn('qunaitity', fn ($product) =>$product->getTotalQuantities())
            ->addColumn('image', '<img src="{{getimg($image)}}" style="width:100px; height:100px">')
            ->rawColumns(['image', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\AccountingProduct $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(AccountingProduct $model)
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
                    ->setTableId('accountingproducts-table')
                    ->addTableClass('finalTb table datatable-button-init-basic')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                   ->buttons(
                        //Button::make('create'),
                      //  Button::make('export'),
                        // Button::make('print'),
                       Button::make('reset'),
                       Button::make('reload')
                   ) ;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('image')
            ->width(60),
            Column::make('name')->title('الاسم'),
            Column::make('en_name')->title('الاسم بالانجليزية'),
            Column::computed('type')
            ->addClass('text-center'),
            Column::computed('qunaitity')->title('الكمية')
            ->addClass('text-center'),
            Column::make('bar_code')->title('الباركود'),
            Column::make('main_unit')->title('الوحده الرئيسة'),
            Column::make('selling_price')->title('سعر البيع'),
            Column::make('purchasing_price')->title('سعر الشراء'),
            Column::computed('action', 'الاعدادات')
            // ->exportable(false)
            // ->printable(false)
            ->addClass('text-center'),



        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'AccountingProducts_' . date('YmdHis');
    }
}