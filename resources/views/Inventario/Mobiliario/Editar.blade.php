@extends ('layouts.app')
@section ('contenido')
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Editar</h3>
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
		{!!Form::open(array('url'=>'Inventario/Mobiliario/Edit','method'=>'POST','autocomplete'=>'off',))!!}
		{{Form::token()}}
		<input type="text" name="id" value="{{$Mobiliario->id_mob}}" hidden="">
		<label>Tipo</label>
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-bars"></i></span>
			<input type="text" name="tipo" class="form-control" value="{{$Mobiliario->tipo}}">
		</div>
		<br>
		<label>Nombre</label>
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-tags"></i></span>
			<input type="text" name="nombre" class="form-control" value="{{$Mobiliario->nombre}}">
		</div>
		<div>
			<br>
			<button class="btn btn-primary" type="submit">Editar</button>
			<a href="/Inventario/Mobiliario" class="btn btn-danger">Cancelar</a>
		</div>
		{!!Form::close()!!}
	</div>
</div>
@endsection