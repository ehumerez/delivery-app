@extends ('layouts.master')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Empleado: {{ $empleado->nombre}}</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
		</div>
	</div>

			{!! Form::model($empleado,
			['method'=>'PATCH','route'=>['empleado.update',$empleado->ci]])!!}
			{{Form::token()}}

	<div class="row">
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="ci">C.I.</label>
				<input type="number" name="ci" value="{{$empleado->ci}}" class="form-control" placeholder="Dirección..">
			</div>	
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label>Rol Empleado</label>
				<select name="idrol" id="idrol" class="form-control selectpicker" data-live-search="true">
					@foreach($roles as $rol)
						@if($empleado->idrol == $rol->idrol)
							<option value="{{$rol->idrol}}" selected>{{$rol->descripcion}}</option>
						@else
							<option value="{{$rol->idrol}}">{{$rol->descripcion}}</option>
						@endif						
					<@endforeach>
				</select>			
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" required value="{{$empleado->nombre}}" class="form-control" placeholder="Nombre..">
			</div>	
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="apellido">Apellido</label>
				<input type="text" name="apellido" value="{{$empleado->apellido}}" class="form-control" placeholder="Apellido..">
			</div>	
		</div>
					
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="email">Email</label>
				<input type="text" name="email" value="{{$empleado->email}}" class="form-control" placeholder="Email..">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="direccion">Dirección</label>
				<input type="text" name="direccion" value="{{$empleado->direccion}}" class="form-control" placeholder="Dirección..">
			</div>
		</div>		
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="telefono">Teléfono</label>
				<input type="number" name="telefono" value="{{$empleado->telefono}}" class="form-control" placeholder="Teléfono..">
			</div>
		</div>		
		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
		</div>
	</div>
			{!!Form::close()!!}
@endsection