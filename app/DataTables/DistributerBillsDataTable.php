<?php

namespace App\DataTables;

use App\Models\RouteTripReport;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DistributerBillsDataTable extends DataTable
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
            ->addColumn("invoice_number", fn($bill) => $bill->invoice_number)
            ->addColumn(
                "client_name",
                fn($bill) => optional(optional($bill->route_trip)->client)->name
            )
            ->addColumn(
                "created_at",
                fn($bill) => $bill->created_at->format("Y-m-d h:m A")
            )
            ->addColumn(
                "user_name",
                fn($bill) => optional($bill->route_trip)->route->user->name
            )
            ->addColumn("total", fn($bill) => $bill->product_total())
            ->addColumn(
                "bill_status",
                fn($bill) => optional($bill->inventory)->type == "accept"
                    ? '<label class="btn btn-success"> تم القبول</label>'
                    : '<label class="btn btn-danger"> تم الرفض</label>'
            )
            ->addColumn(
                "bill_type",
                fn($bill) => view("distributor.bills.bill_type", [
                    "row" => $bill,
                ])->render()
            )
            ->addColumn(
                "bill_paid",
                fn($bill) => view("distributor.bills.bill_paid", [
                    "row" => $bill,
                ])->render()
            )
            ->addColumn(
                "action",
                fn($bill) => view("distributor.bills.actions", [
                    "row" => $bill,
                ])->render()
            )

            ->rawColumns(["bill_status", "bill_type", "bill_paid", "action"]);
    }

    /**
     * Get query source of dataTable.
     *

     */
    public function query(RouteTripReport $model)
    {
        $bills = RouteTripReport::with([
            "inventory",
            "products",
            "route_trip" => function ($builder) {
                $builder->with([
                    "route" => function ($q) {
                        $q->with("user");
                    },
                    "client",
                ]);
            },
        ])->latest();

        return $bills;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                ->setTableId("distributerbills-table")
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
            Column::computed("invoice_number")
                ->title("رقم الفاتورة ")
                ->addClass("text-center"),
            Column::make("client_name")
                ->title("اسم العميل  ")
                ->addClass("text-center"),
            Column::make("created_at")
                ->title("تاريخ الفاتورة  ")
                ->addClass("text-center"),
            Column::make("user_name")
                ->title("اسم المندوب ")
                ->addClass("text-center"),
            Column::make("total")
                ->title("قيمة الفاتورة   ")
                ->addClass("text-center"),
            Column::make("bill_status")
                ->title("حالة الفاتورة   ")
                ->addClass("text-center"),
            Column::make("bill_type")
                ->title("نوع الفاتورة   ")
                ->addClass("text-center"),
            Column::make("bill_paid")
                ->title("حالة سداد الفاتورة   ")
                ->addClass("text-center"),
            Column::computed("action", "الاعدادات")
                ->addClass("text-center")
                ->width(250),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return "DistributerBills_" . date("YmdHis");
    }
}
