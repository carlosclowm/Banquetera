@extends ('layouts.app')
@section ('contenido')
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Editar Proveedor</h3>
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
		{!!Form::open(array('url'=>'Proveedores/Edit','method'=>'POST','autocomplete'=>'off',))!!}
		{{Form::token()}}
		<input type="test" name="id" value="{{$Proveedor->id_proveedor}}" hidden="">
		<label>Nombre</label>
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-bars"></i></span>
			<input type="text" name="nombre" class="form-control" value="{{$Proveedor->nombre}}" required>
		</div>
		<br>
		<label>Empresa</label>
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-tags"></i></span>
			<input type="text" name="empresa" class="form-control" value="{{$Proveedor->empresa}}" required>
		</div>
		<br>
		<label>RFC</label>
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-tags"></i></span>
			<input type="text" name="rfc" class="form-control" value="{{$Proveedor->rfc}}">
		</div>
    <br>
    <label>Telefono</label>
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-tags"></i></span>
			<input type="text" name="telefono" class="form-control" value="{{$Proveedor->telefono}}" required>
		</div>
		<div>
			<br>
			<button class="btn btn-primary" type="submit">Editar</button>
			<a href="/Clientes" class="btn btn-danger">Cancelar</a>
		</div>
		{!!Form::close()!!}
	</div>
</div>
@endsection
