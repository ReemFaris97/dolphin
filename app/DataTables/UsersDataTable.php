<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
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
            ->addColumn("name", fn($user) => $user->name)
            ->addColumn("phone", fn($user) => $user->phone)
            ->addColumn("email", fn($user) => $user->email)
            ->addColumn("email", fn($user) => $user->email)
            ->addColumn(
                "image",
                '<img src="{{asset($image)}}" style="width:100px; height:100px">'
            )
            ->addColumn(
                "action",
                fn($user) => view("AccountingSystem.users.action", [
                    "row" => $user,
                ])->render()
            )
            ->rawColumns(["action", "image"]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
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
                ->setTableId("users-table")
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
                ->title("اسم العضو")
                ->addClass("text-center"),
            Column::make("phone")
                ->title("  جوال العضو")
                ->addClass("text-center"),
            Column::make("email")
                ->title("ايميل العضو  ")
                ->addClass("text-center"),
            Column::computed("image")
                ->title("صورة العضو  ")
                ->addClass("text-center"),
            Column::computed("action", "العمليات")
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
        return "Users_" . date("YmdHis");
    }
}
