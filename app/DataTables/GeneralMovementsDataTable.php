<?php

namespace App\DataTables;

use App\Models\AccountingSystem\AccountingProduct;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class GeneralMovementsDataTable extends DataTable
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
            ->addColumn("name", fn($row) => $row->name)
            ->addColumn("items_count", fn($row) => $row->items->count())
            ->addColumn("items_sum", fn($row) => $row->items->sum("quantity"))
            ->addColumn("purchases_count", fn($row) => $row->purchase->count())
            ->addColumn(
                "purchases_sum",
                fn($row) => $row->purchase->sum("quantity")
            );
    }

    /**
     * Get query source of dataTable.
     *
     */
    public function query()
    {
        $accounting_products = AccountingProduct::query();

        $accounting_products
            ->haveMovementBetween(
                \request("from") ?? now()->toDateString(),
                \request("to") ?? now()->toDateString()
            )
            ->get();

        return $accounting_products;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                ->setTableId("generalmovements-table")
                ->addTableClass("finalTb table datatable-button-init-basic")
                ->columns($this->getColumns())
                ->minifiedAjax()
                ->dom("Bfrtip")
                ->orderBy(1);
            //            ->buttons(
            //                Button::make('create'),
            //                Button::make('export'),
            //                Button::make('print'),
            //                Button::make('reset'),
            //                Button::make('reload')
            //            )
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make("name")
                ->title("المنتج")
                ->addClass("text-center"),
            Column::make("items_count")
                ->title("  اجمالى  فواتير المبيعات  ")
                ->addClass("text-center"),
            Column::make("items_sum")
                ->title("اجمالى كمية المبيعات")
                ->addClass("text-center"),
            Column::make("purchases_count")
                ->title("اجمالى فواتير المشتريات")
                ->addClass("text-center"),
            Column::make("purchases_sum")
                ->title("اجمالى كمية المشتريات")
                ->addClass("text-center"),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return "GeneralMovements_" . date("YmdHis");
    }
}
