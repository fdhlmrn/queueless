@extends('layouts.app')

@section('content')
@if(!empty($alertMsg))
  <div class="alert alert-danger"> {{ $alertMsg }}</div>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ action('FoodsController@registerCompany') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                            <label for="company_name" class="col-md-4 control-label">Company Name</label>

                            <div class="col-md-6">
                                <input id="company_name" type="text" class="form-control" name="company_name" value="{{ old('company_name') }}" required autofocus>

                                @if ($errors->has('company_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('company_contact') ? ' has-error' : '' }}">
                            <label for="company_contact" class="col-md-4 control-label">Company Contact</label>

                            <div class="col-md-6">
                                <input id="company_contact" type="company_contact" class="form-control" name="company_contact" value="{{ old('company_contact') }}" required>

                                @if ($errors->has('company_contact'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_contact') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="location" class="col-md-4 control-label">Company's Address</label>

                            <div class="col-md-6">
                                <input class="form-control" id="location" type="text" name="location">
                                <input class="form-control" id="latitude" type="hidden" name="latitude">
                                <input class="form-control" id="longitude" type="hidden" name="longitude">                
                          </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script>

      $(function() {
         $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
    });
   
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      var map, infoWindow, geocoder, latitude, longitude;
      function initMap() {
        // Init Map
        // map = new google.maps.Map(document.getElementById('map'), {
        //   center: {lat: -34.397, lng: 150.644},
        //   zoom: 17
        // });

        // Init Geocoder
        geocoder = new google.maps.Geocoder;

        // Init InfoWindow
        // infoWindow = new google.maps.InfoWindow;

        

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            // infoWindow.setPosition(pos);
            // infoWindow.setContent('Location found.');
            // infoWindow.open(map);
            // map.setCenter(pos);
            latitude = pos.lat;
            longitude = pos.lng;
            $('#latitude').val(latitude); //amik nilai lat
            $('#longitude').val(longitude); //amik nilai long
            // $('.form-control').css('border', '2px solid red');


            // geocodeLatLng(geocoder, map, infoWindow); //geocode latitude dan longtiude
            geocodeLatLng(geocoder); //geocode latitude dan longtiude


            var jqXHR = $.ajax({
              method: 'POST',
              url: '{{ route('handle.location') }}',
              data: {
                latitude: pos.lat,
                longitude: pos.lng
              }
            });

            
          }, function() {
            handleLocationError(true);
            // handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
          handleLocationError(false);
        }



      } // close of init map

      // function geocodeLatLng(geocoder, map, infowindow) {
      function geocodeLatLng(geocoder) {
        var latlng = {lat: parseFloat(latitude), lng: parseFloat(longitude)};
        console.log(latlng);
        geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === 'OK') {
            if (results[1]) {
              // map.setZoom(18);
              // var marker = new google.maps.Marker({
              //   position: latlng,
              //   map: map
              // });
              // infowindow.setContent(results[1].formatted_address);
              $('#location').val(results[1].formatted_address);

              // infowindow.open(map, marker);
            } else {
              window.alert('No results found');
            }
          } else {
            window.alert('Geocoder failed due to: ' + status);
          }
        });
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                      window.alert('Error: The Geolocation service failed.');
      }
    </script>
    @stop


@endsection