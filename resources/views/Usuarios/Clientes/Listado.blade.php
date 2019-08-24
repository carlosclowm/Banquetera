@extends ('layouts.app')
@section ('contenido')
<div class="box">
  <div class="box-header">
		<h3 class="box-title">Listado Clientes</h3>
		<div class="pull-right box-tools">
      <a href="/Clientes/Nuevo" class="btn btn-success"><i class="fa fa-plus"></i></a>
    </div>
    <div class="box-body table-responsive">
  		<div class="dataTables_wrapper form-inline" role="grid">
        <table class="table table-bordered table-striped dataTable">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Domicilio</th>
              <th>Telefono</th>
              <th>Correo</th>
              <th width="100">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($Clientes as $cli)
            <tr>
              <td>{{$cli->nombre}}</td>
              <td>{{$cli->domicilio}}</td>
              <td>{{$cli->telefono}}</td>
              <td>{{$cli->correo}}</td>
              <td><a href="/Clientes/Editar/{{$cli->id_cliente}}" class="btn btn-info">Editar</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
	</div>
</div>
@endsection
