@extends('layouts.app')
@section ('contenido')
<div class="box">
  <div class="box-header">
		<h3 class="box-title">Listado Proveedores</h3>
		<div class="pull-right box-tools">
      <a href="/Proveedores/Nuevo" class="btn btn-success"><i class="fa fa-plus"></i></a>
    </div>
    <div class="box-body table-responsive">
  		<div class="dataTables_wrapper form-inline" role="grid">
        <table class="table table-bordered table-striped dataTable">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Empresa</th>
              <th>RFC</th>
              <th>Telefono</th>
              <th width="100">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($Proveedores as $prov)
            <tr>
              <td>{{$prov->nombre}}</td>
              <td>{{$prov->empresa}}</td>
              <td>{{$prov->rfc}}</td>
              <td>{{$prov->telefono}}</td>
              <td><a href="/Proveedores/Editar/{{$prov->id_proveedor}}" class="btn btn-info">Editar</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
	</div>
</div>
@endsection
