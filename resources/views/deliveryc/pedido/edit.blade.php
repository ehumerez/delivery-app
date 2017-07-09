@extends ('layouts.masterc')
@section ('contenido')
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h3>Editar Pedido NRO: {{ $pedido->idpedido}}, realizada en FECHA: {{ $pedido->fecha_creacion}}</h3>
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
			{!! Form::model($pedido,['method'=>'PATCH','route'=>['pedido.update',$pedido->idpedido],'files'=>'true'])!!}
			{{Form::token()}}		
	<div class="row">	
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Cliente</label>
				<p>{{$cliente->nombre}} {{$cliente->apellido}}</p>
			</div>	
		</div>	

		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label>Estado pedido</label>
				<select name="idestado" id="idestado" class="form-control selectpicker" data-live-search="true">
					@foreach($estado_pedidos as $ep)
						@if($ep->idestado==$pedido->idestado)
							<option value="{{$ep->idestado}}" selected>{{$ep->descripcion}}</option>
						@else
							<option value="{{$ep->idestado}}">{{$ep->descripcion}}</option>
						@endif						
					<@endforeach>
				</select>
			</div>
		</div>

		<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
			<div class="form-group">
				<label for="estado_pedidos">ACTUALIZAR EL ESTADO DEL PEDIDO</label>
				<input type="text" name="estado_pedidos" id="estado_pedidos" required value="{{$pedido->descripcion}}" class="form-control" placeholder="Actualizar estado del pedido..">
			</div>
		</div>

		<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
			<div class="form-group">
				<label for="zona">Zona</label>
				<p>{{$zona->descripcion}}</p>
			</div>
		</div>

		<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
			<div class="form-group">
				<label for="monto">Precio (Bs.)</label>
				<p>{{$pedido->monto}}</p>
			</div>
		</div>
		<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
			<div class="form-group">
				<label for="tiempo_total">Tiempo Pedido (Minutos)</label>
				<p>{{$pedido->tiempo_total}}</p>
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
<script>

	$("#idestado").change(mostrarTabla);

	function mostrarTabla(){
		estado_pedidos=$("#idestado option:selected").text();
			$("#estado_pedidos").val(estado_pedidos);
		}

	
</script>
@endpush
@endsection