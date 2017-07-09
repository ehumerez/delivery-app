@extends ('layouts.masterc')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Clientes <a href="cliente/create"><button class="btn btn-success">Registro de Cliente</button></a></h3><br>
			@include('deliveryc.cliente.search')
			<br>
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table  table-bordered table-condensed table-hover">
					<thead >
						<tr class="active">
							<th>Id</th>
							<th>Nombre</th>
							<th>Apellido</th>
							<th>Ci/Nit</th>
							<th>Teléfono Fijo</th>
							<th>Celular</th>
							<th>Email</th>
							<th>Dirección</th>	
							<th>Estado</th>					
							<th>Opciones</th>
						</tr>
					</thead>
					
					@foreach($clientes as $cliente)
					<tr>
						<td>{{ $cliente->idcliente}}</td>
						<td>{{ $cliente->nombre }}</td>
						<td>{{ $cliente->apellido }}</td>
						<td>{{ $cliente->ci }}</td>
						<td>{{ $cliente->tel_fijo }}</td>
						<td>{{ $cliente->celular }}</td>
						<td>{{ $cliente->email }}</td>
						<td>{{ $cliente->direccion }}</td>
						<td>{{ $cliente->estado }}</td>
						<td>
							
							<a href="{{URL::action('ClienteCController@edit',$cliente->idcliente)}}">
								<button class="btn btn-primary"	><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
							</a>

							<a href="" data-target="#modal-delete-{{$cliente->idcliente}}" data-toggle="modal"><button class="btn btn-danger" 
							><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>
						</td>
					</tr>
					@include('deliveryc.cliente.modal')				
					@endforeach
					
				</table>
			</div>
			{{$clientes->render()}}
		</div>			
	</div>	

@push ('scripts')
	<script>
      $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
      });
    </script>
@endpush		
@endsection