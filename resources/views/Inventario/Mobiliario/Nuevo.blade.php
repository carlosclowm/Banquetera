@extends ('layouts.app')
@section ('contenido')
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Nuevo</h3>
	</div>
	<div class="box-body">
		@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
		{!!Form::open(array('url'=>'Inventario/Mobiliario/Nuevo/Agregar','method'=>'POST','autocomplete'=>'off',))!!}
		{{Form::token()}}
		<label>Tipo</label>
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-bars"></i></span>
			<input type="text" name="tipo" class="form-control" placeholder="Tipo de Mobiliario...">
		</div>
		<br>
		<label>Nombre</label>
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-tags"></i></span>
			<input type="text" name="nombre" class="form-control" placeholder="Nombre del Mobiliario...">
		</div>
		<div>
			<br>
			<button class="btn btn-primary" type="submit">Agregar</button>
			<a href="/Inventario/Mobiliario" class="btn btn-danger">Cancelar</a>
		</div>
		{!!Form::close()!!}
	</div>
</div>
@endsection