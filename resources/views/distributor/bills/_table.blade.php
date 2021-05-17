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
        <th> نوع الفاتورة</th>
        <th> حاله سداد الفاتورة</th>
        <th class="noExport">الاعدادت</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bills as $row)

        <tr>
            <td>{!!$loop->iteration!!}</td>
            <td>{!! $row->invoice_number!!}  </td>
            <td>{!!optional(optional($row->route_trip)->client)->name  !!}</td>
           <td>{!! $row->created_at->format('Y-m-d h:m A') !!}</td>
            <td>{!! optional($row->route_trip)->route->user->name !!}</td>
            <td>{!!$row->cash !!}</td>
            <td>
                @if(optional($row->inventory)->type=='accept')
              <label class="btn btn-success"> تم القبول</label>
                    @else
                    <label class="btn btn-danger"> تم الرفض</label>
                @endif
            </td>
            <td>
                @if($row->created_at==$row->paid_at)
                    <label class="btn btn-success"> كاش</label>
                @elseif($row->paid_at!=null && $row->created_at!=$row->paid_at)
                    <label class="btn btn-danger"> أجل مسددة </label>
                @elseif($row->paid_at==null)
                    <label class="btn btn-danger"> أجل</label>
                @endif
            </td>
            <td>
                @if($row->created_at==$row->paid_at)
                    <label class="btn btn-success"> تم السداد</label>
                @elseif($row->paid_at!=null && $row->created_at!=$row->paid_at)
                    <label class="btn btn-success"> تم السداد </label>
                @elseif($row->paid_at==null)
                    <label class="btn btn-danger">غير مسدده </label>

                    <a href="#"  onclick="pay({{$row->id}},{{$row->cash}})"  data-original-title="سداد" class="btn btn-outline-danger btn-circle"><i  class="fa fa-coins"></i> سداد</a>
                    {!!Form::open( ['route' => ['distributor.bills.pay',$row->id] ,'id'=>'pay-form'.$row->id, 'method' => 'get']) !!}
                    {!!Form::close() !!}

                @endif
            </td>
            <td>
               <a href="{!!route('distributor.bills.show',$row->id)!!}" class="btn btn-warning"> <i class="fas fa-book"></i> الفاتوره</a>
                <a href="{!!route('distributor.bills.images',$row->id)!!}" class="btn btn-warning"> <i class="fas fa-book"></i>صور الجرد</a>
                <a href="{!!route('distributor.bills.edit',$row->id)!!}" class="btn btn-primary"> <i class="fas fa-pen"></i> تعديل</a>
                <a href="#"  onclick="Delete({{$row->id}})"  data-original-title="حذف" class="btn btn-danger btn-circle"><i  class="fa fa-trash"></i> حذف</a>
                {!!Form::open( ['route' => ['distributor.bills.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
                {!!Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
    <th>#</th>
    <th> رقم الفاتورة</th>
    <th> اسم العميل </th>
    <th>تاريخ الفاتوره </th>
    <th>إسم المندوب</th>
    <th> قيمة الفاتورة</th>
    <th> حالة  الفاتورة</th>
    <th> نوع الفاتورة</th>
    <th> حاله سداد الفاتورة</th>
    <th class="noExport">الاعدادت</th>
</table>
