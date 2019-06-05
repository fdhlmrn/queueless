@extends('layouts.app')
@section('content')


	<div class="panel panel-default">
		<div class="panel-heading">
			<h2>Leave review for {{ $profile->user->name }}</h2>
		</div>
	<div class="panel-body">
		<form class="form-horizontal" action="{{ action('ReviewController@store') }}"method="POST" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="row">

		<input type="hidden" name="profile" value="{{$profile->id}}">

		<div class="col-md-10">
			<label class="col-md-2 control-label">By</label>
		<div class="col-md-8">
			<label class="control-label">{{ $user->name }}</label>
		</div>
		</div>


		<div class="col-md-10">
			<div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}" >
			<label class="col-md-2 control-label">Title</label>
			<div class="col-md-8">
				<input class="form-control" name="title">
			</div>
		</div>
		</div>

		<div class="col-md-10">
			<label class="col-md-2 control-label">Post Content</label>
			<div class="col-md-8">
				<textarea class ="form-control" name="content" placeholder="Enter your post" rows="6" value="{{ old('post_content') }}" maxlength="500"></textarea>
				<p class="text-muted">Maxmimum character is 500</p>
					@if($errors->has('post_content'))
						<span class ="help-block">
							<strong>{{ $errors ->first('post_content') }}</strong>
						</span>
					@endif
			</div>
		</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<a href="{{ action('ReviewController@index', $profile->user_id) }}"class="btn btn-default">Cancel</a>
			<button type="submit" class="btn btn-success">Save</button>
		</div>
	</div>
		</form>
			</div>
		</div>
	</div>
	</div>
@endsection