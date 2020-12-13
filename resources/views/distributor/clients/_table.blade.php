<!--begin: Datatable -->


{{--'name', 'phone', 'email', 'password', 'image', 'job', 'nationality', 'company_name', 'blocked_at', 'is_admin',--}}

<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
    <tr>
        <th>#</th>
        <th>صوره العميل</th>
        <th>صوره الوكيل</th>
        <th>الكود</th>
        <th>الاسم</th>
        <th>الهاتف</th>
        {{-- <th>البريد الالكترونى</th> --}}
        <th>إسم المتجر</th>
        <th>إسم المندوب</th>
        <th>إسم المسار</th>
        <th> الحالة</th>
        <th>الاعدادت</th>
    </tr>
    </thead>
    <tbody>

    @foreach($clients as $client)
        <tr>
            <td>{!!$loop->iteration!!}</td>
              <td>
                @if($client->image)
                <img src="{!!asset($client->image)!!}" width="100" height="100"/>
           @else
           لا توجد صوره
           @endif
        </td>
                <td>
                    @if($client->user->image)
                <img src="{!!asset($client->user->image)!!}" width="100" height="100"/>
           @else
           لا توجد صوره
           @endif
                </td>
              <td>{!!$client->code!!}</td>
            <td>{!!$client->name!!}</td>
            <td>{!!$client->phone!!}</td>
            {{-- <td>{!!$client->email!!}</td> --}}
            <td>{!!$client->store_name !!}</td>
            <td>{!!$client->user->name !!}</td>
            <td>{!!$client->route->name!!}</td>

                   <td>
                @if ($client->is_active==0)
                    <span class="lable lable-danger">غير معتمد</span>
                   <a href="{{route("distributor.client.active",$client->id)}}" class="btn btn-success btn-circle">
                            <i class="fas fa-check"></i>
                        </a>

                    @else
                    <span class="lable lable-success"> معتمد</span>
                    <a href="{{route("distributor.client.dis_active",$client->id)}}" class="btn btn-danger btn-circle">
                        <i class="fas fa-times"></i>
                    </a>
                @endif


            </td>

            <td>
                <a href="{!!route('distributor.clients.show',$client->id)!!}" class="btn btn-warning"> <i class="fas fa-book"></i> تفاصيل</a>
                <a href="{!!route('distributor.clients.edit',$client->id)!!}" class="btn btn-primary"> <i class="fas fa-pen"></i> تعديل</a>
                <a href="#"  onclick="Delete({{$client->id}})"  data-original-title="حذف" class="btn btn-danger btn-circle"><i  class="fa fa-trash"></i> حذف</a>
                {!!Form::open( ['route' => ['distributor.clients.destroy',$client->id] ,'id'=>'delete-form'.$client->id, 'method' => 'Delete']) !!}
                {!!Form::close() !!}
            </td>

        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>#</th>
        <th>الكود</th>
        <th >الاسم</th>
        <th >الهاتف</th>
        <th>البريد الالكترونى</th>
        <th>إسم المتجر</th>
        <th class="filter">إسم المندوب</th>
        <th class="filter">إسم المسار</th>
        <th> الحالة</th>
        <th> صورة العميل</th>
        <th>الاعدادت</th>
    </tr>
    </tfoot>
</table>
