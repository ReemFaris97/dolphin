<table class="table table-striped table-bordered edit-th-50 table-responsive ">
    <thead>
    <tr>
        <th rowspan="2" class="align-center text-center">الصنف</th>
        @foreach($sales_distributors as $distributor)
            <th colspan="2">{!!$distributor->name!!}</th>
        @endforeach
    </tr>
    <tr>
        <th class="d-none hidden"></th>
        @foreach($sales_distributors as $name)
            <th>الكمية</th>
            <th> قيمة العملية</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($sales as $id=>$product_sales_group)
        <tr>
            <td>{!!$product_sales_group->first()->product->name!!}</td>
            @foreach($sales_distributors as $dist)
                <td>{!!$product_sales_group->where('name',$dist->name)->sum('quantity_in_package')??0!!}</td>
                <td>{!!round($product_sales_group->where('name',$dist->name)->sum(fn($p)=>$q->price * $q->quantity),3)??0!!}</td>
            @endforeach
        </tr>
    @endforeach

    </tbody>

</table>
