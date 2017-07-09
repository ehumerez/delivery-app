@extends ('layouts.masterc')
@section ('contenido')
<div class="row">
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<p>{{ $producto->nombre }}</p>
			</div>	
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="nombre" >Categoría</label>
				<p id="categoria"">{{$producto->descripcion}}</p>
			</div>	
		</div>
	
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="precio">Precio</label>
				<p>Bs.- {{$producto->precio}}</p>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="tiempo_prep">Tiempo Preparación</label>
				<p>{{$producto->tiempo_prep}} min.</p>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="info">Información</label>
				<p>{{$producto->info}}</p>
			</div>
		</div>
	</div>

	<div class="row" id="detalles1">
		<div class="panel panel-primary">	
			<div class="panel-body">		
				

				<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
					<div class="table-responsive">
						<table id="detalles" class="table table-striped table-bordered table-condensed table-hover>
							<thead style="background-color: #A9D0F5">								
								<th>Producto</th>
								<th>Cantidad</th>
								<th>Precio (Bs.)</th>
								<th>Tiempo Preparación (Minutos)</th>							
								<th>Subtotal Precio (Bs.)</th>
								<th>Subtotal Tiempo (Minutos)</th>
							</thead>						
							<tfoot>
								<th>TOTALES</th>
								<th></th>								
								<th></th>							 					
								<th></th>
								<th><h4 id="total_precio">Bs/. 0.00</h4><input type="hidden" name="total_precio" id="total_precio"></th>
								<th><h4 id="total_tiempo">Min. 00:00:00</h4><input type="hidden" name="total_tiempo" id="total_tiempo"></th>
							</tfoot>
							<tbody>
								@foreach($producto_combos as $prod_comb)
									<tr>
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
@push('scripts')
<script>
	
	$(document).ready(function(){		
		if ($("#categoria").text() != "Combos") {
			$("#detalles1").hide();		
		}else{
			$("#detalles1").show();	
		}
	});
	
</script>
@endpush
@endsection