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

</table>

{{--

<table class="table table-striped table-bordered table-responsive ">
    <thead>
    <tr>
        <th> الصنف</th>

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
</table>--}}
