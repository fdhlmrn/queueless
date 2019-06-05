@extends('layouts.app')
@section('content')

  <div class="panel panel-default">
    <div class="panel-heading">
      <h2>Pesan Makanan</h2>
          </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-10">
          <form class="form-horizontal" action="{{ action('OrdersController@store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
              <label class="col-md-4 control-label">Perincian Makanan</label>
              <div class="col-md-8">
                <div class="form-group">
                  <input class="form-control" type="text" name="nama_makanan" placeholder="Nama Makanan">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label">Saiz Makanan</label>
              <div class="col-md-8">
                <div class="form-group">
                  <input class="form-control" type="text" name="saiz_hidangan" placeholder="Saiz Hidangan">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label">Harga Makanan</label>
              <div class="col-md-8">
                <div class="form-group">
                  <input class="form-control" type="text" name="harga" placeholder="Harga Hidangan">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label">Negeri</label>
              <div class="col-md-8">
                <div class="form-group">
                  <select class="form-control input-sm" name="state" id="states">
                  @foreach($states as $state )
                  <option value="{{ $state->id }}">{{ $state->name }}</option>
                  @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label"></label>
              <div class="col-md-8">
                <div class="form-group">
                  <select class="form-control input-sm" name="district" id="district">
                  <option value="" selected="">Semua Daerah</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-10 col-sm-10">
                  <a href="{{ action('OrdersController@index') }}" class="btn btn-default">Cancel</a>
                  <button type="submit" class="btn btn-success">Save</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  @endsection
