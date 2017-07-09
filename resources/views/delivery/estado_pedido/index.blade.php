@extends ('layouts.master')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Estados <a href="estado_pedido/create"><button class="btn btn-success">Nuevo Estado</button></a></h3><br>
			@include('delivery.estado_pedido.search')
			<br>
		</div>
	</div>
		
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Id</th>						
						<th>Descripcion</th>
						<th>Opciones</th>
					</thead>
					@foreach($estados as $est)
					<tr>
						<td>{{ $est->idestado }}</td>
						<td>{{ $est->descripcion }}</td>
						<td>
							<a href="{{URL::action('EstadoPedidoController@edit',$est->idestado)}}"><button class="btn btn-primary">Editar</button></a>
							<a href="" data-target="#modal-delete-{{$est->idestado}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
						</td>
					</tr>
					@include('delivery.estado_pedido.modal')
					@endforeach
				</table>
			</div>
			{{$estados->render()}}
		</div>			
	</div>			
@endsection