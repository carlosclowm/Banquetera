@extends ('layouts.app')
@section ('contenido')
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Listado Mobiliario</h3>
		<div class="pull-right box-tools">
      <a href="/Inventario/Mobiliario/Nuevo" class="btn btn-success"><i class="fa fa-plus"></i></a>
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
					@foreach($Mobiliario as $mb)
					<tr>
						<td>{{$mb->tipo}}</td>
						<td>{{$mb->nombre}}</td>
						<td>{{$mb->existencia}}</td>
						<th>${{$mb->costo}}</th>
						<th><a href="/Inventario/Mobiliario/Editar/{{$mb->id_mob}}" class="btn btn-info">Editar</a></th>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{$Mobiliario->links()}}
		</div>
	</div>
</div>
@endsection
