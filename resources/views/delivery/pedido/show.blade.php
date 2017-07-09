@extends ('layouts.master')
@section ('contenido')
<div class="row">
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="cliente">Cliente</label>
				<p>{{ $cliente->nombre }} {{ $cliente->apellido }} - {{ $cliente->ci }} - Dir.: {{ $cliente->direccion }}</p>
			</div>	
		</div>

		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="empleado">Empleado</label>
				<p>{{ $empleado->nombre }} {{ $empleado->apellido }} {{ $empleado->descripcion }} </p>
			</div>	
		</div>

		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="zona">Zona</label>
				<p>{{$zona->descripcion}}</p>
			</div>
		</div>
		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
			<div class="form-group">
				<label for="observaciones">Observaciones</label>
				<p>{{ $pedido->observaciones }}</p>
			</div>
		</div>
		<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
			<div class="form-group">
				<label for="costo_envio">Costo envío (Bs.)</label>
				<p> {{ $zona->costo_envio}}</p>
			</div>
		</div>
		<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
			<div class="form-group">
				<label for="monto">Total costo pedido (Bs.)</label>
				<p> {{ $pedido->monto }} </p>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="tiempo_entrega">Total tiempo entrega (Minutos)</label>
				<p> {{ $pedido->tiempo_total }} </p>
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
								<th>Tiempo Preparación (Min)</th>			
								<th>Subtotal Precio</th>
								<th>Subtotal Tiempo</th>
							</thead>						
							<tfoot>
								<th>TOTALES</th>
								<th></th>								
								<th></th>		
								<th></th>
								<th> <h4>Bs.- {{$pedido->monto}}</h4>  </th>
								<th><h4>Min. {{$pedido->tiempo_total}} </h4></th>
							</tfoot>
							<tbody>				
								@foreach($detalle as $det)
									<tr>
										<td>{{$det->nombre}}</td>
										<td>{{$det->cantidad}}</td>
										<td>{{$det->precio}}</td>
										<td>{{$det->tiempo_prep}}</td>
										<td>{{$det->sub_total}}</td>
										<td>{{$det->tiempo_parcial}}</td>
									</tr>
								@endforeach
							</tbody>

						</table>
					</div>
				</div>
				
			</div>
		</div>
	</div>

@endsection