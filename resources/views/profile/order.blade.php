@extends('layouts.app')

@section('content')

 <div class="panel panel-default">
    <div class="panel-heading">
      <h2>Orders</h2>

      </div>
      <div class="panel-body">
        <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
              @foreach($orders as $order)
                <div class="card card-block">
                <h4 class="card-title">
				<strong>Total Price: RM {{ $order->totalPrice }}</strong> <p class="pull-right">{{ $order->created_at->diffForHumans() }}</p>
                </h4>
                </div>
              <table class="table table-striped">

                <thead>

                  <tr>
                    <th width="15%">Seller</th>
                    <th width="15%">Order No.</th>
                    <th width="15%">Phone Number</th>
                    <th width="20%">Location</th>
                    <th width="15%">Food's Name</th>
                    <th width="10%">Quantity</th>
                    <th width="10%">Price(RM)</th>
                  </tr>
                </thead>
                <tbody pull-right>
				@forelse ($order->cart->foods as $food)
                    <tr>
                      <td>{{ $food['food']->user->name }}</td>
                      <td>{{ $order->order_no }}</td>
                      <td>{{ $food['food']->user->company->company_contact }}</td>  
                      <td>{{ $food['food']->user->company->location }}</td>  
                      <td>{{ $food['food']['nama_makanan'] }}</td>
                      <td>{{ $food['qty'] }}</td>
                      <td>{{ $food['harga'] }}</td>
                        </tr>
                      @empty
                        <tr>
                          <td colspan="6">Looks like there is no post available.</td>
                        </tr>
                      @endforelse
                    </tbody>
                  </table>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection