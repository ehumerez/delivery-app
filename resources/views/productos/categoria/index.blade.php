@extends ('layouts.master')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Categorías <a href="categoria/create"><button class="btn btn-success">Nueva Categoría</button></a></h3><br>
			@include('productos.categoria.search')
			<br>
		</div>
	</div>
		
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Id</th>						
						<th>Descripcion</th>
						<th>Opciones</th>
					</thead>
					@foreach($categorias as $cat)
					<tr>
						<td>{{ $cat->idcategoria_producto }}</td>
						<td>{{ $cat->descripcion }}</td>
						<td>
							<a href="{{URL::action('CategoriaProductoController@edit',$cat->idcategoria_producto)}}"><button class="btn btn-primary">Editar</button></a>
							<a href="" data-target="#modal-delete-{{$cat->idcategoria_producto}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
						</td>
					</tr>
					@include('productos.categoria.modal')
					@endforeach
				</table>
			</div>
			{{$categorias->render()}}
		</div>			
	</div>			
@endsection