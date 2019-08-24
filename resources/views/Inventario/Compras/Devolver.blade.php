@extends ('layouts.app')
@section ('contenido')
<script src="http://code.jquery.com/jquery-2.1.4.min.js" type="text/javascript"></script>
<div class="nav-tabs-custom">
	<div class="nav nav-tabs pull-right">
		<li class="pull-left header">Devolver Compra</li>
		<li class="active"><a href="/Compras/Devolver" data-toggle="tab">Devolver</a></li>
		<li><a href="/Compras/Comprar">Comprar</a></li>
	</div>
	<div class="tab-content">
		@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
		<div class="tab-pane active">
			<label>Agregar: </label>
		<a href="" data-target="#dialogo-agregar-mobiliario" data-toggle="modal"><button class="btn btn-primary">Mobiliario</button></a>

		<a href="" data-target="#dialogo-agregar-cocina" data-toggle="modal"><button class="btn btn-primary">Cocina</button></a>

		<a href="" data-target="#dialogo-agregar-botella" data-toggle="modal"><button class="btn btn-primary">Vinos y Licores</button></a>

		<hr>
		<label>Mobiliario: {{$Carrito_Mob->count()}} Agregados</label>
		@if($Carrito_Mob->count() > 0)
		<div class="box-body table-responsive">
			<div class="dataTables_wrapper form-inline" role="grid">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Tipo</th>
							<th>Nombre</th>
							<th>Cantidad</th>
							<th>Costo Total</th>
							<th width="200">Opciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach($Carrito_Mob as $car_m)
						<tr>
							<td>{{$car_m->tipo}}</td>
							<td>{{$car_m->nombre}}</td>
							<td>{{$car_m->cantidad}}</td>
							<td>${{$car_m->costo}}</td>
							{{Form::Open(array('action'=>array('ComprasController@EliminarMob',$car_m->id_carrito),'method'=>'delete'))}}
							<td>

								<button type="submit" class="btn btn-danger">Eliminar</button>  </td>
							{{Form::Close()}}
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		@endif
		<hr>
		<label>Cocina: {{$Carrito_Cos->count()}} Agregados</label>
		@if($Carrito_Cos->count() > 0)
		<div class="box-body table-responsive">
			<div class="dataTables_wrapper form-inline" role="grid">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Tipo</th>
							<th>Nombre</th>
							<th>Cantidad</th>
							<th>Costo Total</th>
							<th width="200">Opciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach($Carrito_Cos as $car_c)
						<tr>
							<td>{{$car_c->tipo}}</td>
							<td>{{$car_c->nombre}}</td>
							<td>{{$car_c->cantidad}}</td>
							<td>${{$car_c->costo}}</td>
							{{Form::Open(array('action'=>array('ComprasController@EliminarCos',$car_c->id_carrito),'method'=>'delete'))}}
							<td>

								<button type="submit" class="btn btn-danger">Eliminar</button></td>
							{{Form::Close()}}
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		@endif

		<hr>
		<label>Vinos y Licores: {{$Carrito_Bot->count()}} Agregados</label>
		@if($Carrito_Bot->count() > 0)
		<div class="box-body table-responsive">
			<div class="dataTables_wrapper form-inline" role="grid">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Categoria</th>
							<th>Nombre</th>
							<th>Capacidad</th>
							<th>Cantidad</th>
							<th>Costo Total</th>
							<th width="200">Opciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach($Carrito_Bot as $car_b)
						<tr>
							<td>{{$car_b->categoria}}</td>
							<td>{{$car_b->nombre}}</td>
							<td>{{$car_b->capacidad}}</td>
							<td>{{$car_b->cantidad}}</td>
							<td>${{$car_b->costo}}</td>
							{{Form::Open(array('action'=>array('ComprasController@EliminarBot',$car_b->id_carrito),'method'=>'delete'))}}
							<td>

								<button type="submit" class="btn btn-danger">Eliminar</button></td>
							{{Form::Close()}}
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		@endif
		</div>
		<hr>

		<a href="#" data-target="#dialogo-agregar-proveedor" data-toggle="modal" class="btn btn-success">Devolver: ${{$Total}}</a>
	</div>
	@include('Inventario.Compras.AgregarMobiliario')
	@include('Inventario.Compras.AgregarCocina')
	@include('Inventario.Compras.AgregarBotella')
	@include('Inventario.Compras.AgregarProveedorDev')


</div>
@endsection
