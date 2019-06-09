@include('modal.destroy-modal')
@extends('layouts.app')
@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">
      <h2>Sales
        <a href="{{ url('/foods/create') }}" class="btn btn-info pull-right" role="button">Add New Food</a>
        <a href="{{ url('/bought') }}" class="btn btn-info pull-right" role="button">Sold Foods</a></h2>

      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    {{-- <th>#</th> --}}
                    <th width="35%">Food's Name</th>
                    <th width="15%">By</th>
                    <th width="15%">Price(RM)</th>
                    <th width="15%">Location</th>
                    <th width="15%">Action</th>
                  </tr>
                </thead>
                <tbody pull-right>
                  <?php $i = 0 ?>
                  @forelse($foods as $food)
                    <tr>
                      {{-- <td>{{ $loop->index }}</td> --}}
                      <td>
                        {{ $food->nama_makanan }}
                      </td>  
                      <td>{{ $food->user->company->company_name }}</td>
                      <td>{{ $food->harga }}</td>
                      <td>{{ $food->user->company->location }}</td>
                      <td>
                        @if( $food->user_id == Auth::user()->id)
                          
                          <a href="{{ action('FoodsController@edit', $food->id) }}"
                            class="btn btn-success btn-sm">Edit</a>
                           <a href="{{ action('FoodsController@destroy', $food->id) }}"
                             class="btn btn-danger btn-sm" id="confirm-modal">Delete</a>
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
                  {{-- {{ $sale->links() }} --}}
                </div>
              </div>
            </div>
          </div>
        </div>
        <script src="{{ asset('js/warning.js') }}"></script>
@endsection
