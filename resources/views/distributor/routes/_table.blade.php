<!--begin: Datatable -->


{{--'name', 'phone', 'email', 'password', 'image', 'job', 'nationality', 'company_name', 'blocked_at', 'is_admin',--}}

<table class="table table-striped- table-bordered table-hover table-checkable dataTable">
    <thead>
    <tr>
        <th>#</th>

        <th>اسم المسار</th>
        <th>اسم مستودع</th>
        <th>الحاله</th>
        <th class="noExport">الاعدادت</th>
    </tr>
    </thead>
    <tbody>
    @foreach($routes as $row)
        <tr>
            <td>{!!$loop->iteration!!}</td>

            <td>{!!$row->name!!}</td>
            <td>{!!optional($row->user)->name!!}</td>
            <td>{!!$row->is_active?"مفعل":"غير مفعل"!!}</td>
            <td>
                <a href="{!!route('distributor.routes.show',$row->id)!!}" class="btn btn-success"> <i
                        class="fas fa-eye"></i>مشاهدة</a>
                <a href="{!!route('distributor.routes.edit',$row->id)!!}" class="btn btn-primary"> <i
                        class="fas fa-pen"></i> تعديل</a>
                <a href="#" onclick="Delete({{$row->id}})" data-original-title="حذف"
                   class="btn btn-danger btn-circle"><i class="fa fa-trash"></i> حذف</a>
                {!!Form::open( ['route' => ['distributor.routes.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
                {!!Form::close() !!}


            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
    <th>#</th>

<th>اسم المسار</th>
<th>اسم مستودع</th>
<th>الحاله</th>
<th class="noExport">الاعدادت</th>
    </tr>
    </tfoot>
</table>
