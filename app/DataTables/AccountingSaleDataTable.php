<?php

namespace App\DataTables;

use App\Models\AccountingSystem\AccountingSale;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AccountingSaleDataTable extends DataTable
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
            ->editColumn("created_at", function ($q) {
                return $q->created_at->toDateTimeString();
            })
            ->addColumn("action", "AccountingSystem.sales.actions");
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\AccountingSale $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function extraQuery($array = null)
    {
        return $array;
    }
    public function query(AccountingSale $model)
    {
        return $model->newQuery()->latest();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId("accountingsale-table")
            ->addTableClass("finalTb")
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("Bfrtip")
            ->orderBy(1)
            ->responsive(true)
            ->buttons(
                Button::make("export"),
                Button::make("print"),
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
            Column::make("id")->title("رقم الفاتورة"),
            Column::make("amount")->title("المبلغ"),
            Column::make("created_at")->title("تاريخ الانشاء"),
            Column::computed("action")
                ->exportable(false)
                ->printable(false)
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
        return "AccountingSale_" . date("YmdHis");
    }
}
