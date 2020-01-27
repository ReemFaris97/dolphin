@extends('AccountingSystem.layouts.master')
@section('title','عرض بيانات مخزن'.' '. $store->name )
@section('parent_title','إدارة  المخازن')

@section('action', URL::route('accounting.stores.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">  عرض بيانات المخزن  {!! $store->name !!}</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">

            @if ($store->model_type=="App\Models\AccountingSystem\AccountingCompany")

                <div class="form-group col-md-6 pull-left">
                    <label class="label label-info">  المخزن تابع الى شركة: </label>
                    <span>
                        <?php
                        $company=App\Models\AccountingSystem\AccountingCompany::find($store->model_id)
                        ?>
                        {!! $company->name  !!}
                    </span>
                </div>

                @elseif ($store->model_type=="App\Models\AccountingSystem\AccountingBranch")
                <div class="form-group col-md-6 pull-left">
                    <label class="label label-info">  المخزن تابع الى فرع: </label>
                    <span>
                        <?php
                        $branch=App\Models\AccountingSystem\AccountingBranch::find($store->model_id)
                        ?>
                        {!! $branch->name  !!}
                    </span>
                </div>

            @endif

            @if ($store->type==0)


                    <div class="form-group col-md-6 pull-left">
                        <label class="label label-info">  اسم المخزن الرئيسى  : </label>
                        <span>{!! $store->basic->ar_name !!}</span>
                    </div>

                @endif
            <div class="form-group col-md-6 pull-left">
                <label class="label label-info">  اسم المخزن باللغة العربيه  : </label>
                <span>{!! $store->ar_name !!}</span>
            </div>

            <div class="form-group col-md-6 pull-left">
                <label class="label label-info"> اسم المخزن باللغة الانجليزية   : </label>
                <span>{!! $store->en_name !!}</span>
            </div>
            <div class="form-group col-md-6 pull-left">
                <label class="label label-info">  جوال المخزن : </label>
                <span>{!! $store->address !!}</span>
            </div>
            <div class="form-group col-md-6 pull-left">
                <label class="label label-info">  كود المخزن : </label>
                <span>{!! $store->code !!}</span>
            </div>
            <div class="form-group col-md-6 pull-left">
                <label class="label label-info">  صورة المخزن  : </label>
                <span><img src="{!! getimg($store->image)!!}" style="width:100px; height:100px"> </span>
            </div>
            <div class="clearfix">

            </div>


            <div class="form-group col-xs-12 pull-left"><label>  تحديد موقع المخزن  على الخريطة  </label>     <div class="form-group">
                <div id="map" style="width: 100%; height: 300px;"></div><div class="clearfix">&nbsp;</div>
                <div class="m-t-small map-inputs">
                    <div class="col-sm-2 col-xs-12">
                        <label class="p-r-small control-label">خط الطول</label>
                    </div>
                    <div class="col-sm-10 col-xs-12">
                        {{ Form::text('lat', null,['id'=>'lat','class'=>'form-control']) }}
                    </div>
                    <div class="col-sm-2 col-xs-12">
                        <label class="p-r-small  control-label">خط العرض </label>
                    </div>
                    <div class="col-sm-10 col-xs-12">
                        {{ Form::text('lng', null,['id'=>'lng','class'=>'form-control']) }}
                    </div>
                </div>
            </div>
        </div>

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
@stop
