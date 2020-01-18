<table class="table">
    <th>   اسم المنتج  </th>

    <th> الكميه </th>
    <th>  السعر </th>


    <tbody>
        @foreach($items as $row)
        <tr class="parent-tr">
            <td>{!! $row->product->name!!}</td>
            <td>{!! $row->quantity!!}</td>
            <td><input type="number"  name="quantity"   class="form-control quantity" placeholder="ادخل الكمية"></td>

            <td>{!! $row->price!!}</td>
             </tr>
             @endforeach

    </tbody>

</table>



