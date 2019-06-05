@extends('layouts.app')
@section('content')

	<div class="row">
		<div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
			<h1>Checkout</h1>
			<h4>Your Total: RM {{ $total }}</h4>
			<form action=" {{ route('checkout') }}" method="post" id="checkout-form">
	
				{{ csrf_field() }}

		<input type="hidden" name="totalPrice" value="{{$total}}">
				<button type="submit" class="btn btn-success">Confirm Purchase</button>
			</form>

		</div>
		
	</div>

@stop