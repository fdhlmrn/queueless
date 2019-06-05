@include('modal.destroy-modal')
@extends('layouts.app')
@section('content')
<div class="panel panel-default">
  <div class="panel-heading">
    <h2>Profile </h2>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-sm-6 col-md-4">

            <img src="{{ asset("$user->image") }}" alt="" class="img-rounded img-responsive" />
          </div>
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
                <div class="col-sm-offset-10 ">
                @if ($profile->user_id == Auth::user()->id)
                  <a href="{{ action('ProfilesController@edit', $profile->user_id) }}" class="btn btn-success">Edit Profile</a>

                @else


              <div class="">

              <form method="POST" action="/profiles/{{ $profile->id }}/like" style="display: inline-block;">
                    {{ csrf_field() }}
                    <button class="btn btn-just-icon btn-danger {{ Auth::check() && Auth::user()->alreadyliked($profile) ? 'btn-success' : 'btn-default'}}" style="width: 3em">
                    <i class="material-icons">favorite</i>
                    {{ $profile->likes->count() }}
                    </button>
              </form>
              </div>
               @endif

               </div>
            </div>
            </div>
         </div>
        </div>


    </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-6"><h2 class="pull-left">Comment</h2></div>
          <div class=" form-group col-sm-12 col-md-12">

            @if ($profile->user_id != Auth::user()->id)

            <div class="media media-post col-md-1">
              <a class="pull-left author" href="{{ action('ProfilesController@show', $usernow->id)}}">
                <div class="avatar">
                  <img class="img-rounded img-responsive" style="width: 64px;height: 64px;" alt="64x64" src="{{$usernow->image}}">{{$usernow->name}}
                </div>
              </a>
            </div>
            <div class="col-md-11">
              <form class="form-horizontal" action="{{ action('ReviewController@store') }}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}

              <input type="hidden" name="profile" value="{{$profile->id}}">

              <input class="form-control" name="title" placeholder="Title">

                <textarea class ="form-control" name="content" placeholder="Enter your post" rows="4" value="{{ old('post_content') }}" maxlength="500"></textarea>
                <p class="text-muted">Number of maximum character is 500</p>
                <button type="submit" class="btn btn-success pull-right">Reply</button>
                </form>

            </div>
            </div>
            </div>

{{--             <div class="col-md-6"><a href="{{ action('ReviewController@index', $profile->id) }}" class="btn btn-success pull-right">Comment</a> --}}
            @endif
            </div>
            </div>

        
         @foreach($reviews as $review)
         {{-- {{ dd($review) }} --}}
        <div class="list-group notes-group">

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
            

            @if ($review->user_id == Auth::user()->id)
            <div>
            <a class="btn btn-sm btn-info pull-xs-left" href="{{ action('ReviewController@edit', $review->id) }}">
                Edit
            </a>
            <a href="{{ action('ReviewController@destroy', $review->id) }}" class="btn btn-danger btn-sm" id="confirm-modal">Delete</a>
{{--             <form action="{{ action('ReviewController@destroy',$review->id) }}" class="pull-xs-right" method="POST">
                {{ csrf_field() }}
                {{method_field('DELETE')}}
                <input class="btn btn-sm btn-danger" type="submit" value="Delete"> --}}
            @endif
              
            </form>
            </div>
        </div>
        @endforeach

        <div class="pagination-bar text-center">
            {{ $reviews->render() }}
        </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  @endsection