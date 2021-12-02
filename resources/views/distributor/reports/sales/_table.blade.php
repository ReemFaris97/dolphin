<table class="table table-striped table-bordered edit-th-50 table-responsive ">
    <thead>
    <tr>
        <!-- <th rowspan="2" class="text-center">  </th> -->
        @foreach($sales_distributors as $distributor)
            <th colspan="3">{!!$distributor->name!!}</th>
        @endforeach
    </tr>
    <tr>
        @foreach($sales_distributors as $name)
            <th>الصنف</th>
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
                <td>{!!$product_sales_group->where('name',$dist->name)->sum('quantity')??0!!}</td>
                <td>{!!$product_sales_group->where('name',$dist->name)->sum('price')??0!!}</td>
            @endforeach
        </tr>
    @endforeach

    </tbody>

</table>
