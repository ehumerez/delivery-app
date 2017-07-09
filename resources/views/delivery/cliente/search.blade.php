{!! Form::open(array('url'=>'delivery/cliente','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}

<div class="form-group">
	<div class="input-group">

		<input type="text" class="form-control" name="searchText" placeholder="Buscar.." value="{{$searchText}}">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-default"
			data-toggle="tooltip" data-placement="top" title="Busca un artículo por su nombre o código.">Buscar</button>
		</span>

	</div>
</div>

{{Form::close()}}