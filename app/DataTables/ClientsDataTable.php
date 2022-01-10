<?php

namespace App\DataTables;

use App\Models\Client;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ClientsDataTable extends DataTable
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
            ->addColumn('image', '<img src="{{getimg($image)}}" style="width:70px; height:70px">')
            ->addColumn('code', fn($client) => $client->code)
            ->addColumn('name', fn($client) => $client->name)
            ->addColumn('phone', fn($client) => $client->phone)
            ->addColumn('client_class', fn($client) => $client->client_class->name)
            ->addColumn('store_name', fn($client) => $client->store_name)
            ->addColumn('is_active', fn($client) => view('distributor.clients.is_active', ['row' => $client])->render())
            ->addColumn('action', fn($client) => view('distributor.clients.actions', ['row' => $client])->render())
            ->rawColumns(['image', 'action', 'user_image', 'is_active']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Client $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {

        $clients = Client::query()->with(['route', 'client_class', 'user', 'trips']);

        $clients->when(\request()->has('user_id'), function ($q) {
            $q->whereRelation('trips',  function ($query) {
                $query->whereRelation('route',function ($x){
                    $x->whereIn('user_id',\request('user_id'));
                });
            });
        });

        $clients->when(\request()->has('route_id'), function ($q) {
            $q->whereRelation('trips', function ($x){
                $x->whereIn( 'route_id',\request('route_id'));
            });
        });

        $clients->when(\request()->has('class_id'), function ($q) {
            $q->whereIn('client_class_id', \request('class_id'));
        });

        return $clients;

        // return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('clients-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            //  ->orderBy(1)
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
            Column::computed('image')->title('صورة العميل')->addClass('text-center')->width(60),
            Column::make('code')->title('الكود  ')->addClass('text-center'),
            Column::make('name')->title('الاسم  ')->addClass('text-center'),
            Column::make('phone')->title('الهاتف ')->addClass('text-center'),
            Column::make('client_class')->title('شريحة العميل ')->addClass('text-center'),
            Column::make('store_name')->title('اسم المتجر ')->addClass('text-center'),
            Column::make('is_active')->title('الحالة   ')->addClass('text-center'),
            Column::computed('action', 'الاعدادات')
                ->addClass('text-center')->width(200),
        ];
    }


}
