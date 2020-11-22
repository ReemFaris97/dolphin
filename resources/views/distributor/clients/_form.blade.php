<div class="m-portlet__body a-smaller-input-wrapper">
    <div class="form-group m-form__group">
        <label>الاسم</label>
        {!! Form::text('name',null,['class'=>'form-control m-input','placeholder'=>'ادخل الاسم'])!!}
    </div>

    <div class="form-group m-form__group">
        <label>الهاتف</label>
        {!! Form::text('phone',null,['class'=>'form-control m-input','placeholder'=>'ادخل الهاتف'])!!}
    </div>

    <div class="form-group m-form__group">
        <label>البريد الالكترونى</label>
        {!! Form::email('email',null,['class'=>'form-control m-input','placeholder'=>'ادخل البريد الالكترونى'])!!}
    </div>

    <div class="form-group m-form__group">
        <label>إسم المتجر </label>
        {!! Form::text('store_name',null,['class'=>'form-control m-input','placeholder'=>'ادخل إسم المتجر'])!!}
    </div>

    <div class="form-group m-form__group">
        <label>العنوان</label>
        {!! Form::text('address',null,['class'=>'form-control m-input','placeholder'=>'ادخل العنوان'])!!}
    </div>

  <div class="form-group m-form__group">
        <label>الكود</label>
        {!! Form::text('code',null,['class'=>'form-control m-input','placeholder'=>' ادخل الكود  '])!!}
  </div>
 <div class="form-group m-form__group">
        <label>المسارات</label>
        {!! Form::select('route_id',$routes,null,['class'=>'form-control m-input','placeholder'=>' اختر المسار'])!!}
  </div>
 <div class="form-group m-form__group">

        <label>الشريحة</label>
        {!! Form::select('client_class_id',$client_classes,null,['class'=>'form-control m-input','placeholder'=>' اختر الشريحة'])!!}
  </div>
 <div class="form-group m-form__group">
        <label>المندوبين</label>
        {!! Form::select('user_id', $distributors,null,['class'=>'form-control m-input','placeholder'=>' اختر المندوبين'])!!}
  </div>

    <div class="form-group m-form__group">
        <label> صوره العميل  </label>
        @if(isset($client))

            <img src="{!! url($client->image)!!}" width="250" height="250">
        @endif
        <input type="file" class="form-control m-input" name="image">
    </div>


    <div id="map" style="width: 100%; height: 450px;"></div>
    <input type="hidden" name="lat" id="lat" @if(isset($user)) value="{{ $user->lat }}" @endif />
    <input type="hidden" name="lng" id="lng" @if(isset($user)) value="{{ $user->lng }}" @endif />

