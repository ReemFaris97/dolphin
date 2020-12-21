<!--begin: Datatable -->


{{--'name', 'phone', 'email', 'password', 'image', 'job', 'nationality', 'company_name', 'blocked_at', 'is_admin',--}}

<table class="table table-striped- table-bordered table-hover table-checkable dataTable" id="m_table_1">
    <thead>
    <tr>
        <th>#</th>

        <th>اسم المسار</th>
        <th>اسم المندوب</th>
{{--        <th>الحاله</th>--}}
        <th class="noExport">الاعدادت</th>
    </tr>
    </thead>
    <tbody>
    @foreach($routes as $row)
        <tr>
            <td>{!!$loop->iteration!!}</td>

            <td>{!!$row->name!!}</td>
            <td>{!!optional($row->user)->name!!}</td>
{{--            <td>{!!$row->is_active?"مفعل":"غير مفعل"!!}</td>--}}
            <td>
                @if ($row->is_available==0)
                    <span class="lable lable-danger">غير متاح</span>
                    <a href="{{route('distributor.routes.available',$row->id)}}" class="btn btn-success btn-circle">
                        <i class="fas fa-check"></i>
                    </a>

                @else
                    <span class="lable lable-success">متاح</span>
                    <a href="{{route("distributor.routes.dis_available",$row->id)}}" class="btn btn-danger btn-circle">
                        <i class="fas fa-times"></i>
                    </a>
                @endif
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
        <th>اسم المندوب</th>
{{--        <th>الحاله</th>--}}
        <th class="noExport">الاعدادت</th>
    </tr>
    </tfoot>
</table>
