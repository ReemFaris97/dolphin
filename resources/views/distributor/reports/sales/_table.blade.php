{{-- <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
    <tr>
        <th>#</th>
        <th> كود العملية</th>
        <th>تاريخ ووقت العملية</th>
        <th> قيمة العملية</th>
    </tr>
    </thead>
    <tbody>
    @foreach($transactions as $row)
        <tr>
            <td> {!!$loop->iteration!!}</td>
            <td><a href="{{route('distributor.reports.sales.show',$row->id) }}">{!!$row->invoice_number!!}</a></td>
            <td>{!!$row->created_at!!}</td>
            <td>{!!$row->amount!!}</td>


        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>#</th>
        <th> كود العملية</th>
        <th>تاريخ ووقت العملية</th>
        <th> قيمة العملية</th>
    </tr>
    </tfoot>
</table>



<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
    <tr>
        <th>#</th>
        <th> كود العملية</th>
        <th>تاريخ ووقت العملية</th>
        <th> قيمة العملية</th>
    </tr>
    </thead>
    <tbody>
    @foreach($transactions as $row)
        <tr>
            <td> {!!$loop->iteration!!}</td>
            <td><a href="{{route('distributor.reports.sales.show',$row->id) }}">{!!$row->invoice_number!!}</a></td>
            <td>{!!$row->created_at!!}</td>
            <td>{!!$row->amount!!}</td>


        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>#</th>
        <th> كود العملية</th>
        <th>تاريخ ووقت العملية</th>
        <th> قيمة العملية</th>
    </tr>
    </tfoot>
</table> --}}


<table class="table table-striped table-bordered table-responsive ">
    <thead>
    <tr>
        <th rowspan="2"> المندوب</th>
@foreach($products as $id=>$name)
        <th colspan="2">{!!$name!!}</th>
@endforeach
    </tr>
    <tr>
        @foreach($products as $id=>$name)

        <th>الكمية</th>
        <th> قيمة العملية</th>
@endforeach
    </tr>
    </thead>
    <tbody>
@foreach($sales as $sale)
<tr>

    <td>{!!$sale->first()->name!!}</td>
    @foreach($products as $id=>$name)
        <td>{!!$sale->where('product_id',$id)->first()->quantity??0!!}</td>
        <td>{!!$sale->where('product_id',$id)->first()->price??0!!}</td>
    @endforeach
</tr>
@endforeach
@foreach($sales_distributors as $distributor)
<tr>

    <td>{!!$distributor->name!!}</td>
    @foreach($products as $id=>$name)
        <td>0</td>
        <td>0</td>
    @endforeach
</tr>
@endforeach
</tbody>
    <tfoot>

</table>
