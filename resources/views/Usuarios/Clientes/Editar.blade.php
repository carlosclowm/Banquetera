@extends ('layouts.app')
@section ('contenido')
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Editar Cliente</h3>
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
		{!!Form::open(array('url'=>'Clientes/Edit','method'=>'POST','autocomplete'=>'off',))!!}
		{{Form::token()}}
		<input type="text" name="id" hidden="" value="{{$Cliente->id_cliente}}">
		<label>Nombre</label>
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-bars"></i></span>
			<input type="text" name="nombre" class="form-control" value="{{$Cliente->nombre}}" required>
		</div>
		<br>
		<label>Domicilio</label>
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-tags"></i></span>
			<input type="text" name="domicilio" class="form-control" value="{{$Cliente->domicilio}}">
		</div>
		<br>
		<label>Telefono</label>
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-tags"></i></span>
			<input type="text" name="telefono" class="form-control" value="{{$Cliente->telefono}}">
		</div>
    <br>
    <label>Correo</label>
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-tags"></i></span>
			<input type="text" name="correo" class="form-control" value="{{$Cliente->correo}}">
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
