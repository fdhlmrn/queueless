@include('modal.destroy-modal')
@extends('layouts.app')
@section('content')
<div class="panel panel-default">
  <div class="panel-heading">
    <h2>Profile</h2>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-sm-6 col-md-4">
            <img src="{{ asset("$user->image") }}" alt="" class="img-rounded img-responsive" />
          </div>
          @foreach ($profiles as $profile)
            <div class="col-sm-6 col-md-8">
              <h2>{{$profile->user->name}}</h2>    
              <br> 
              <h4><i class="glyphicon glyphicon-envelope"></i>    {{$profile->user->email}}</h4>
              <br>
              <h4><i class="fa fa-phone"></i> {{$profile->no_phone}}</h4>
              <br>
              <h4><i class="fa fa-home"></i>  {{$profile->address}} <br>
              {{$profile->location}},
              <br>
              <br>
              <br>
              <div class="form-group">
                <div class="col-sm-offset-9 col-sm-10">
                @if ($profile->user_id == Auth::user()->id)
                  <a href="{{ action('ProfilesController@edit', $profile->user_id) }}" class="btn btn-success">Edit</a>
                @endif
                </div>
              </div>

              @endforeach

            </div>
          </div>
        </div>
      </div>
      
  <div class="panel-body">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class=" form-group col-sm-12 col-md-12">
            </div>
            </div>

      {{--       <div class="media media-post">
              <a class="pull-left author" href="{{ action('ProfilesController@show', $usernow->id)}}">
                <div class="avatar">
                  <img class="img-rounded img-responsive" style="width: 64px;height: 64px;" alt="64x64" src="{{$user->image}}">{{$user->name}}
                </div>
              </a>
              <div class="media-body">
                  <textarea class="form-control" placeholder="Write a nice reply or go home..." rows="4"></textarea>
                  <div class="media-footer">
                    <a href="#pablo" class="btn btn-primary pull-right">
                      <i class="material-icons">reply</i> Reply
                    </a>
                  </div>
              </div>
            </div> --}}

        
        <div class="list-group notes-group">

        <!--review -->

        @foreach($reviews as $review)

        <div class="col-md-12 card card-block">
              <hr style="background:#F87431; border:0; height:2px" />
                <h3 class="card-title">
                    {{ $review->title }}
                </h3>                
                <h6 class="pull-right"> {{$review->created_at->diffForHumans() }}</h6> 
                <h6>By:  {{ $review->user->name }}</h6>
            <p class="card-text">
                    {{$review->content}}
            </p>
            </form>
        </div>

        @endforeach
            </div>
        </div>
      </div>
    </div>
  </div>





    </div>
  </div>
  @endsection