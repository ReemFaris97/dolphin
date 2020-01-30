<table class="table">
    <th>  رقم الفاتورة</th>
    <th>  تاريخ الفاتوره</th>
    <th>  العميل </th>
    <th>  اجمالى </th>
    <th>  عرض  التفاصيل </th>

    <tbody>
        <tr class="parent-tr">
        <td>{{$purchase->id}}</td>
        <td>{{$purchase->created_at}}</td>
        <td>{{$purchase->client->name}}</td>
        <td>{{$purchase->total}}</td>
        <td>
            <a href="javascript:;" id="" class="btn btn-danger" onclick="show({{$purchase->id}})">عرض الفاتورة</a>
        </td>
             </tr>
    </tbody>

</table>



