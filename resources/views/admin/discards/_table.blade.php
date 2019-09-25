<!--begin: Datatable -->


{{--'name', 'phone', 'email', 'password', 'image', 'job', 'nationality', 'company_name', 'blocked_at', 'is_admin',--}}

<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
    <tr>
        <th>#</th>
        <th>إسم المستخدم</th>
        <th>إسم المورد</th>
        <th>سبب المرتجع</th>
        <th>نوع السداد</th>
        <th>التاريخ</th>
        <th>الاعدادت</th>
    </tr>
    </thead>
    <tbody>
    @foreach($suppliers_discards as $row)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$row->user->name}}</td>
            <td>{{$row->supplier->name}}</td>
            <td>{{$row->reason}}</td>
            <td>
                @switch($row->return_type)
                    @case('cash')   كاش    @break
                    @case('switch')  بدل   @break
                    @case('decrease') إنقاص مديونية  @break
                @endswitch
            </td>
            <td>{{$row->date}}</td>
            <td>
                <a href="{!!route('admin.suppliers-discards.show',$row->id)!!}" class="btn btn-info"> <i class="fas fa-eye"></i>مشاهده</a>
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>#</th>
        <th>إسم المستخدم</th>
        <th>إسم المورد</th>
        <th>سبب المرتجع</th>
        <th>نوع السداد</th>
        <th>التاريخ</th>
        <th>الاعدادت</th>
    </tr>
    </tfoot>
</table>
