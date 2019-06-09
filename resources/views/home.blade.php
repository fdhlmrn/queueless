@extends('layouts.app')
@include('modal.destroy-modal')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">
    <div class="tim-typo"><h2>All foods</h2></div>

      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">              
              <!--Shopping Cart table-->
              <div class="table-responsive">
                  <table class="table product-table">
                      <!--Table head-->
                      <thead>
                          <tr>
                              <th>Image</th>
                              <th>Food's name</th>
                              <th>By</th>
                              <th>Price(RM)</th>
                              <th>Location</th>
                              <th></th>
                          </tr>
                      </thead>
                      <!--/Table head-->

                      <!--Table body-->
                      <tbody>
                        @forelse ($foods as $food)
                          <!--First row-->
                          <tr>
                              <th scope="row">
                                  <img style="height: 120px; width: 120px;" src="{{$food->image}}" alt="" class="img-circle img-responsive">
                              </th>
                              <td>
                                  <h5><strong>{{$food->nama_makanan}}</strong></h5>
                                  <small class="">{{ $food->created_at->diffForHumans() }}</small>

                              </td>
                              <td>{{ $food->user->company->company_name }}</td>
                              <td>{{ $food->harga }}</td>
                              <td>{{ $food->user->company->location}}</td>
                              <td>
                                  @if( $food->user_id == Auth::user()->id)
                                     <a href="{{ action('FoodsController@edit', $food->id) }}" class="btn btn-info btn-sm">Edit</a>
                                     <a href="{{ action('FoodsController@destroy', $food->id) }}" class="btn btn-danger btn-sm" id="confirm-modal">Delete</a>
                                  @else
                                          <a href="{{ action('FoodsController@getReduceByOneHome', $food->id) }}"
                                          class="btn btn-danger btn-sm">-</a>
                                          <a href="{{ action('FoodsController@cart', $food->id) }}"
                                          class="btn btn-success btn-sm">+</a>
                                  @endif
                              </td>
                          </tr>
                          @empty
                          <tr>
                            <td colspan="6">Looks like there is no post available.</td>
                          </tr>
                          @endforelse
                        <!--/First row-->

                      </tbody>
                    <!--/Table body-->
                </table>
              </div>
              <!--/Shopping Cart table-->
            <div class="pagination-bar text-center">
              {{ $foods->render() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ asset('js/warning.js') }}"></script>
@endsection
