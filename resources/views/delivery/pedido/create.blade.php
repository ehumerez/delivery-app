@extends ('layouts.master')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Pedido</h3>
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

		{!! Form::open(array('url'=>'delivery/pedido','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
			{{Form::token()}}

	<div class="row">
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label>Cliente</label>
				<select name="idcliente" id="idcliente" class="form-control selectpicker" data-live-search="true">
					@foreach($clientes as $cliente)

						<option value="{{$cliente->idcliente}}_{{$cliente->direccion}}">{{$cliente->nombre}} {{$cliente->apellido}} - C.I.: {{$cliente->ci}}</option>
						
					<@endforeach>
					<input type="hidden" name="didcliente" id="didcliente">
				</select>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label>Empleado</label>
				<select name="ci" id="ci" class="form-control selectpicker" data-live-search="true">
					@foreach($empleados as $empleado)
						<option value="{{$empleado->ci}}">{{$empleado->nombre}} {{$empleado->apellido}}	- {{$empleado->descripcion}}</option>	
					<@endforeach>
				</select>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="direccion">Dirección</label>
				<input type="text" required name="direccion" id="direccion" required value="{{old('direccion')}}" class="form-control" placeholder="Dirección del cliente..">
			</div>
		</div>
		

		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label>Zona</label>
				<select name="idzona" id="idzona" class="form-control selectpicker" data-live-search="true">
					@foreach($zonas as $zona)
						<option value="{{$zona->idzona}}_{{$zona->costo_envio}}_{{$zona->tiempo_entrega}}">{{$zona->descripcion}}</option>

					<@endforeach>
					<input type="hidden" name="didzona" id="didzona">
				</select>
			</div>
		</div>
		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
			<div class="form-group">
				<label for="observaciones">Observaciones</label>
				<input type="text" name="observaciones" id="observaciones" required value="{{old('observaciones')}}" class="form-control" placeholder="Observaciones..">
			</div>
		</div>
		<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
			<div class="form-group">
				<label for="costo_envio">Costo envío (Bs.)</label>
				<input type="number" name="costo_envio" id="costo_envio" required value="{{old('costo_envio')}}" class="form-control" placeholder="Costo envío.. Bs 00.00.-">
			</div>
		</div>
		<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
			<div class="form-group">
				<label for="monto">Total costo pedido (Bs.)</label>
				<input type="number" name="monto" id="monto" required value="{{old('monto')}}" class="form-control" placeholder="Total costo pedido.. Bs 00.00.-">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="tiempo_entrega">Total tiempo entrega (Minutos)</label>
				<input type="number" name="tiempo_entrega" id="tiempo_entrega" required value="{{old('tiempo_entrega')}}" class="form-control" placeholder="Total tiempo entrega..">
				<input type="hidden" name="tiempo_pedido" id="tiempo_pedido">
			</div>
		</div>			
		
	</div>

	<div class="row" id="detalles1">
		<div class="panel panel-primary">	
			<div class="panel-body">	
			<h4>Productos</h4>			
				<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
					<div class="form-group">
						<label>Producto</label>
						<select name="pidproducto" id="pidproducto" class="form-control selectpicker" data-live-search="true">
							@foreach($productos as $prod)
								
								<option value="{{$prod->idproducto}}_{{$prod->precio}}_{{$prod->tiempo_prep}}">{{$prod->nombre}}</option>
								
							@endforeach
						</select>
					</div>
				</div>
				
				<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
					<div class="form-group">
						<label for="pcantidad">Cantidad</label>
						<input type="number" name="pcantidad" id="pcantidad" class="form-control" placeholder="Cantidad">
					</div>
				</div>
				<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
					<div class="form-group">
						<label for="pprecio">Precio</label>
						<input type="number" disabled name="pprecio" id="pprecio" class="form-control" placeholder="Precio">
					</div>
				</div>
				<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
					<div class="form-group">
						<label for="ptiempo_prep">Tiempo Prep</label>
						<input type="number" disabled name="ptiempo_prep" id="ptiempo_prep" class="form-control" placeholder="Tiempo preparación">
					</div>
				</div>			
				<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
					<div class="form-group">
						<label></label>
						<button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
					</div>
				</div>

				<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
					<div class="table-responsive">
						<table id="detalles" class="table table-striped table-bordered table-condensed table-hover>
							<thead style="background-color: #A9D0F5">
								<th>Opciones</th>
								<th>Producto</th>
								<th>Cantidad</th>
								<th>Precio</th>
								<th>Tiempo Preparación</th>							
								<th>Subtotal Precio</th>
								<th>Subtotal Tiempo</th>
							</thead>						
							<tfoot>
								<th>TOTALES</th>
								<th></th>
								<th></th>
								<th></th>							 					
								<th></th>
								<th><h4 id="total_precio">Bs/. 0.00</h4><input type="hidden" name="total_precio" id="total_precio"></th>
								<th><h4 id="total_tiempo">Min. 00:00:00</h4><input type="hidden" name="total_tiempo" id="total_tiempo"></th>
							</tfoot>
							<tbody>
								
							</tbody>
						</table>
					</div>
				</div>
				
			</div>
		</div>
	</div>

		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">
			<div class="form-group">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
		</div>
		{!!Form::close()!!}


@push('scripts')
<script>
	$(document).ready(
		function(){
			$('#bt_add').click(
				function(){
					agregar();
				});
		});
	cont = 0;
	total_precio = 0;
	total_tiempo=0;
	subtotalprecio=[];//Sirve para capturar todos los subtotales de cada una de las líneas de los detalles
	subtotaltiempo=[];

/////////////////////////////////////////////////////////////////////////////
	costo_envio = 0;
	tiempo_pedido = 0;
	$("#idcliente").change(mostrarDatosCliente);

	function mostrarDatosCliente(){
		datosCliente = document.getElementById('idcliente').value.split('_');		
		$("#direccion").val(datosCliente[1]);
		$("#didcliente").val(datosCliente[0]);
	}
/////////////////////////////////////////////////////////////////////////////
$("#idzona").change(mostrarDatosZona);

	function mostrarDatosZona(){
		datosZona = document.getElementById('idzona').value.split('_');
		costo_envio=datosZona[1];
		tiempo_pedido=datosZona[2];
		$("#costo_envio").val(datosZona[1]);
		$("#tiempo_entrega").val(datosZona[2]);
		$("#didzona").val(datosZona[0]);
	}	

/////////////////////////////////////////////////////////////////////////////
	$("#pidproducto").change(mostrarValores);

	function mostrarValores(){
		datosProductos = document.getElementById('pidproducto').value.split('_');
		$("#pprecio").val(datosProductos[1]);
		$("#ptiempo_prep").val(datosProductos[2]);
	}
	
	function agregar(){
		datosProductos = document.getElementById('pidproducto').value.split('_');
		idproducto = datosProductos[0];
		producto=$("#pidproducto option:selected").text();
		cantidad=$("#pcantidad").val();
		precio=$("#pprecio").val();
		tiempo_prep=$("#ptiempo_prep").val();

		if (idproducto!="" && cantidad!="" && cantidad>0 && tiempo_prep!="" && precio!="") {

			subtotalprecio[cont] = (cantidad*precio);
			subtotaltiempo[cont] = (cantidad*tiempo_prep);
			total_precio=total_precio+subtotalprecio[cont];

			total_tiempo=total_tiempo+subtotaltiempo[cont];

			var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td><td><input type="hidden" name="pidproducto[]" value="'+idproducto+'">'+producto+'</td><td><input type="number" name="pcantidad[]" value="'+cantidad+'"></td><td><input type="number" name="pprecio[]" value="'+precio+'"></td><td><input type="number" name="ptiempo_prep[]" value="'+tiempo_prep+'"></td><td>'+subtotalprecio[cont]+'</td> <td>'+subtotaltiempo[cont]+'</td> </tr>';
			cont++;
			limpiar();
			$("#total_precio").html("Bs/." + total_precio);//  html porq es un h4
			$("#total_precio").val(total_precio);// val porq es un input
			//$("#precio").val(total_precio);
			$("#monto").val(total_precio+parseInt(costo_envio));

			$("#total_tiempo").html("Min. " + total_tiempo);//  html porq es un h4
			$("#total_tiempo").val(total_tiempo);// val porq es un input
			$("#tiempo_prep").val(total_tiempo);
			$("#tiempo_entrega").val(total_tiempo+parseInt(tiempo_pedido));
			$("#tiempo_pedido").val(tiempo_pedido);

			evaluar();
			$("#detalles").append(fila); // #detalles id de la tabla
		}else {
			alert("Error al ingresar los productos para gestionar el combo, revise los datos del producto.");			
		}

		
	};

	//Jquery toma los id para identificar
	function limpiar(){
		$("#pcantidad").val("");
		$("#ptiempo_prep").val("");
		$("#pprecio").val("");
	}

	function evaluar(){
		/*if (total_precio>0) {
			$("#guardar").show();
		}else{
			$("#guardar").hide();
		}*/
		$("#guardar").show();
	}

	function eliminar(index){
		total_precio = total_precio - subtotalprecio[index];
		total_tiempo = total_tiempo - subtotaltiempo[index];
		$("#total_precio").html("Bs/. "+total_precio);
		$("#total_precio").val(total_precio);
		$("#precio").val(total_precio);
		
		$("#total_tiempo").html("Min. "+total_tiempo);
		$("#total_tiempo").val(total_tiempo);
		$("#tiempo_prep").val(total_tiempo);
		$("#fila" + index).remove();
		evaluar();
	}
</script>
@endpush
@endsection