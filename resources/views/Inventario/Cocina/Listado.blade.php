@extends ('layouts.app')
@section ('contenido')
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Listado Cocina</h3>
		<div class="pull-right box-tools">
      <a href="/Inventario/Cocina/Nuevo" class="btn btn-success"><i class="fa fa-plus"></i></a>
    </div>
	</div>
	<div class="box-body table-responsive">
		<div class="dataTables_wrapper form-inline" role="grid">
			<table class="table table-bordered table-striped dataTable">
				<thead>
					<tr>
						<th>Tipo</th>
						<th>Nombre</th>
						<th>Existencia</th>
						<th>Costo</th>
						<th width="100">Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach($Cocina as $cn)
					<tr>
						<td>{{$cn->tipo}}</td>
						<td>{{$cn->nombre}}</td>
						<td>{{$cn->existencia}}</td>
						<td>${{$cn->costo}}</td>
						<td><a href="/Inventario/Cocina/Editar/{{$cn->id_cocina}}" class="btn btn-info">Editar</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{$Cocina->links()}}
		</div>
	</div>
</div>
@endsection
