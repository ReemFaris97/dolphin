<?php

namespace App\DataTables;

use App\Models\AccountingSystem\AccountingProduct;
use Str;
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
            ->filterColumn('barcode', function ($query, $barcode) {
                // $barcode= request()->columns[5]['search']['value'];

                $query->where(function ($builder) use ($barcode) {
                    $barcode= Str::startsWith($barcode, '"') ?  $barcode:'"'.$barcode;
                    $barcode= Str::endsWith($barcode, '"') ?  $barcode:$barcode.'"';
                    $builder->where('bar_code', 'like', "%$barcode%");
                    $builder->orwhereHas(
                        'sub_units',
                        fn ($b) => $b->where('bar_code', 'like', "%$barcode%")
                    );
                });
            })
            ->filterColumn('name', function ($query, $name) {
                $query->where(
                    fn ($q) =>$q
                ->where('name', 'like', "%$name%")
                ->orWhere('en_name', 'like', "%$name%")
                );
            })
            ->addIndexColumn()
            ->smart(false)
            ->addColumn('action', fn ($product) =>view('AccountingSystem.products.actions', ['row'=>$product])->render())
            ->addColumn('qunaitity', fn ($product) =>$product->getTotalQuantities())
            ->addColumn('barcode', fn ($product) =>($product->bar_code!=null)?current($product->bar_code):null)
            ->addColumn('image', '<img src="{{getimg($image)}}" style="width:100px; height:100px">')
            ->rawColumns(['image', 'action','bar_code'])
            ->escapeColumns([5]);
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
            Column::make('barcode')->title('الباركود'),
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
