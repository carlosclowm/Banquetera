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
		{!!Form::open(array('url'=>'Inventario/Botellas/Nuevo/Agregar','method'=>'POST','autocomplete'=>'off',))!!}
		{{Form::token()}}
		<label>Categoria</label>
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-bars"></i></span>
			<input type="text" name="categoria" class="form-control" placeholder="Categoria de Botella...">
		</div>
		<br>
		<label>Nombre</label>
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-tags"></i></span>
			<input type="text" name="nombre" class="form-control" placeholder="Nombre de la Botella...">
		</div>
		<br>
		<label>Capacidad [ml]</label>
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-tags"></i></span>
			<input type="text" name="capacidad" class="form-control" placeholder="Capacidad de la Botella...">
		</div>
		<div>
			<br>
			<button class="btn btn-primary" type="submit">Agregar</button>
			<a href="/Inventario/Botellas" class="btn btn-danger">Cancelar</a>
		</div>
		{!!Form::close()!!}
	</div>
</div>
@endsection