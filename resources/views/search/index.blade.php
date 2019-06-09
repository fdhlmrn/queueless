@extends('layouts.app')
@section('content')

  <div class="panel panel-default">
    <div class="panel-heading">
      <h2>Find Food</h2>
          </div>
    <div class="panel-body"> 
      <div class="row">
        <div class="col-md-10">
        <form class="form-horizontal" action="{{ action('SearchController@find') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
              <label style="font-size: 15px;" class="col-md-3 control-label">Food's Name</label>
              <div class="col-md-8">
                  <input class="form-control" type="text" name="keyword" placeholder="Nama Makanan">
              </div>
            </div>
            <div class="form-group">
              <label style="font-size: 15px;" class="col-md-3 control-label">Location</label>
              <div class="col-md-8">
                  <input class="form-control" id="location" type="text" name="location">
              </div>
                <div class="col-sm-offset-9 col-sm-10">
                  <a href="{{ url('/home') }}" class="btn btn-info">List All</a>
                  <button type="submit" class="btn btn-success">Search</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

@endsection
    {{-- csrf_field tu perlu untuk post, put, delete sahaja. --}}
