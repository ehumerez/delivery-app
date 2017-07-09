@extends ('layouts.master')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			
			<h3>Nueva Ubicación</h3>
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
			{!! Form::open(array('url'=>'delivery/ubicacion_cliente','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}	
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">		
				<div class="form-group">
					<label for="idcliente">Clientes</label>
					<select name="idcliente" id="idcliente" class="form-control selectpicker" data-live-search="true">
						@foreach($clientes as $c)
							<option value="{{$c->idcliente}}">{{$c->nombre}} {{$c->apellido}}</option>
						<@endforeach>
					</select>
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group">
					<label for="descripcion">Descripcion</label>
					<input type="text" name="descripcion" class="form-control" placeholder="Descripción..">
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group">
					<label for="ubicacion_actual">Ubicación Actual</label>
					<input type="text" name="ubicacion_actual" class="form-control" placeholder="Ubicación Actual..">
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group">
					<label for="latitud">Latitud</label>
					<input type="number" name="latitud" id="latitud" class="form-control" placeholder="Latitud..">
				</div>
			</div>

			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group">
					<label for="longitud">Longitud</label>
					<input type="number" name="longitud" id="longitud" class="form-control" placeholder="Longitud..">
				</div>
			</div>

			
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group">
					<button class="btn btn-primary" onclick="geolocalizar();" type="button">Obtener Ubicación</button>
				</div>
			</div>
			
		<aside style="float: left;">
			<div class="aside">
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">		
					<div class="form-group">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d486365.2029935935!2d-63.29183279620604!3d-17.75744389473997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x93f1e81ca7c01a63%3A0x5c8b0a53a467611b!2sSanta+Cruz+de+la+Sierra%2C+Bolivia!5e0!3m2!1ses-419!2ses!4v1493023397381" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
					</div>
				</div>
			</div>	
		</aside>
			</div>
		
		
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
			{!!Form::close()!!}

@push('scripts')
<script type="text/javascript">
	var lat,lon;
	/*$(document).on("ready",inicio);
	function inicio() {
		geolocalizar();
	}*/

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