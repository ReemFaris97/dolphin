@extends('distributor.layouts.app')
@section('title') الاعضاء
@endsection

@section('header')
@endsection

@section('breadcrumb') @php($breadcrumbs=['العملاء'=>route('distributor.clients.index'),])
@includeWhen(isset($breadcrumbs),'distributor.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        كل العملاء
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <a href="{!!route('distributor.clients.create')!!}"
                           class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="fas fa-plus"></i>
                            <span>اضافه عميل جديد</span>
                        </span>
                        </a>
                    </li>
                    <li class="m-portlet__nav-item"></li>

                </ul>
            </div>
        </div>
        <div class="m-portlet__body">
            <!--begin: Datatable -->


            {{--'name', 'phone', 'email', 'password', 'image', 'job', 'nationality', 'company_name', 'blocked_at', 'is_admin',--}}

            <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                <thead>
                <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>الهاتف</th>
                    <th>البريد الالكترونى</th>
                    <th>إسم المتجر</th>

                    <th> صورة العميل</th>

                    <th>الاعدادت</th>
                </tr>
                </thead>
                <tbody>
                @foreach($clients as $user)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!!$user->name!!}</td>
                        <td>{!!$user->phone!!}</td>
                        <td>{!!$user->email!!}</td>
                        <td>{!!$user->store_name !!}</td>


                        {{--<td>--}}
                            {{--@if ($user->is_active==0)--}}
                                {{--<span class="lable lable-danger">غير مفعل</span>--}}
                                {{--<a href="{{route("distributor.client.active",$user->id)}}" class="btn btn-success btn-circle">--}}
                                    {{--<i class="fas fa-check"></i>--}}
                                {{--</a>--}}

                            {{--@else--}}
                                {{--<span class="lable lable-success"> مفعل</span>--}}
                                {{--<a href="{{route("distributor.client.dis_active",$user->id)}}" class="btn btn-danger btn-circle">--}}
                                    {{--<i class="fas fa-times"></i>--}}
                                {{--</a>--}}
                            {{--@endif--}}


                        {{--</td>--}}

                        <td><img src="{!!asset($user->image)!!}" height="100" width="100"/></td>
                        <td>
                            <a href="{!!route('distributor.clients.edit',$user->id)!!}" class="btn btn-primary"> <i class="fas fa-pen"></i> تعديل</a>
                            <a href="#"  onclick="Delete({{$user->id}})"  data-original-title="حذف" class="btn btn-danger btn-circle"><i  class="fa fa-trash"></i> حذف</a>
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

                    <th> صورة العميل</th>
                    <th>الاعدادت</th>
                </tr>
                </tfoot>
            </table>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function Delete(id) {
            var item_id=id;
            console.log(item_id);
            swal({
                title: "هل أنت متأكد ",
                text: "هل تريد حذف هذا العميل ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  المنطقةتم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
@endpush
