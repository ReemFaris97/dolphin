@extends('distributor.layouts.app')
@section('title')
@endsection

@section('header')
@endsection

@section('breadcrumb') @php($breadcrumbs=['المندوبين'=>'/distributor',$user->name =>'#'])
@includeWhen(isset($breadcrumbs),'distributor.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        {{$user->name}}
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">

                    <li class="m-portlet__nav-item"></li>

                </ul>
            </div>
        </div>
        <div class="m-portlet__body">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                       aria-controls="profile" aria-selected="true">الحساب</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link " id="routes-tab" data-toggle="tab" href="#routes" role="tab"
                       aria-controls="routes" aria-selected="false">المسارات</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <table class="table  dataTable table-responsive-sm table-bordered  table-hover ">
                        <thead>
                        <tr>
                            <th> المعلومه</th>
                            <th> القيمه</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>الاسم</td>
                            <td>{{$user->name}}</td>
                        </tr>
                        <tr>
                            <td>الهاتف</td>
                            <td>{{$user->phone}}</td>
                        </tr>
                        <tr>
                            <td>البريد الالكترونى</td>
                            <td>{{$user->email}}</td>
                        </tr>
                        <tr>
                            <td>الوظيفه</td>
                            <td>{{$user->job}}</td>
                        </tr>
                        <tr>
                            <td>الجنسيه</td>
                            <td>{{$user->nationality}}</td>
                        </tr>
                        <tr>
                            <td>اسم الشركه</td>
                            <td>{{$user->company_name}}</td>
                        </tr>
                        <tr>
                            <td>تاريخ اخر تواجد</td>
                            <td>{{optional($user->last_location->updated_at)->format('Y-m-d h:i A')}}</td>
                        </tr>
                        </tbody>
                    </table>
                    @if(!!$user->last_location)
                        @include('distributor.distributors._map', ['lat'=>$user->last_location->lat,'lng'=>$user->last_location->lng])

                    @endif
                </div>
                <div class="tab-pane fade " id="routes" role="tabpanel" aria-labelledby="routes-tab">
                    <table class="table table-striped- table-bordered table-hover table-checkable ">
                        <thead>
                        <tr>
                            <th>الترتيب</th>
                            <th>اسم المسار</th>
                            <th>اسم مستودع</th>
                            <th>عدد العملاء</th>
                            <th>الحاله</th>
                            <th class="noExport">الاعدادت</th>
                        </tr>
                        </thead>
                        <tbody id="routes-list">
                        @foreach($user->routes as $row)
                            <tr data-id="{!! $row->id !!}" data-arrange="{!! $row->arrange !!}">

                                @if($row->is_active===0)
                                    <td>
                                        <div class="handle-sort">
                                            <button class="btn btn-primary ">
                                                <i class="fas fa-arrows-alt-v"></i>
                                            </button>
                                        </div>
                                    </td>
                                @else
                                    <td>

                                    </td>
                                @endif
                                <td>{!!$row->name!!}</td>
                                <td>{!!optional($row->user)->name!!}</td>
                                <td>{!!$row->trips_count!!}</td>
                                <td>{!!$row->is_active?"مفعل":"غير مفعل"!!}</td>
                                <td>
                                    <a href="{!!route('distributor.routes.show',$row->id)!!}" class="btn btn-success">
                                        <i
                                            class="fas fa-eye"></i>مشاهدة</a>
                                    <a href="{!!route('distributor.routes.edit',$row->id)!!}" class="btn btn-primary">
                                        <i
                                            class="fas fa-pen"></i> تعديل</a>
                                    <a href="#" onclick="Delete({{$row->id}})" data-original-title="حذف"
                                       class="btn btn-danger btn-circle"><i class="fa fa-trash"></i> حذف</a>
                                    {!!Form::open( ['route' => ['distributor.routes.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
                                    {!!Form::close() !!}


                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>


                </div>
            </div>


        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script>
        var el = document.getElementById("routes-list");
        var sortable = Sortable.create(el, {
            handle: '.handle-sort',
            swap: true, // Enable swap plugin
            animation: 150, // ms, animation speed moving items when sorting, `0` — without animation
            // Element dragging ended
            onEnd: function (/**Event*/ evt) {
                var all_items = evt.item.parentNode.children

                var new_item_order_list = []
                for (item of all_items) {
                    new_item_order_list.push({
                        'id': item.dataset.id,
                        'arrange': item.dataset.arrange
                    })
                }
                $.ajax({
                    method: "POST",
                    url: "{{route('distributor.routes.update-arrange')}}",
                    data: {
                        "user_id":{{$user->id}},
                        "routes": new_item_order_list
                    }
                })
            },

        });

    </script>

@endsection
