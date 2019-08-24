@extends ('layouts.app')
@section ('contenido')
<div class="nav-tabs-custom">
    <div class="nav nav-tabs pull-right">
  		<li class="pull-left header">Cuentas Por Pagar</li>
  		<li class="active"><a href="/Cuentas/PorPagar">Por Pagar</a></li>
  		<li><a href="/Cuentas">Por Cobrar</a></li>
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
                <th>Proveedor</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Abonado</th>
                <th>A Liquidar</th>
                <th width="180">Opciones</th>
              </tr>
              <tbody>
                @foreach($PorPagar as $pp)
                <tr>
                  <td>{{$pp->nombre_proveedor}}</td>
                  <td>{{$pp->fecha}}</td>
                  <td>${{$pp->total}}</td>
                  <td>${{$pp->abonado}}</td>
                  <td>${{$pp->total - $pp->abonado}}</td>
                    <td><a href="/Cuentas/PorPagar/Liquidar/{{$pp->id_compras}}"><button class="btn btn-success">Liquidar</button></a>
                      <a href="" data-target="#dialogo-abonar{{$pp->id_compras}}" data-toggle="modal"><button class="btn btn-primary">Abonar</button></a>
                    </td>
                </tr>
                @include('Inventario.PorPagar.Abonar')
                @endforeach
              </tbody>
            </thead>
          </table>
          {{$PorPagar->links()}}
        </div>
      </div>
    </div>
</div>
@endsection
