<!--begin: Datatable -->


{{--'name', 'phone', 'email', 'password', 'image', 'job', 'nationality', 'company_name', 'blocked_at', 'is_admin',--}}

<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
    <tr>
        <th>#</th>
        <th>نوع المخزن</th>
        <th>الاسم</th>
        <th>الاعدادت</th>
    </tr>
    </thead>
    <tbody>
    @foreach($stores as $row)
        <tr>
            <td>{!!$loop->iteration!!}</td>
            <td>{!!$row->category->name!!}</td>
            <td>{!!$row->name!!}</td>
            <td>
                <a href="{!!route('distributor.stores.edit',$row->id)!!}" class="btn btn-primary"> <i class="fas fa-pen"></i> تعديل</a>
                <a href="#"  onclick="Delete({{$row->id}})"  data-original-title="حذف" class="btn btn-danger btn-circle"><i  class="fa fa-trash-o"></i> حذف</a>
                {!!Form::open( ['route' => ['distributor.stores.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
                {!!Form::close() !!}

            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>#</th>
        <th>الاسم</th>
        <th>الاعدادت</th>
    </tr>
    </tfoot>
</table>
