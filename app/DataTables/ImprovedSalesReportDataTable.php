<?php

namespace App\DataTables;

use App\Models\AccountingSystem\AccountingSaleItem;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ImprovedSalesReportDataTable extends DataTable
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
            ->addColumn("name", fn($sale) => $sale->product->name)
            ->addColumn(
                "unit",
                fn($sale) => $sale->unit->name ?? $sale->product->main_unit
            )
            ->addColumn("quantity", fn($sale) => $sale->quantity)
            ->addColumn("price", fn($sale) => $sale->price)
            ->addColumn("total", fn($sale) => $sale->total);
    }

    /**
     * Get query source of dataTable.
     *
     */
    public function query()
    {
        $sales = AccountingSaleItem::query()->with("product", "unit");

        $sales->when(\request()->has("product_id"), function ($q) {
            $q->where("product_id", \request("product_id"));
        });

        $sales->when(\request("from") and \request("to"), function ($q) {
            $q->whereBetween("created_at", [\request("from"), \request("to")]);
        });

        $sales = $sales
            ->groupBy("product_id", "unit_id", "price")
            ->selectRaw(
                "product_id,sum(quantity) as quantity,price,(price * sum(quantity)) as total,unit_id"
            );

        return $sales;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                ->setTableId("improvedsalesreport-table")
                ->addTableClass("finalTb table datatable-button-init-basic")
                ->columns($this->getColumns())
                ->minifiedAjax()
                ->dom("Bfrtip")
                ->orderBy(1);
            //                    ->buttons(
            //                        Button::make('create'),
            //                        Button::make('export'),
            //                        Button::make('print'),
            //                        Button::make('reset'),
            //                        Button::make('reload')
            //                    )
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
                ->title("اسم المنتج")
                ->addClass("text-center"),
            Column::make("unit")
                ->title("الوحدة ")
                ->addClass("text-center"),
            Column::make("quantity")
                ->title("الكمية")
                ->addClass("text-center"),
            Column::make("price")
                ->title("السعر")
                ->addClass("text-center"),
            Column::make("total")
                ->title("الاجمالى")
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
        return "ImprovedSalesReport_" . date("YmdHis");
    }
}
