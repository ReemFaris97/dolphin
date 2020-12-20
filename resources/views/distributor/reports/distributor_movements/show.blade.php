@extends('distributor.layouts.app')
@section('title')
عرض تحركات المندوب
@endsection
@section('content')

<div class="m-content">
    <div class="row">
        <div class="col-md-12">

            <!--begin::Portlet-->
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head belong-to-aform">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                           عرض تحركات المندوب
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="m-portlet__body">

                    <div id="map" style=" height: 400px;  width:100%" ></div>


                </div>


            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
{{--    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>--}}

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCsT140mx0UuES7ZwcfY28HuTUrTnDhxww&callback=initMap" defer>
    </script>
<script>
    // let map;
    var trips=<?php echo  json_encode($trips); ?>;
    console.log(trips[0].trip.lat);
    function initMap() {
        // alert("dsfsd");
        const  map = new google.maps.Map(document.getElementById("map"), {
            center: new google.maps.LatLng(26.381861087276274, 43.99479680000002),
            zoom: 16,
        });
        const iconBase =
            "http://maps.google.com/mapfiles/kml/paddle/";
        const icons = {
            refuse: {
                icon: iconBase + "grn-blank.png",
            },

            accept:{
                icon: iconBase + "1.png",
            },
        };
        const features = [];
        for(let x = 0; x < trips.length; x++) {
            console.log(trips[x].type)
          features.push({
              // lat:parseFloat(trips[x].trip.lat),
              // lng:parseFloat(trips[x].trip.lng),
              position: new google.maps.LatLng(trips[x].trip.lat, trips[x].trip.lng),

                type:((trips[x].type== 'accept') ? 'accept' : 'refuse'),

          })
        }


        // const flightPath = new google.maps.Polyline({
        //     path: features,
        //     geodesic: true,
        //     strokeColor: "#FF0000",
        //     strokeOpacity: 1.0,
        //     strokeWeight: 2,
        // });
      console.log(features);
        // flightPath.setMap(map);
        // Create markers.
        for (let i = 0; i < features.length; i++) {
            const marker = new google.maps.Marker({
                position: features[i].position,
                icon: icons[features[i].type].icon,
                map: map,
            });
        }
    }
</script>

@endpush
