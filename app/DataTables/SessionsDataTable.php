<?php

namespace App\DataTables;

use App\Models\AccountingSystem\AccountingSession;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SessionsDataTable extends DataTable
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
            ->addColumn("code", fn($session) => $session->code)
            ->addColumn("device", fn($session) => $session->device?->code)
            ->addColumn("shift", fn($session) => $session->shift?->name)
            ->addColumn("user", fn($session) => $session->user?->name)
            ->addColumn(
                "start_session",
                fn($session) => $session->start_session
            )
            ->addColumn("end_session", fn($session) => $session->end_session)
            ->addColumn("custody", fn($session) => $session->custody)
            ->addColumn(
                "status",
                fn($session) => view("AccountingSystem.sessions.status", [
                    "row" => $session,
                ])->render()
            )
            ->addColumn(
                "action",
                fn($session) => view("AccountingSystem.sessions.actions", [
                    "row" => $session,
                ])->render()
            )
            ->rawColumns(["action", "status"]);
    }

    /**
     * Get query source of dataTable
     */
    public function query()
    {
        $sessions = AccountingSession::with([
            "user",
            "shift",
            "device",
        ])->latest();
        return $sessions;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                ->setTableId("sessions-table")
                ->addTableClass("finalTb table datatable-button-init-basic")
                ->columns($this->getColumns())
                ->minifiedAjax()
                ->dom("Bfrtip");
            //  ->orderBy(1)
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
            Column::make("code")
                ->title(" رقم  الجلسة  ")
                ->addClass("text-center"),
            Column::make("device")
                ->title("كود الجهاز  ")
                ->addClass("text-center"),
            Column::make("shift")
                ->title("اسم الوردية ")
                ->addClass("text-center"),
            Column::make("user")
                ->title("اسم الكاشير   ")
                ->addClass("text-center"),
            Column::make("start_session")
                ->title(" بداية الجلسة")
                ->addClass("text-center"),
            Column::make("end_session")
                ->title(" نهاية الجلسة   ")
                ->addClass("text-center"),
            Column::make("custody")
                ->title("العهده   ")
                ->addClass("text-center"),
            Column::make("status")
                ->title("اغلاق  الجلسه    للكاشير     ")
                ->addClass("text-center"),
            Column::computed("action", "العمليات")
                ->addClass("text-center")
                ->width(200),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return "Sessions_" . date("YmdHis");
    }
}
