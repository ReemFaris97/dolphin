<!--begin: Datatable -->


{{--'name', 'phone', 'email', 'password', 'image', 'job', 'nationality', 'company_name', 'blocked_at', 'is_admin',--}}

<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
    <tr>
        <th>#</th>
        <th>الكود</th>
        <th>الاسم</th>
        <th>الهاتف</th>
        <th>البريد الالكترونى</th>
        <th>إسم المتجر</th>
        <th>إسم المندوب</th>
        <th>إسم المسار</th>
        <th> الحالة</th>
        <th> صورة العميل</th>
        <th>الاعدادت</th>
    </tr>
    </thead>
    <tbody>
    @foreach($clients as $user)
        <tr>
            <td>{!!$loop->iteration!!}</td>
              <td>{!!$user->code!!}</td>
            <td>{!!$user->name!!}</td>
            <td>{!!$user->phone!!}</td>
            <td>{!!$user->email!!}</td>
            <td>{!!$user->store_name !!}</td>
            <td>{!!$user->user->name!!}</td>
            <td>{!!$user->route->name!!}</td>


            <td>
                @if ($user->is_active==0)
                    <span class="lable lable-danger">غير مفعل</span>
                   <a href="{{route("distributor.client.active",$user->id)}}" class="btn btn-success btn-circle">
                            <i class="fas fa-check"></i>
                        </a>

                    @else
                    <span class="lable lable-success"> مفعل</span>
                    <a href="{{route("distributor.client.dis_active",$user->id)}}" class="btn btn-danger btn-circle">
                        <i class="fas fa-times"></i>
                    </a>
                @endif


            </td>

            <td><img src="{!!asset($user->image)!!}" height="100" width="100"/></td>
            <td>
                <a href="{!!route('distributor.clients.edit',$user->id)!!}" class="btn btn-primary"> <i class="fas fa-pen"></i> تعديل</a>
                <a href="#"  onclick="Delete({{$user->id}})"  data-original-title="حذف" class="btn btn-danger btn-circle"><i  class="fa fa-trash-o"></i> حذف</a>
                {!!Form::open( ['route' => ['distributor.clients.destroy',$user->id] ,'id'=>'delete-form'.$user->id, 'method' => 'Delete']) !!}
                {!!Form::close() !!}


            </td>

        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>#</th>
        <th>الصوره</th>
        <th>الاسم</th>
        <th>الهاتف</th>
        <th>البريد الالكترونى</th>
        <th> الحالة</th>
        <th> صورة العميل</th>
        <th>الاعدادت</th>
    </tr>
    </tfoot>
</table>
