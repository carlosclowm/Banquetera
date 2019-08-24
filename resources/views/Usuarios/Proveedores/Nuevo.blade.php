@extends ('layouts.app')
@section ('contenido')
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Nuevo Proveedor</h3>
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
		{!!Form::open(array('url'=>'Proveedores/Nuevo/Agregar','method'=>'POST','autocomplete'=>'off',))!!}
		{{Form::token()}}
		<label>Nombre</label>
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-bars"></i></span>
			<input type="text" name="nombre" class="form-control" placeholder="Nombre del Proveedor..." required>
		</div>
		<br>
		<label>Empresa</label>
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-tags"></i></span>
			<input type="text" name="empresa" class="form-control" placeholder="Empresa del Cliente..." required>
		</div>
		<br>
		<label>RFC</label>
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-tags"></i></span>
			<input type="text" name="rfc" class="form-control" placeholder="RFC del Cliente... (Opcional)">
		</div>
    <br>
    <label>Telefono</label>
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-tags"></i></span>
			<input type="text" name="telefono" class="form-control" placeholder="Telefono del Cliente..." required>
		</div>
		<div>
			<br>
			<button class="btn btn-primary" type="submit">Agregar</button>
			<a href="/Clientes" class="btn btn-danger">Cancelar</a>
		</div>
		{!!Form::close()!!}
	</div>
</div>
@endsection
