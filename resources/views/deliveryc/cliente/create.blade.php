@extends ('layouts.masterc')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Cliente</h3>
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

		{!! Form::open(array('url'=>'deliveryc/cliente','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}

	<div class="row">
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="Nombre..">
			</div>	
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="apellido">Apellido</label>
				<input type="text" name="apellido" value="{{old('apellido')}}" class="form-control" placeholder="apellido..">
			</div>	
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="ci">C.I./NIT</label>
				<input type="number" name="ci" value="{{old('ci')}}" class="form-control" placeholder="Número de documento..">
			</div>	
		</div>
		
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="tel_fijo">Teléfono Fijo</label>
				<input type="number" name="tel_fijo" value="{{old('tel_fijo')}}" class="form-control" placeholder="Telefono">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="celular">Celular</label>
				<input type="number" name="celular" value="{{old('celular')}}" class="form-control" placeholder="Teléfono..">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="direccion">Dirección</label>
				<input type="text" name="direccion" value="{{old('direccion')}}" class="form-control" placeholder="Dirección..">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="Email..">
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
@push('scripts')
<script type="text/javascript">
	var lat,lon;
	$(document).on("ready",inicio);
	function inicio() {
		geolocalizar();
	}

	function geolocalizar() {		
		navigator.geolocation.getCurrentPosition(mostrar,mostrarError);		
	}

	function mostrarError(errorsh) {
		alert("Error al obtener la ubicacion_actual");
		console.log(errorsh);
	}

	function mostrar(geo) {
		lat = geo.coords.latitude;
		lon = geo.coords.longitude;	
		$("#latitud").val(lat);
		$("#longitud").val(lon);
	}
		
	
</script>
@endpush		
@endsection