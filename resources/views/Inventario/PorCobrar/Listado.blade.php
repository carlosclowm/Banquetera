@extends ('layouts.app')
@section ('contenido')
<div class="nav-tabs-custom">
    <div class="nav nav-tabs pull-right">
  		<li class="pull-left header">Cuentas Por Cobrar</li>
  		<li><a href="/Cuentas/PorPagar">Por Pagar</a></li>
  		<li class="active"><a href="/Cuentas/PorCobrar" data-toggle="tab">Por Cobrar</a></li>
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
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Abonado</th>
                <th>A Liquidar</th>
                <th width="180">Opciones</th>
              </tr>
              <tbody>
                @foreach($PorCobrar as $pc)
                <tr>
                  <td>{{$pc->nombre_cliente}}</td>
                  <td>{{$pc->fecha}}</td>
                  <td>${{$pc->total}}</td>
                  <td>${{$pc->abonado}}</td>
                  <td>${{$pc->total-$pc->abonado}}</td>
                  <td><a href="/Cuentas/PorCobrar/Liquidar/{{$pc->id_ventas}}"><button class="btn btn-success">Liquidar</button></a>
                    <a href="" data-target="#dialogo-abonar{{$pc->id_ventas}}" data-toggle="modal"><button class="btn btn-primary">Abonar</button></a>
                  </td>
                </tr>
                @include('Inventario.PorCobrar.Abonar')
                @endforeach
              </tbody>
            </thead>
          </table>
          {{$PorCobrar->links()}}
        </div>
      </div>
    </div>
</div>
@endsection
