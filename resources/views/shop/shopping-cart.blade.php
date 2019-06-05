@extends('layouts.app')
@section('content')
	@if (Session::has('cart'))



						<div class="row">
		                    <div class="col-md-12">
		                        <h4>Shopping Cart Table</h4>
		                    </div>
		                    <div class="col-md-10 col-md-offset-1">
		                        <div class="table-responsive">
		                        <table class="table table-shopping">
		                            <thead>
		                                <tr>
		                                    <th></th>
		                                    <th>Nama Makanan</th>
		                                    <th>Harga (RM)</th>
		                                    <th>Lokasi</th>
		                                    <th>Quantiti</th>
		                                    <th>Amount</th>
		                                    <th></th>
		                                </tr>
		                            </thead>
		                            <tbody>
                    					@foreach ($foods as $food)

		                                 <tr>
		                                    <td>
		                                        <div class="img-container">
		                                            <img style="height: 60px; width: 60px;" src="{{$food['food']['image']}}" alt="...">
		                                        </div>
		                                    </td>
		                                    <td class="td-name">
		                                        <a href="#nothing">{{$food['food']['nama_makanan']}}</a>
		                                    </td>
		                                    <td>
												<small>RM </small>{{$food['food']['harga']}}
		                                    </td>

		                                    <td class="td-number">
												{{$food['food']['location']}}
		                                    </td>
		                                    <td class="td-number">
		                                        {{$food['qty']}}
                                          <a href="{{ route('food.reduce', ['id' =>  $food['food']['id']]) }}"
                                          class="btn btn-danger btn-sm">-</a>
                                          <a href="{{ action('FoodsController@carthome',['id' =>  $food['food']['id']]) }}"
                                          class="btn btn-success btn-sm">+</a>

		                                    </td>
		                                    <td class="td-number">
		                                        <small>RM </small>{{$food['harga']}}
											</td>
		                                </tr>
		            					@endforeach

		                                <tr>
		                                    <td colspan="4">
		                                    </td>
		                                    <td class="td-total">
		                                       Total
		                                    </td>
		                                    <td class="td-price">
		                                        <small>RM </small>{{$totalPrice}}
		                                    </td>


		                                </tr>
		                            </tbody>
		                        </table>				<a href="{{ route('checkout') }}" type="button" class="btn btn-success pull-right">Checkout</a>

		                        </div>

		                    </div>
		                </div>
		            </div>
	@else
		</div><div class="row">
			<div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
				<h2>No Items</h2>
			</div>			
		</div>
	@endif
		<!--                 end tables -->

{{-- 

		<div class="row">
			<div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
				<ul class="list-group">
					@foreach ($foods as $food)
						<li class="list-group-item">
							<span class="badge">
								{{ $food['qty'] }}
							</span>
							<strong>
								{{ $food['food']['nama_makanan'] }}
							</strong>
							<span class="label label-success">
								{{ $food['harga'] }}
							</span>
							<div class="btn-group">
								<button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
								<ul class="dropdown-menu">
									<li><a href="{{ route('food.reduce', ['id' =>  $food['food']['id']]) }}">Reduce by 1</a></li>
									<li><a href="{{ route('food.remove', ['id' =>  $food['food']['id']]) }}">Reduce All</a></li>
								</ul>
							</div>
						</li>
						
					@endforeach
				</ul>
			</div>			
		</div><div class="row">
			<div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
				<strong>Total: {{ $totalPrice }}</strong>
			</div>			
		</div>
		</div><div class="row">
			<div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
				<a href="{{ route('checkout') }}" type="button" class="btn btn-success">Checkout</a>
			</div>			
		</div> --}}


@stop