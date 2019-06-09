@extends('layouts.app')

@section('content')


 <div class="panel panel-default">
    <div class="panel-heading">
        <h2>Sold Food
          <a href="{{ url('/foods/create') }}" class="btn btn-info pull-right" role="button">Add New Food</a>
          <a href="{{ url('/foods') }}" class="btn btn-info pull-right" role="button">Sales</a></h2>
  
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th width="15%">Buyer's Name</th>
                    <th width="15%">Order No</th>
                    <th width="15%">Phone Number</th>
                    <th width="35%">Food's Name</th>
                    <th width="15%">Quantity</th>
                    <th width="15%">Price(RM)</th>
                  </tr>
                </thead>
                <tbody pull-right>
                  @forelse($boughts as $bought)
                    <tr>
                      <td>{{ $bought->user2->name }}</td>  
                      <td>{{ $bought->order_no }}</td>  
                      <td>{{ $bought->user2->profile->no_phone }}</td>  
                      <td>{{ $bought->food->nama_makanan }}</td>
                      <td>{{ $bought->quantity }}</td>
                      <td>{{ $bought->totalPrice }}</td>
                        </tr>
                      @empty
                        <tr>
                          <td colspan="6">Looks like there is no post available.</td>
                        </tr>
                      @endforelse
                    </tbody>
                  </table>
                  {{-- {{ $sale->links() }} --}}
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection