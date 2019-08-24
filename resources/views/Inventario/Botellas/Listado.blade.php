@extends ('layouts.app')
@section ('contenido')
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Listado Vinos y Licores</h3>
		<div class="pull-right box-tools">
      <a href="/Inventario/Botellas/Nuevo" class="btn btn-success"><i class="fa fa-plus"></i></a>
    </div>
	</div>
	<div class="box-body table-responsive">
		<div class="dataTables_wrapper form-inline" role="grid">
			<table class="table table-bordered table-striped dataTable">
				<thead>
					<tr>
						<th>Categoria</th>
						<th>Nombre</th>
						<th>Capacidad</th>
						<th>Existencia</th>
						<th>Costo</th>
						<th width="100">Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach($Botellas as $bo)
					<tr>
						<td>{{$bo->categoria}}</td>
						<td>{{$bo->nombre}}</td>
						<td>{{$bo->capacidad}} ml</td>
						<td>{{$bo->existencia}}</td>
						<td>${{$bo->costo}}</td>
						<td><a href="/Inventario/Botellas/Editar/{{$bo->id_botella}}" class="btn btn-info">Editar</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{$Botellas->links()}}
		</div>
	</div>
</div>
@endsection
