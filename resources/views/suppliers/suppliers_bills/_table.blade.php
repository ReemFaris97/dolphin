<!--begin: Datatable -->

<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
    <tr>
        <th>#</th>
        <th>إسم المستخدم</th>
        <th>إسم المورد</th>
        <th>رقم الفاتورة</th>
        <th>تاريخ الفاتورة</th>
        <th>نوع السداد</th>
        <th>إجمالي الفاتورة</th>
        <th>الاعدادت</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bills as $row)
        <tr>
            <td>#</td>
            <td>{{$row->user->name}}</td>
            <td>{{$row->supplier->name}}</td>
            <td>{{$row->bill_number}}</td>
            <td>{{$row->date}}</td>
            <td>{{$row->payment_method=="cash"?'كاش':'آجل'}}</td>
            <td>{{$row->total()}}</td>
            <td>
                <a href="{!!route('supplier.suppliers-bills.show',$row->id)!!}" class="btn btn-info"> <i
                        class="fas fa-eye"></i>مشاهده</a>
            </td>
        </tr>
    @endforeach
    </tbody>

</table>
