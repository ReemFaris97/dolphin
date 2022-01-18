<?php

namespace App\DataTables;

use App\Models\AccountingSystem\AccountingPurchase;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AccountingPurchasesDataTable extends DataTable
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
            ->addColumn('id', fn($invoice) => $invoice->id)
            ->addColumn('supplier_id', fn($invoice) => $invoice->supplier->name)
            ->addColumn('created_at', fn($invoice) => $invoice->created_at)
            ->addColumn('total', fn($invoice) => $invoice->total)
            ->addColumn('action', fn($invoice) => view('AccountingSystem.purchases.action', ['row' => $invoice])->render())
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *

     */
    public function query(AccountingPurchase $model)
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
                    ->setTableId('accountingpurchases-table')
            ->addTableClass('finalTb table datatable-button-init-basic')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
//                    ->buttons(
//                        Button::make('create'),
//                        Button::make('export'),
//                        Button::make('print'),
//                        Button::make('reset'),
//                        Button::make('reload')
//                    )
            ;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->title('رقم الفاتورة')->addClass('text-center'),
            Column::make('supplier_id')->title('اسم المورد  ')->addClass('text-center'),
            Column::make('created_at')->title('تاريخ الفاتورة')->addClass('text-center'),
            Column::make('total')->title('قيمة الفاتورة')->addClass('text-center'),
            Column::computed('action', 'العمليات')->addClass('text-center')->width(250),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'AccountingPurchases_' . date('YmdHis');
    }
}
