@extends ('layouts.master')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Ubicaciones <a href="create"><button class="btn btn-success">Nueva Ubicación</button></a></h3><br>
			@include('delivery.ubicacion_cliente.search')
			<br>
		</div>
	</div>
		
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Id</th>						
						<th>Cliente</th>
						<th>Descripcion</th>
						<th>Latitud</th>
						<th>Longitud</th>
						<th>Ubicación Actual</th>
						<th>Opciones</th>
					</thead>
					@foreach($ubicaciones as $ubic)
					<tr>
						<td>{{ $ubic->idubicacion }}</td>
						<td>{{ $ubic->nombre }} {{ $ubic->apellido }}</td>
						<td>{{ $ubic->descripcion }}</td>
						<td>{{ $ubic->latitud }}</td>
						<td>{{ $ubic->longitud }}</td>
						<td>{{ $ubic->ubicacion_actual }}</td>
						<td>
							<a href="{{URL::action('ClienteController@edit',$ubic->idubicacion)}}"><button class="btn btn-primary">Editar</button></a>
							<a href="" data-target="#modal-delete-{{$ubic->idubicacion}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
						</td>
					</tr>
					@include('delivery.ubicacion_cliente.modal')
					@endforeach
				</table>
			</div>
			{{$ubicaciones->render()}}
		</div>			
	</div>			
@endsection