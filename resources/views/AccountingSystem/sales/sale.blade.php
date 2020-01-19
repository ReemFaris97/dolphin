<table class="table">
    <th>  رقم الفاتورة</th>

    <th>  تاريخ الفاتوره</th>
    <th>  العميل </th>
    <th>  اجمالى </th>
    <th>  عرض  التفاصيل </th>

    <tbody>
        <tr class="parent-tr">
        <td>{{$sale->id}}</td>
        <td>{{$sale->created_at}}</td>
        <td>{{$sale->client->name}}</td>
        <td>{{$sale->total}}</td>

        <td>
            <a href="javascript:;" id="" class="btn btn-danger" onclick="show({{$sale->id}})">عرض الفاتورة</a>

        </td>
             </tr>

    </tbody>

</table>



