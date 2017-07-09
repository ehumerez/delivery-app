@extends ('layouts.master')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Producto: {{ $producto->descripcion}}</h3>
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
			{!! Form::model($producto,['method'=>'PATCH','route'=>['producto.update',$producto->idproducto],'files'=>'true'])!!}
			{{Form::token()}}		
	<div class="row">	
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" required value="{{$producto->nombre}}" class="form-control" placeholder="Nombre..">
			</div>	
		</div>		
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label>Categoría</label>
				<select name="idcategoria_producto" id="idcategoria_producto" class="form-control">
					@foreach($categorias as $cat)
						@if($cat->idcategoria_producto==$producto->idcategoria_producto)
							<option value="{{$cat->idcategoria_producto}}" selected>{{$cat->descripcion}}</option>
						@else
							<option value="{{$cat->idcategoria_producto}}">{{$cat->descripcion}}</option>
						@endif						
					<@endforeach>
				</select>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="precio">Precio</label>
				<input type="text" name="precio" required value="{{$producto->precio}}" class="form-control" placeholder="Precio.. Bs 00.00.-">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="tiempo_prep">Tiempo Preparación</label>
				<input type="text" name="tiempo_prep" required value="{{$producto->tiempo_prep}}" class="form-control" placeholder="Tiempo Preparación del Producto..">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="info">Información</label>
				<input type="text" name="info" required value="{{$producto->info}}" class="form-control" placeholder="info del Producto..">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="imagen">Imagen</label>
				<input type="file" name="imagen" class="form-control">
			</div>
		</div>
		
		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
			<div class="form-group">
				@if(($producto->imagen) != "")
				<img src="{{ asset('/imagenes/productos/'.$producto->imagen) }}" alt="{{$producto->nombre}}" height="200px" width="200px" class="img-thumbnail">
				@endif
			</div>
		</div>

	<div class="row" id="detalles1">
		<div class="panel panel-primary">	
			<div class="panel-body">	
			<h4>Gestionar Combo</h4>			
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
								@foreach($producto_combos as $prod_comb)
									<tr>
										<td></td>
										<td>{{$prod_comb->producto}}</td>
										<td>{{$prod_comb->cantidad}}</td>
										<td>{{$prod_comb->precioc}}</td>
										<td>{{$prod_comb->tiempo_prepc}}</td>
										<td>{{$prod_comb->cantidad*$prod_comb->precioc}}</td>
										<td>{{$prod_comb->cantidad*$prod_comb->tiempo_prepc}}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				
			</div>
		</div>
	</div>

		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
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

	$(document).ready(function(){		
		if ($("#categoria").text() != "Combos") {
			$("#detalles1").hide();		
		}else{
			$("#detalles1").show();	
		}
	});
	var cont = 0;
	total_precio = 0;
	total_tiempo=0;
	subtotalprecio=[];//Sirve para capturar todos los subtotales de cada una de las líneas de los detalles
	subtotaltiempo=[];
	//$("#guardar").hide();
	//$("#detalles").hide();
//////////////////////////////////////////////////////////////////////////////
	$("#idcategoria_producto").change(mostrarTabla);

	function mostrarTabla(){
		producto=$("#idcategoria_producto option:selected").text();
		if (producto!="Combos") {
			$("#detalles1").hide();		
		}else{
			$("#detalles1").show();	
		}	
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
			$("#precio").val(total_precio);

			$("#total_tiempo").html("Min. " + total_tiempo);//  html porq es un h4
			$("#total_tiempo").val(total_tiempo);// val porq es un input
			$("#tiempo_prep").val(total_tiempo);

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