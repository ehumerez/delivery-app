@extends ('layouts.masterc')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Productos</h3><br>
			@include('productosc.producto.search')
			<br>
		</div>
	</div>
		
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Id</th>						
						<th>Nombre</th>										
						<th>Categoria</th>
						<th>Imagen</th>						
						<th>Precio (Bs.)</th>
						<th>Tiempo Prep (Minutos)</th>						
						<th>Información</th>
						<th>Estado</th>
						<th>Opciones</th>
					</thead>
					@foreach($productos as $prod)
					<tr>
						<td>{{ $prod->idproducto }}</td>
						<td>{{ $prod->nombre }}</td>
						<td>{{ $prod->categoria }}</td>
						<td>
							<img src="{{ asset('/imagenes/productos/'.$prod->imagen) }}" alt="{{$prod->nombre}}" height="150px" width="150px" class="img-thumbnail">
						</td>
						<td>Bs.- {{ $prod->precio }}</td>
						<td>{{ $prod->tiempo_prep }}</td>
						<td>{{ $prod->info }}</td>
						<td>{{ $prod->estado }}</td>												
						<td width="180px">							
							<a href="{{URL::action('ProductoCController@show',$prod->idproducto)}}"><button class="btn btn-danger">Detalles</button></a>
						</td>
					</tr>
					@include('productosc.producto.modal')
					@endforeach
				</table>
			</div>					
			{{$productos->render()}}
		</div>			
	</div>			
@endsection