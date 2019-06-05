@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offfset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-body">
                                    {!! $chart->render() !!}

                            
                        </div>
                        
                    </div>
                    
                </div>
            </div>
            
        </div>
        
    </div>

@stop