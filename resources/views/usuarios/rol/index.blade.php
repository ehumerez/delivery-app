@extends ('layouts.master')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Roles <a href="rol/create"><button class="btn btn-success">Nuevo Rol</button></a></h3><br>
			@include('usuarios.rol.search')
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
					@foreach($roles as $rol)
					<tr>
						<td>{{ $rol->idrol }}</td>
						<td>{{ $rol->descripcion }}</td>
						<td>
							<a href="{{URL::action('RolController@edit',$rol->idrol)}}"><button class="btn btn-primary">Editar</button></a>
							<a href="" data-target="#modal-delete-{{$rol->idrol}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
						</td>
					</tr>
					@include('usuarios.rol.modal')
					@endforeach
				</table>
			</div>
			{{$roles->render()}}
		</div>			
	</div>			
@endsection