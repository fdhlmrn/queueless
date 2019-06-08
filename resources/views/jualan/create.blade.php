@extends('layouts.app')
@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">
      <h2>Add Food</h2>
          </div>
    <div class="panel-body">
        <div class="row">
          <form class="form-horizontal" action="{{ action('FoodsController@store') }}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
        <div class="col-md-12">
          <div class="col-sm-6 col-md-4">
            <img src="http://placehold.it/380x500" alt="" class="img-rounded img-responsive" />

            <div>
                  <span class="btn btn-raised btn-round btn-default btn-file">
                    <input type="file" id="imagemakanan" name="image" />
                  </span>
            </div>
          </div>


        <div class="col-md-6">
            <div class="form-group">
              <div class="col-md-10">
                <label class="has-float-label">
                  <input class="form-control" type="text" name="nama_makanan" placeholder=" ">
                  <span>Food's Name</span>
                </label>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-10">
                <label class="has-float-label">
                  <input class="form-control" type="text" name="saiz_hidangan" placeholder=" ">
                  <span>Serving Size</span>
                </label>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-10">
                <label class="has-float-label">
                  <input class="form-control" type="text" name="harga" placeholder=" ">
                  <span>Price(RM)</span>
                </label>
              </div>
            </div>

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
  @endsection
