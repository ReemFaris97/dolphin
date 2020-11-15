@extends('distributor.layouts.app')
@section('title')
    {{$route->name}}
@endsection

@section('breadcrumb') @php($breadcrumbs=['المسارات'=>'/routes',$route->name =>'#'])
@includeWhen(isset($breadcrumbs),'distributor.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        {{$route->name}}
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
            <table class="table table-bordered table-hover ">
                <tbody>
                {{--'name', 'is_finished', 'is_active','user_id'--}}
                <tr>
                    <td>
                        الاسم
                    </td>
                    <td>
                        {{$route->name}}
                    </td>
                </tr>
                <tr>
                    <td>
                        المندوب
                    </td>
                    <td>

                        <a href="{!!route('distributor.distributors.show',$route->user_id)!!}" class="btn btn-success">
                            <i
                                class="fas fa-eye"></i></a>
                        {{$route->user->name}}
                    </td>
                </tr>
                <tr>
                    <td>
                        تم الانتهاء منه
                    </td>
                    <td>
                        {{$route->is_finished?'نعم':'لا'}}
                    </td>
                </tr>
                <tr>
                    <td>
                        تحت التنفيذ
                    </td>
                    <td>
                        {{$route->is_active?'نعم':'لا'}}
                    </td>
                </tr>

                </tbody>
            </table>

            <h3> ترتيب المسارات</h3>

            <div class="list-group" id="route-trips">
                @foreach($route->trips->load('client') as $trip)
                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start "
                       data-id="{!! $trip->id !!}" data-arrange="{!! $trip->arrange !!}">
                        <div class="">
                            <h5 class="mb-1">{{$trip->client->name}}</h5>
                        </div>
                        <div class="d-flex ">
                            <p class="mb-1">{{$trip->address}}</p>
                            @if($trip->cash<=0 &&$route->is_active===0&&$route->is_finished===0)
                                <div class="handle-sort" style="flex: 0 0 auto !important;">
                                    <button class="btn btn-primary  " style="width:1px !important;">
                                        <i class="fas fa-arrows-alt-v"></i>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script>
        var el = document.getElementById("route-trips");
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
                    url: "{{route('distributor.trips.update-arrange')}}",
                    data: {
                        "route_id":{{$route->id}},
                        "trips": new_item_order_list
                    }
                })
                debugger
            },

        });

    </script>

@endsection


