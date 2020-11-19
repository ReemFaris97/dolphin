<!--begin: Datatable -->


{{--'name', 'phone', 'email', 'password', 'image', 'job', 'nationality', 'company_name', 'blocked_at', 'is_admin',--}}

<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
    <tr>
        <th>#</th>
        <th> رقم الفاتورة</th>
        <th> اسم العميل </th>
        <th>تاريخ الفاتوره </th>
        <th>إسم المندوب</th>
        <th> قيمة الفاتورة</th>
        <th> حالة  الفاتورة</th>
        <th>الاعدادت</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bills as $row)

        <tr>
            <td>{!!$loop->iteration!!}</td>
            <td>000{!! $row->id!!}</td>
            <td>{!!$row->routetrip->client->name  !!}</td>
            <td>{!! $row->created_at !!}</td>
            <td>{!! $row->user->name !!}</td>
            <td>{!!$row->cash  !!}</td>
            <td>
                @if($row->routetrip->status=='accepted')
              <label class="btn btn-success"> تم القبول</label>
                    @else
                    <label class="btn btn-danger"> تم الرفض</label>
                @endif
            </td>
            <td>
               <a href={!!route('distributor.bills.show',$row->id)!!}" class="btn btn-warning"> <i class="fas fa-book"></i> تفاصيل</a>
                <a href="{!!route('distributor.bills.edit',$row->id)!!}" class="btn btn-primary"> <i class="fas fa-pen"></i> تعديل</a>
                <a href="#"  onclick="Delete({{$row->id}})"  data-original-title="حذف" class="btn btn-danger btn-circle"><i  class="fa fa-trash"></i> حذف</a>
                {!!Form::open( ['route' => ['distributor.bills.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}

                {!!Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
{{--    <tfoot>--}}
{{--    <tr>--}}
{{--        <th>#</th>--}}
{{--        <th>الاسم</th>--}}
{{--        <th>الاعدادت</th>--}}
{{--    </tr>--}}
{{--    </tfoot>--}}
</table>
