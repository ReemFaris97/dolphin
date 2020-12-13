<!--begin: Datatable -->


{{--'name', 'phone', 'email', 'password', 'image', 'job', 'nationality', 'company_name', 'blocked_at', 'is_admin',--}}

<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
    <tr>
        <th>#</th>

        <th>اسم المسار</th>
        <th>العنوان </th>
        <th> الترتيب</th>
        <th class="noExport">الاعدادت</th>
    </tr>
    </thead>
    <tbody>
    @foreach($trips as $row)
        <tr>
            <td>{!!$loop->iteration!!}</td>
            <td>{!!$row->route->name!!}</td>
            <td>{!!$row->address!!}</td>
            <td>{!!$row->arrange!!}</td>

            <td>
                <a href="{!!route('distributor.trips.edit',$row->id)!!}" class="btn btn-primary"> <i class="fas fa-pen"></i> تعديل</a>
                <a href="#"  onclick="Delete({{$row->id}})"  data-original-title="حذف" class="btn btn-danger btn-circle"><i  class="fa fa-trash"></i> حذف</a>
                {!!Form::open( ['route' => ['distributor.trips.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
                {!!Form::close() !!}

            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
    <th>#</th>

        <th>اسم المسار</th>
        <th>العنوان </th>
        <th> الترتيب</th>
        <th class="noExport">الاعدادت</th>
    </tr>
    </tfoot>
</table>
