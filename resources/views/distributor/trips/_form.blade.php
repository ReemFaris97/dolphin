<div class="m-portlet__body a-smaller-input-wrapper">


    <div class="form-group m-form__group">
        <label>اسم المسار </label>
        {!! Form::select('route_id',$routes,null,['class'=>'form-control m-input select2','placeholder'=>'ادخل اسم المسار'])!!}
    </div>

    <div class="form-group m-form__group">
        <label>اسم  العميل</label>
        {!! Form::select('client_id',$clients,null,['class'=>'form-control m-input select2','placeholder'=>'اختر اسم العميل'])!!}
    </div>


    <div class="form-group m-form__group">
        <label class="p-r-small  control-label">الترتيب </label>
        {{ Form::text('arrange', null,['class'=>'form-control m-input']) }}
    </div>


    <div class="clearfix">&nbsp;</div>
    <div class="form-group col-md-12 ">
        <label>  تحديد المسار   على الخريطة  </label>
        <div class="form-group">
            <div id="map" style="width: 100%; height: 450px;"></div>

            <div class="clearfix">&nbsp;</div>
            <div class="m-t-small">
                <div class="form-group m-form__group">
                    <label class="p-r-small control-label">خط الطول</label>


                    {{ Form::text('lat', null,['id'=>'lat','class'=>'form-control']) }}
                </div>
                <div class="form-group m-form__group">
                    <label class="p-r-small  control-label">خط العرض </label>

                    {{ Form::text('lng', null,['id'=>'lng','class'=>'form-control']) }}
                </div>
                <div class="form-group m-form__group">
                    <label class="p-r-small  control-label">العنوان </label>
                    {{ Form::text('address', null,['class'=>'form-control m-input']) }}
                </div>
            </div>
        </div>
    </div>


</div>

@push('scripts')
    <script>
        $('#check-all').change(function () {
            $("input:checkbox").prop("checked", $(this).prop("checked"))
        })
    </script>

    <script>
        // Initialize and add the map
        function initMap() {
            // The location of Uluru
            var uluru = {lat: 26.381861087276274, lng: 43.99479680000002};
            // The map, centered at Uluru
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: uluru
            });
            // The marker, positioned at Uluru
            var marker = new google.maps.Marker({
                position: uluru,
                map: map,
                draggable: true,
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


@endpush
