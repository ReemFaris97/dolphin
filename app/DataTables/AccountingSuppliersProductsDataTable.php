<?php

namespace App\DataTables;

use App\Models\AccountingSystem\AccountingProduct;
use App\Models\Supplier\Product;
use Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AccountingSuppliersProductsDataTable extends DataTable
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
            ->filterColumn("name", function ($query, $name) {
                $query->where(
                    fn($q) => $q
                        ->where("name", "like", "%$name%")
                        ->orWhere("en_name", "like", "%$name%")
                );
            })
            ->addIndexColumn()
            ->smart(false)

            ->addColumn(
                "image",
                '<img src="{{getimg($image)}}" style="width:100px; height:100px">'
            )
            ->addColumn("action", "AccountingSystem.suppliers-products.actions")
            ->rawColumns(["image", "action"])
            ->escapeColumns([5]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\AccountingProduct $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
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
            ->setTableId("accountingproducts-table")
            ->addTableClass("finalTb table datatable-button-init-basic")
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("Bfrtip")
            ->buttons(
                //Button::make('create'),
                //  Button::make('export'),
                // Button::make('print'),
                Button::make("reset"),
                Button::make("reload")
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
            Column::computed("image")->width(60),
            Column::make("name")->title("الاسم"),
            Column::make("barcode")->title("الباركود"),
            Column::make("unit")->title("الوحده "),
            Column::make("price")->title("سعر البيع"),
            Column::computed("action", "الاعدادات")->addClass("text-center"),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return "AccountingProducts_" . date("YmdHis");
    }
}
