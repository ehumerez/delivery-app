@extends ('layouts.master')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Productos <a href="producto/create"><button class="btn btn-success">Nuevo Producto</button></a></h3><br>
			@include('productos.producto.search')
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
							<a href="{{URL::action('ProductoController@edit',$prod->idproducto)}}"><button class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
							<a href="" data-target="#modal-delete-{{$prod->idproducto}}" data-toggle="modal"><button class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>
							<a href="{{URL::action('ProductoController@show',$prod->idproducto)}}"><button class="btn btn-danger">Detalles</button></a>
						</td>
					</tr>
					@include('productos.producto.modal')
					@endforeach
				</table>
			</div>					
			{{$productos->render()}}
		</div>			
	</div>			
@endsection