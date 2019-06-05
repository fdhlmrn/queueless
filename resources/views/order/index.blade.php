@include('modal.destroy-modal')
@extends('layouts.app')
@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">
      <h2>Pesanan Makanan<a href="{{ url('/orders/create') }}" class="btn btn-info pull-right"
        role="button">Pesanan Baru</a></h2>

      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th width="55%">Makanan</th>
                    <th width="10%">By</th>
                    <th width="15%">Saiz Hidangan</th>
                    <th width="15%">Harga(RM)</th>
                    <th width="15%">Lokasi</th>
                    <th width="15%">Action</th>
                  </tr>
                </thead>
                <tbody pull-right>
                  <?php $i = 0 ?>
                  @forelse($orders as $order)
                    <tr>
                      <td>{{ $orders->firstItem() + $i }}</td>
                      <td>{{$order->nama_makanan}} <br><br><small class="">
                          {{ $order->created_at->diffForHumans() }}
                        </small></td>
                      <td>{{ $order->user->name }}</td>

                      <td>{{ $order->saiz_hidangan }}</td>
                      <td>{{ $order->harga }}</td>
                      <td>{{ $order->state->name }}, {{ $order->district->name}}</td>
                      <td>
                        @if( $order->user_id == Auth::user()->id)
                          <a href="{{ action('OrdersController@edit', $order->id) }}"
                            class="btn btn-primary btn-sm">Edit</a>
                              <br>
                            <br>
    
                          <form action="{{ action('OrdersController@destroy',$order->id) }}" method="POST">  
                            {{ csrf_field() }}
                            {{method_field('DELETE')}}
                            <input class="btn btn-sm btn-danger" type="submit" value="Delete">
                          </form>

                        <?php else: ?>
                        <a href="{{ action('OrdersController@edit', $order->id) }}"
                          class="btn btn-primary btn-sm">Accept</a>

                            @endif
                          </td>
                        </tr>
                        <?php $i++ ?>
                      @empty
                        <tr>
                          <td colspan="6">Looks like there is no post available.</td>
                        </tr>
                      @endforelse
                    </tbody>
                  </table>
                  <div class="pagination-bar text-center">
                    {{ $orders->render() }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <script src="{{ asset('js/warning.js') }}"></script>
      @endsection
