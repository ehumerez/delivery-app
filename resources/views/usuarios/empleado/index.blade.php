@extends ('layouts.master')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Empleados <a href="empleado/create"><button class="btn btn-success">Nuevo Empleado</button></a></h3><br>
			@include('usuarios.empleado.search')
			<br>
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table  table-bordered table-condensed table-hover">
					<thead >
						<tr class="active">
							<th>Ci</th>
							<th>Nombre</th>
							<th>Apellido</th>							
							<th>Rol</th>								
							<th>Email</th>
							<th>Dirección</th>
							<th>Teléfono</th>	
							<th>Estado</th>					
							<th>Opciones</th>
						</tr>
					</thead>
					
					@foreach($empleados as $empleado)
					<tr>
						<td>{{ $empleado->ci }}</td>
						<td>{{ $empleado->nombre }}</td>
						<td>{{ $empleado->apellido }}</td>
						<td>{{ $empleado->descripcion }}</td>
						<td>{{ $empleado->email }}</td>						
						<td>{{ $empleado->direccion }}</td>
						<td>{{ $empleado->telefono }}</td>
						<td>{{ $empleado->estado }}</td>
						<td>
							
							<a href="{{URL::action('EmpleadoController@edit',$empleado->ci)}}">
								<button class="btn btn-primary"	><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
							</a>

							<a href="" data-target="#modal-delete-{{$empleado->ci}}" data-toggle="modal"><button class="btn btn-danger" 
							><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>
						</td>
					</tr>
					@include('usuarios.empleado.modal')				
					@endforeach
					
				</table>
			</div>
			{{$empleados->render()}}
		</div>			
	</div>	

@push ('scripts')
	<script>
      $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
      });
    </script>
@endpush		
@endsection