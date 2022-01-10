<?php

namespace App\DataTables;

use App\Models\AccountingSystem\AccountingSupplier;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AccountingSuppliersDataTable extends DataTable
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
            ->addColumn('name', fn($supplier) => $supplier->name)
            ->addColumn('balance', fn($supplier) => $supplier->balance)
            ->addColumn('companies', fn($supplier) => view('AccountingSystem.suppliers.companies', ['row' => $supplier])->render())
            ->addColumn('action', fn($supplier) => view('AccountingSystem.suppliers.action', ['row' => $supplier])->render())
            ->rawColumns(['action', 'companies']);
    }

    /**
     * Get query source of dataTable.
     *
     */
    public function query(AccountingSupplier $model)
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
            ->setTableId('accountingsuppliers-table')
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
            Column::make('name')->title('اسم المورد')->addClass('text-center'),
            Column::make('balance')->title('رصيد المورد')->addClass('text-center'),
            Column::make('companies')->title('الشركات الموردة')->addClass('text-center'),
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
        return 'AccountingSuppliers_' . date('YmdHis');
    }
}