</div>
@push('scripts')
    <script>
        $('#check-all').change(function () {
            $("input:checkbox").prop("checked", $(this).prop("checked"))
        })
    </script>
    @if(isset($user))
        <script type="text/javascript">

            function initAutocomplete() {
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: 24.686246996081948, lng: 46.66859652100288},
                    zoom: 8,
                    mapTypeId: 'roadmap'
                });


                var marker;
                google.maps.event.addListener(map, 'click', function (event) {
                    map.setZoom();
                    var mylocation = event.latLng;
                    map.setCenter(mylocation);


                    $('#lat').val(event.latLng.lat());
                    $('#lng').val(event.latLng.lng());


                    codeLatLng(event.latLng.lat(), event.latLng.lng());

                    setTimeout(function () {
                        if (!marker)
                            marker = new google.maps.Marker({position: mylocation, map: map});
                        else
                            marker.setPosition(mylocation);
                    }, 600);

                });


                // Create the search box and link it to the UI element.
                var input = document.getElementById('pac-input');
                var searchBox = new google.maps.places.SearchBox(input);
                map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

                // Bias the SearchBox results towards current map's viewport.
                map.addListener('bounds_changed', function () {
                    searchBox.setBounds(map.getBounds());
                });


                var markers = [];
                // Listen for the event fired when the user selects a prediction and retrieve
                // more details for that place.
                searchBox.addListener('places_changed', function () {
                    var places = searchBox.getPlaces();
                    // var location = place.geometry.location;
                    // var lat = location.lat();
                    // var lng = location.lng();
                    if (places.length == 0) {
                        return;
                    }

                    // Clear out the old markers.
                    markers.forEach(function (marker) {
                        marker.setMap(null);
                    });
                    markers = [];


                    // For each place, get the icon, name and location.
                    var bounds = new google.maps.LatLngBounds();
                    places.forEach(function (place) {
                        if (!place.geometry) {
                            console.log("Returned place contains no geometry");
                            return;
                        }
                        var icon = {
                            url: place.icon,
                            size: new google.maps.Size(71, 71),
                            origin: new google.maps.Point(0, 0),
                            anchor: new google.maps.Point(17, 34),
                            scaledSize: new google.maps.Size(25, 25)
                        };

                        // Create a marker for each place.
                        markers.push(new google.maps.Marker({
                            map: map,
                            icon: icon,
                            title: place.name,
                            position: place.geometry.location
                        }));

                        if (place.geometry.viewport) {
                            // Only geocodes have viewport.
                            bounds.union(place.geometry.viewport);
                        } else {
                            bounds.extend(place.geometry.location);
                        }
                        $('#lat').val(place.geometry.location.lat());
                        $('#lng').val(place.geometry.location.lng());
                        $('#address').val(place.formatted_address);

                    });


                    map.fitBounds(bounds);
                });


            }


            function showPosition(position) {

                map.setCenter({lat: position.coords.latitude, lng: position.coords.longitude});
                codeLatLng(position.coords.latitude, position.coords.longitude);


            }


            function codeLatLng(lat, lng) {

                var geocoder = new google.maps.Geocoder();
                var latlng = new google.maps.LatLng(lat, lng);
                geocoder.geocode({
                    'latLng': latlng
                }, function (results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        if (results[1]) {
                            // console.log(results[1].formatted_address);
                            $("#demo").html(results[1].formatted_address);

                            $("#addressProfile").val(results[1].formatted_address);
                            $("#pac-input").val(results[1].formatted_address);

                        } else {
                        }
                    } else {
                        alert('Geocoder failed due to: ' + status);
                    }
                });
            }


            {{--$(".company_name").attr({--}}
            {{--"data-parsley-trigger": "focusout",--}}
            {{--"data-parsley-required-message": "<?php __('trans.field_required') ?>",--}}
            {{--"data-parsley-maxlength": "15",--}}
            {{--"data-parsley-maxlength-message": "تجاوزت الحد الأقصى لعدد الحروف المسموحة وهى 15 ",--}}
            {{--"data-parsley-minlength": "3",--}}
            {{--"data-parsley-minlength-message": "اقل عدد حروف مسموح به هو 3 حروف"--}}

            {{--});--}}


            {{--@include('validate')--}}

        </script>
        <script>





            var lat = 24.774265;
            var lng = 46.738586;


            var newLat = $("#lat").val();
            var newLng = $("#lng").val();


            if (newLat != '' && newLng != '') {
                lat = Number(newLat);
                lng = Number(newLng);
            }


            function initAutocomplete() {


                var map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: lat, lng: lng},
                    zoom: 8,
                    mapTypeId: 'roadmap'
                });

                var mylocation = {lat: lat, lng:lng};

                var marker;

                google.maps.event.addListener(map, 'click', function (event) {
                    map.setZoom();
                    var mylocation = event.latLng;
                    map.setCenter(mylocation);



                    $('#lat').val(event.latLng.lat());
                    $('#lng').val(event.latLng.lng());


                    // marker = new google.maps.Marker({position: mylocation, map: map});

                    codeLatLng(event.latLng.lat(), event.latLng.lng());

                    setTimeout(function () {
                        if (!marker)
                            marker = new google.maps.Marker({position: mylocation, map: map});
                        else
                            marker.setPosition(mylocation);
                    }, 600);

                });

                marker = new google.maps.Marker({position: mylocation, map: map});




                // Create the search box and link it to the UI element.
                var input = document.getElementById('pac-input');
                var searchBox = new google.maps.places.SearchBox(input);
                map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

                // Bias the SearchBox results towards current map's viewport.
                map.addListener('bounds_changed', function () {
                    searchBox.setBounds(map.getBounds());
                });


                var markers = [];
                // Listen for the event fired when the user selects a prediction and retrieve
                // more details for that place.
                searchBox.addListener('places_changed', function () {
                    var places = searchBox.getPlaces();
                    // var location = place.geometry.location;
                    // var lat = location.lat();
                    // var lng = location.lng();
                    if (places.length == 0) {
                        return;
                    }

                    // Clear out the old markers.
                    markers.forEach(function (marker) {
                        marker.setMap(null);
                    });
                    markers = [];


                    // For each place, get the icon, name and location.
                    var bounds = new google.maps.LatLngBounds();
                    places.forEach(function (place) {
                        if (!place.geometry) {
                            console.log("Returned place contains no geometry");
                            return;
                        }
                        var icon = {
                            url: place.icon,
                            size: new google.maps.Size(71, 71),
                            origin: new google.maps.Point(0, 0),
                            anchor: new google.maps.Point(17, 34),
                            scaledSize: new google.maps.Size(25, 25)
                        };

                        // Create a marker for each place.
                        markers.push(new google.maps.Marker({
                            map: map,
                            icon: icon,
                            title: place.name,
                            position: place.geometry.location
                        }));

                        if (place.geometry.viewport) {
                            // Only geocodes have viewport.
                            bounds.union(place.geometry.viewport);
                        } else {
                            bounds.extend(place.geometry.location);
                        }
                        $('#lat').val(place.geometry.location.lat());
                        $('#lng').val(place.geometry.location.lng());
                        $('#address').val(place.formatted_address);

                    });


                    map.fitBounds(bounds);
                });


            }


            function showPosition(position) {

                map.setCenter({lat: position.coords.latitude, lng: position.coords.longitude});
                codeLatLng(position.coords.latitude, position.coords.longitude);


            }


            function codeLatLng(lat, lng) {

                var geocoder = new google.maps.Geocoder();
                var latlng = new google.maps.LatLng(lat, lng);
                geocoder.geocode({
                    'latLng': latlng
                }, function (results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        if (results[1]) {
                            // console.log(results[1].formatted_address);
                            $("#demo").html(results[1].formatted_address);

                            $("#addressProfile").val(results[1].formatted_address);
                            $("#pac-input").val(results[1].formatted_address);

                        } else {
                        }
                    } else {
                        alert('Geocoder failed due to: ' + status);
                    }
                });
            }





        </script>

    @else
        <script>
            function initAutocomplete() {
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: 24.774265, lng: 46.738586},
                    zoom: 8,
                    mapTypeId: 'roadmap'
                });


                var marker;
                google.maps.event.addListener(map, 'click', function (event) {
                    map.setZoom();
                    var mylocation = event.latLng;
                    map.setCenter(mylocation);


                    $('#lat').val(event.latLng.lat());
                    $('#lng').val(event.latLng.lng());


                    codeLatLng(event.latLng.lat(), event.latLng.lng());

                    setTimeout(function () {
                        if (!marker)
                            marker = new google.maps.Marker({position: mylocation, map: map});
                        else
                            marker.setPosition(mylocation);
                    }, 600);

                });


                // Create the search box and link it to the UI element.
                var input = document.getElementById('pac-input');
                var searchBox = new google.maps.places.SearchBox(input);
                map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

                // Bias the SearchBox results towards current map's viewport.
                map.addListener('bounds_changed', function () {
                    searchBox.setBounds(map.getBounds());
                });


                var markers = [];
                // Listen for the event fired when the user selects a prediction and retrieve
                // more details for that place.
                searchBox.addListener('places_changed', function () {
                    var places = searchBox.getPlaces();
                    // var location = place.geometry.location;
                    // var lat = location.lat();
                    // var lng = location.lng();
                    if (places.length == 0) {
                        return;
                    }

                    // Clear out the old markers.
                    markers.forEach(function (marker) {
                        marker.setMap(null);
                    });
                    markers = [];


                    // For each place, get the icon, name and location.
                    var bounds = new google.maps.LatLngBounds();
                    places.forEach(function (place) {
                        if (!place.geometry) {
                            console.log("Returned place contains no geometry");
                            return;
                        }
                        var icon = {
                            url: place.icon,
                            size: new google.maps.Size(71, 71),
                            origin: new google.maps.Point(0, 0),
                            anchor: new google.maps.Point(17, 34),
                            scaledSize: new google.maps.Size(25, 25)
                        };

                        // Create a marker for each place.
                        markers.push(new google.maps.Marker({
                            map: map,
                            icon: icon,
                            title: place.name,
                            position: place.geometry.location
                        }));

                        if (place.geometry.viewport) {
                            // Only geocodes have viewport.
                            bounds.union(place.geometry.viewport);
                        } else {
                            bounds.extend(place.geometry.location);
                        }
                        $('#lat').val(place.geometry.location.lat());
                        $('#lng').val(place.geometry.location.lng());
                        $('#address').val(place.formatted_address);

                    });


                    map.fitBounds(bounds);
                });

            }


            function showPosition(position) {

                map.setCenter({lat: position.coords.latitude, lng: position.coords.longitude});
                codeLatLng(position.coords.latitude, position.coords.longitude);


            }


            function codeLatLng(lat, lng) {

                var geocoder = new google.maps.Geocoder();
                var latlng = new google.maps.LatLng(lat, lng);
                geocoder.geocode({
                    'latLng': latlng
                }, function (results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        if (results[1]) {
                            // console.log(results[1].formatted_address);
                            $("#demo").html(results[1].formatted_address);

                            $("#addressProfile").val(results[1].formatted_address);
                            $("#pac-input").val(results[1].formatted_address);

                        } else {
                        }
                    } else {
                        alert('Geocoder failed due to: ' + status);
                    }
                });
            }



        </script>
    @endif
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjBZsq9Q11itd0Vjz_05CtBmnxoQIEGK8&language=ar&libraries=places&callback=initAutocomplete"
            async defer></script>

@endpush
