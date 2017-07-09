@extends ('layouts.masterc')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Cliente: {{ $cliente->nombre}}</h3>
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

			{!! Form::model($cliente,
			['method'=>'PATCH','route'=>['cliente.update',$cliente->idcliente]])!!}
			{{Form::token()}}

	<div class="row">
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" required value="{{$cliente->nombre}}" class="form-control" placeholder="Nombre..">
			</div>	
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="apellido">Apellido</label>
				<input type="text" name="apellido" value="{{$cliente->apellido}}" class="form-control" placeholder="apellido..">
			</div>	
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="ci">C.I./NIT</label>
				<input type="number" name="ci" value="{{$cliente->ci}}" class="form-control" placeholder="Dirección..">
			</div>	
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label>Categoría Cliente</label>
				<select name="idcategoria_cliente" id="idcategoria_cliente" class="form-control selectpicker" data-live-search="true">
					@foreach($categoria_clientes as $cat)
						@if($cat->idcategoria_cliente == $cliente->idcategoria_cliente)
							<option value="{{$cat->idcategoria_cliente}}" selected>{{$cat->descripcion}}</option>
							@else
							<option value="{{$cat->idcategoria_cliente}}">{{$cat->descripcion}}</option>
						@endif												
					<@endforeach>
				</select>			
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="tel_fijo">Teléfono Fijo</label>
				<input type="number" name="tel_fijo" value="{{$cliente->tel_fijo}}" class="form-control" placeholder="Número de documento..">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="celular">Celular</label>
				<input type="number" name="celular" value="{{$cliente->celular}}" class="form-control" placeholder="Teléfono..">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="email">Email</label>
				<input type="text" name="email" value="{{$cliente->email}}" class="form-control" placeholder="Email..">
			</div>
		</div>	
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="direccion">Dirección</label>
				<input type="text" name="direccion" value="{{$cliente->direccion}}" class="form-control" placeholder="Dirección..">
			</div>
		</div>		
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="latitud">Latitud</label>
				<input type="number" name="latitud" id="latitud" value="{{$cliente->latitud}}" class="form-control" placeholder="Latitud..">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="longitud">Longitud</label>
				<input type="number" name="longitud" id="longitud" value="{{$cliente->longitud}}" class="form-control" placeholder="Longitud..">
			</div>
		</div>
		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
		</div>
	</div>
	<div class="row">
		<h1>My First Google Map</h1>

	<div id="googleMap" style="width:100%;height:400px;"></div>
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
		
	function myMap() {
		var mapProp= {
		    center:new google.maps.LatLng(lat,lon),
		    zoom:5,
		};
		var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
	}

</script>
@endpush			
@endsection