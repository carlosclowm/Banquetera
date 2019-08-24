@extends ('layouts.app')
@section ('contenido')
<div class="nav-tabs-custom">
    <div class="nav nav-tabs pull-right">
  		<li class="pull-left header">Tipo de Gastos </li>
      <li class="pull-left header"><a href="#" style="color: green;" data-target="#dialogo-agregar-motivo" data-toggle="modal"><i class="fa fa-plus"></i></a></li>
  		<li><a href="/Gastos">Gastos</a></li>
  		<li class="active"><a href="/Gastos/Motivo">Agregar Motivo</a></li>
  	</div>
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
      <div class="box-body table-responsive">
  			<div class="dataTables_wrapper form-inline" role="grid">
  				<table class="table table-bordered">
            <thead>
              <tr>
                <th>Clave</th>
                <th>Nombre</th>
                <th>Descripcion</th>
              </tr>
              <tbody>
                @foreach($Motivo as $mt)
                <tr>
                  <td>{{$mt->id_gasto}}</td>
                  <td>{{$mt->nombre}}</td>
                  <td>{{$mt->descripcion}}</td>
                </tr>
                @endforeach
              </tbody>
            </thead>
          </table>
        </div>
      </div>
    </div>
</div>
@include ('Gastos.DialogoAgregarMotivo')
@endsection
