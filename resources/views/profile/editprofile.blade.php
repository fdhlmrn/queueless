@include('modal.destroy-modal')
@extends('layouts.app')
@section('content')

  <div class="panel panel-default">
    <div class="panel-heading">
      <h2>Edit Profile</h2>
          </div>
    <div class="panel-body">
        <div class="row">
      <form class="form-horizontal" action="{{ action('ProfilesController@update', $profile->id) }}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          {{ method_field('PATCH')}}

        <div class="col-md-12">
          <div class="col-sm-6 col-md-4">
            <img src="{{ asset("$user->image") }}" alt="" class="img-rounded img-responsive" />
            {{-- <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div> --}}

            <div>
                  <span class="btn btn-raised btn-round btn-default btn-file">
                    <input type="file" id="imageprofil" name="image" />
                  </span>
            </div>
          </div>
        <div class="col-md-6">
            <div class="form-group">
              <label style="font-size: 15px;" class="col-md-4 control-label">Name</label>
              <div class="col-md-8">
                <div class="form-group">
                <input class="form-control" type="text" value="{{$profile->user->name}}" name="name">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label">Email</label>
              <div class="col-md-8">
                <div class="form-group">
                <input class="form-control" type="text" value="{{$profile->user->email}}" name="email">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label">Phone Number</label>
              <div class="col-md-8">
                <div class="form-group">
                <input class="form-control" type="text" value="{{$profile->no_phone}}" name="no_phone">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label">Address</label>
              <div class="col-md-8">
                <div class="form-group">
                <input class="form-control" type="text" value="{{$profile->address}}" name="address">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label">Location</label>
              <div class="col-md-8">
                <div class="form-group">
                  <input class="form-control" id="location" type="text" name="location">
                </div>
              </div>
            </div>
                <input class="form-control" id="latitude" type="hidden" name="latitude">
                <input class="form-control" id="longitude" type="hidden" name="longitude">
            <div class="form-group">
                <div class="col-sm-offset-9 col-sm-10">
                  <a href="{{ action('FoodsController@index') }}" class="btn btn-danger">Cancel</a>
                  <button type="submit" class="btn btn-success">Save</button>
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

      function handleLocationError(browserHasGeolocation , pos) {
        // infoWindow.setPosition(pos);
        // infoWindow.setContent(browserHasGeolocation ?
        //                       'Error: The Geolocation service failed.' :
        //                       'Error: Your browser doesn\'t support geolocation.');
        // infoWindow.open(map);
      }
    </script>
    @stop


@endsection