

@if(Auth::user()->rol == 8)
    <meta http-equiv="refresh" content="0; delivery/pedido" />
@else
    <meta http-equiv="refresh" content="0; deliveryc/pedido" />
@endif

<!--/*@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection-->
