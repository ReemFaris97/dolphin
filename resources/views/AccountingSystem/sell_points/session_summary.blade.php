@extends('AccountingSystem.layouts.master')
@section('title','ملخص الجلسه'.' ')
@section('parent_title','إدارة نقطة البيع')

{{-- @section('action', URL::route('accounting.stores.index')) --}}

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">  عرض ملخص الجلسه </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <div class="form-group col-md-6 pull-left">
                <label class="label label-info"> تاريخ بدايه الجلسة: </label>
                <span>

                    {!! $session->start_session  !!}
                </span>
            </div>


            <div class="form-group col-md-6 pull-left">
                <label class="label label-info"> تاريخ نهاية الجلسة: </label>
                <span>
                    {!! $session->end_session  !!}
                </span>
            </div>


            <div class="form-group col-md-6 pull-left">
                <label class="label label-info"> كود الجلسة: </label>
                <span>
                    {!! $session->code  !!}
                </span>
            </div>

            <table class="table datatable-button-init-basic">
                <thead>
                <tr>
                    <th>#</th>
                    <th> رقم  الفاتورة </th>
                    <th> تاريخ الفاتورة </th>
                    <th> قيمة الفاتورة </th>
                    <th class="text-center">العمليات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($sales as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row-> id!!}</td>
                        <td>{!! $row->created_at!!}</td>
                        <td>{!! $row->total!!}</td>


                        <td class="text-center">
                            <a href="{{route('accounting.sales.show',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-eye text-inverse" style="margin-left: 10px"></i> </a>
                       
                        </td>

                    </tr>

                @endforeach



                </tbody>
            </table>


    </div>
</div>

@endsection

@section('scripts')

    <script>
          // Initialize and add the map
          function initMap() {
            // The location of Uluru
            var uluru = {lat:{{{ isset($store) ? $store->lat : '26.381861087276274' }}}, lng:{{{ isset($store) ? $store->lng : '43.99479680000002' }}}};
            // The map, centered at Uluru
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: uluru
            });
            // The marker, positioned at Uluru
            var marker = new google.maps.Marker({
                position: uluru,
                map: map,
                draggable:true,
            });


            marker.addListener('drag', handleEvent);
            marker.addListener('dragend', handleEvent);
            document.getElementById('lat').value = 26.381861087276274;
            document.getElementById('lng').value = 43.99479680000002;
        }

        function handleEvent(event) {
            document.getElementById('lat').value = event.latLng.lat();
            document.getElementById('lng').value = event.latLng.lng();
        }
    </script>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCsT140mx0UuES7ZwcfY28HuTUrTnDhxww&callback=initMap">
      </script>
@stop
