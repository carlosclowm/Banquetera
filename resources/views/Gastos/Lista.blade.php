@extends ('layouts.app')
@section ('contenido')
<div class="nav-tabs-custom">
    <div class="nav nav-tabs pull-right">
  		<li class="pull-left header">Listado de Gastos</li>
        <li class="pull-left header"><a href="#" style="color: green;" data-target="#dialogo-agregar-gasto" data-toggle="modal"><i class="fa fa-plus"></i></a></li>
  		<li class="active"><a href="/Gastos">Gastos</a></li>
  		<li><a href="/Gastos/Motivo">Agregar Motivo</a></li>
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
                <th>Motivo</th>
                <th>Monto</th>
                <th>Fecha</th>
              </tr>
              <tbody>
                @foreach($Gastos as $gas)
                <tr>
                  <td>{{$gas->motivo}}</td>
                  <td>{{$gas->motivo_nombre}}</td>
                  <td>${{$gas->monto}}</td>
                  <td>{{$gas->fecha}}</td>
                </tr>
                @endforeach
              </tbody>
            </thead>
          </table>
          {{$Gastos->links()}}
        </div>
      </div>
    </div>
</div>
@include ('Gastos.DialogoAgregarGasto')
@endsection
