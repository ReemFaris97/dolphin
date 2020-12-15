@extends('distributor.layouts.app')
@section('title')
كشف حساب العملاء
@endsection

@section('header')
@endsection

@section('breadcrumb') @php($breadcrumbs=[' كشف حساب العملاء'=>route('distributor.clients.index'),])
@includeWhen(isset($breadcrumbs),'distributor.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        كشف حساب العملاء

                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <a href="{!!route('distributor.dailyReports.create')!!}"
                           class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="fas fa-plus"></i>
                            <span>إنشاء ملخص يومي</span>
                        </span>
                        </a>
                    </li>
                    <li class="m-portlet__nav-item"></li>

                </ul>
            </div>
        </div>
        <div class="m-portlet__body">
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
                    <th class="noExport">الاعدادت</th>
                </tr>
                </thead>
                <tbody>

                @foreach($clients as $client)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                          <td>{!!$client->code!!}</td>
                        <td>{!!$client->name!!}</td>
                        <td>{!!$client->phone!!}</td>
                        <td>{!!$client->email!!}</td>
                        <td>{!!$client->store_name !!}</td>
                        <td>{!!$client->user->name !!}</td>
                        <td>{!!$client->route->name!!}</td>

                               <td>
                            @if ($client->is_active==0)
                                <span class="lable lable-danger">غير مفعل</span>
                               <a href="{{route("distributor.client.active",$client->id)}}" class="btn btn-success btn-circle">
                                        <i class="fas fa-check"></i>
                                    </a>

                                @else
                                <span class="lable lable-success"> مفعل</span>
                                <a href="{{route("distributor.client.dis_active",$client->id)}}" class="btn btn-danger btn-circle">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif


                        </td>

                        <td><img src="{!!asset($client->image)!!}" height="100" width="100"/></td>
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
                    <th>الصوره</th>
                    <th>الاسم</th>
                    <th>الهاتف</th>
                    <th>البريد الالكترونى</th>
                    <th> الحالة</th>
                    <th> صورة العميل</th>
                    <th class="noExport">الاعدادت</th>
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
                text: "هل تريد حذف هذا الملخص ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  الملخص الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
@endpush

