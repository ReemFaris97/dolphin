<table class="table">
    <th>   اسم المنتج  </th>

    <th> الكميه </th>
    <th>  السعر </th>
    <th>  الحذف </th>

    <tbody>
        @foreach($items as $row)
        <tr class="parent-tr">
        <input type="hidden" data-id="{{$row->product->id}}">
            <td>{!! $row->product->name!!}</td>
            <td><input type="number" name="quantity" class="form-control quantity" value="{{$row->quantity}}" min="0" max="{{$row->quantity}}"></td>
            <td>{!! $row->price!!}</td>
            <td>
                <a href="javascript:;" id="{{$row->id}}" class="removeProduct btn btn-danger waves-effect waves-light btn-xs m-b-5">حذف</a>
            </td>
             </tr>
             @endforeach

    </tbody>

</table>



