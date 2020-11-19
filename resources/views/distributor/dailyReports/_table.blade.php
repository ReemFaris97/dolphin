<!--begin: Datatable -->


{{--'name', 'phone', 'email', 'password', 'image', 'job', 'nationality', 'company_name', 'blocked_at', 'is_admin',--}}

<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
    <tr>
        <th>#</th>
        <th>إسم المندوب</th>
        <th>المبالغ النقدية</th>
        <th>قيمة المصروفات</th>
        <th>الصورة</th>
        <th>الاعدادت</th>
    </tr>
    </thead>
    <tbody>
    @foreach($dailyReports as $row)
        <tr>
            <td>{!!$loop->iteration!!}</td>
            <td>{!! optional($row->user)->name !!}</td>
            <td>{!! $row->cash !!}</td>
            <td>{!! $row->expenses !!}</td>
            <td>
                <img src="{!!asset($row->image)!!}" height="100" width="100"/>
            </td>

            <td>
               <a href="{!!route('distributor.dailyReports.show',$row->id)!!}" class="btn btn-warning"> <i class="fas fa-book"></i> تفاصيل</a>

                <a href="#"  onclick="Delete({{$row->id}})"  data-original-title="حذف" class="btn btn-danger btn-circle"><i  class="fa fa-trash"></i> حذف</a>
                {!!Form::open( ['route' => ['distributor.dailyReports.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
                {!!Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>

</table>
