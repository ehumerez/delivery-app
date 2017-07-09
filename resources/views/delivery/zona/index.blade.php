@extends ('layouts.master')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Zonas <a href="zona/create"><button class="btn btn-success">Nueva Zona</button></a></h3><br>
			@include('delivery.zona.search')
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
						<th>Costo Envío (Bs.)</th>						
						<th>Tiempo Entrega (Minutos)</th>
						<th>Opciones</th>
					</thead>
					@foreach($zonas as $zona)
					<tr>
						<td>{{ $zona->idzona }}</td>
						<td>{{ $zona->descripcion }}</td>
						<td>{{ $zona->costo_envio }}</td>
						<td>{{ $zona->tiempo_entrega }}</td>
						<td>
							<a href="{{URL::action('ZonaController@edit',$zona->idzona)}}"><button class="btn btn-primary">Editar</button></a>
							<a href="" data-target="#modal-delete-{{$zona->idzona}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
						</td>
					</tr>
					@include('delivery.zona.modal')
					@endforeach
				</table>
			</div>
			{{$zonas->render()}}
		</div>			
	</div>			
@endsection