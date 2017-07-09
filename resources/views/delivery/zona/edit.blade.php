@extends ('layouts.master')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Zona: {{ $zona->descripcion}}</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!! Form::model($zona,['method'=>'PATCH','route'=>['zona.update',$zona->idzona]])!!}
			{{Form::token()}}			
			<div class="form-group">
				<label for="descripcion">Descripcion</label>
				<input type="text" name="descripcion" class="form-control" value="{{ $zona->descripcion }}" placeholder="Descripción..">
			</div>
			<div class="form-group">
				<label for="costo_envio">Costo de Envío</label>
				<input type="number" name="costo_envio" class="form-control" value="{{ $zona->costo_envio }}" placeholder="Costo de Envío..">
			</div>
			<div class="form-group">
				<label for="tiempo_entrega">Tiempo de Envío</label>
				<input type="number" name="tiempo_entrega" value="{{ $zona->tiempo_entrega }}" class="form-control" placeholder="Tiempo de Envío..">
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
			{!!Form::close()!!}

		</div>
	</div>
@endsection