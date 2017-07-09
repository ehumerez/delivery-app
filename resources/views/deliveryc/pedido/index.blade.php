@extends ('layouts.masterc')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Pedidos <a href="pedido/create"><button class="btn btn-success">Nuevo Pedido</button></a></h3><br>
			@include('deliveryc.pedido.search')
			<br>
			<h3>{{Auth::getUser()->name}}</h3>
		</div>
	</div>
		
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Id</th>						
						<th>Cliente</th>	
						<th>Fecha</th>
						<th>Monto (Bs.)</th>						
						<th>Tiempo Envío (Minutos)</th>
						<th>Zona</th>						
						<th>Estado Pedido</th>
						<th>Opciones</th>
					</thead>
					@foreach($pedidos as $ped)
					<tr>
						<td>{{ $ped->idpedido }}</td>
						<td>{{ $ped->nombre }} {{ $ped->apellido }}</td>
						<td>{{ $ped->fecha_creacion }}</td>					
						<td>Bs.- {{ $ped->monto }}</td>
						<td>{{ $ped->tiempo_total + $ped->tiempo_entrega}}</td>
						<td>{{ $ped->zona }}</td>
						<td>{{ $ped->descripcion }}</td>												
						<td width="180px">
							<a href="{{URL::action('PedidoCController@edit',$ped->idpedido)}}"><button class="btn btn-primary">Editar Estado</i></button></a><p></p>	
							<a href="{{URL::action('PedidoCController@show',$ped->idpedido)}}"><button class="btn btn-danger">Detalles</button></a>
						</td>
					</tr>
					@include('deliveryc.pedido.modal')
					@endforeach
				</table>
			</div>					
			{{$pedidos->render()}}
		</div>			
	</div>			
@endsection