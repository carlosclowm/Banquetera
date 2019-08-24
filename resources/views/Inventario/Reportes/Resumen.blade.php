@extends ('layouts.app')
@section ('contenido')
<script src="http://code.jquery.com/jquery-2.1.4.min.js" type="text/javascript"></script>
<div class="nav-tabs-custom">
    <div class="nav nav-tabs pull-right">
  		<li class="pull-left header">Resumen Reportes</li>
      	<li class="active"><a href="/Resumen">Resumen</a></li>
  		<li><a href="/Reportes/Ventas">Ventas</a></li>
  		<li><a href="/Reportes" data-toggle="tab">Compras</a></li>
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
    @if(isset($Clientes))
    <div class="tab-pane active">
			<label>Resumen por: </label>
		<a href="" data-target="#dialogo-fechas" data-toggle="modal"><button class="btn btn-primary">Fechas</button></a>

		<a href="" data-target="#dialogo-cliente" data-toggle="modal"><button class="btn btn-primary">Cliente</button></a>

		<a href="" data-target="#dialogo-proveedor" data-toggle="modal"><button class="btn btn-primary">Proveedor</button></a>

		<a href="" data-target="#dialogo-producto" data-toggle="modal"><button class="btn btn-primary">Producto</button></a>
	</div>
	<hr>
	@include('Inventario.Reportes.DialogoFechas')
	@include('Inventario.Reportes.DialogoCliente')
	@include('Inventario.Reportes.DialogoProveedor')
	@include('Inventario.Reportes.DialogoProducto')
	@endif
	@if(isset($Ventas))
	<div class="col-md-4">
	</div>
	<div class="col-md-4">
        <div class="small-box bg-blue">
            <div class="inner">
                <h3>
                    $<?= number_format($Resumen) ?>
                </h3>
                <p>
                    Ventas
                </p>
            </div>
            <div class="icon">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <a href="#" class="small-box-footer">
                 <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <table class="table table-bordered">
            <thead>
              <tr>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Total</th>
                <th width="180">Opciones</th>
              </tr>
              <tbody class="botbus">
                @foreach($Ventas as $vn)
                <tr>
                  <td>{{$vn->nombre_cliente}}</td>
                  <td>{{$vn->fecha}}</td>
                  <td>${{$vn->total}}</td>
                  <td> <a href="/Orden/{{$vn->id_ventas}}" class="btn btn-info">Nota</a> </td>
                </tr>
                @endforeach
              </tbody>
            </thead>
          </table>
	@endif

	@if(isset($Clientes_Resumen))
	<div class="col-md-4">
	</div>
	<div class="col-md-4">
        <div class="small-box bg-blue">
            <div class="inner">
                <h3>
                    $<?= number_format($Ventas_Clientes) ?>
                </h3>
                <p>
                    Ventas
                </p>
            </div>
            <div class="icon">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <a href="#" class="small-box-footer">
                 <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <table class="table table-bordered">
            <thead>
              <tr>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Total</th>
                <th width="180">Opciones</th>
              </tr>
              <tbody class="botbus">
                @foreach($Clientes_Resumen as $vn)
                <tr>
                  <td>{{$vn->nombre_cliente}}</td>
                  <td>{{$vn->fecha}}</td>
                  <td>${{$vn->total}}</td>
                  <td> <a href="/Orden/{{$vn->id_ventas}}" class="btn btn-info">Nota</a> </td>
                </tr>
                @endforeach
              </tbody>
            </thead>
          </table>
	@endif
	@if(isset($Resumen_Proveedor))
	<div class="col-md-4">
	</div>
	<div class="col-md-4">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>
                    $<?= number_format($Resumen_Proveedor) ?>
                </h3>
                <p>
                    Compras
                </p>
            </div>
            <div class="icon">
                <i class="fa fa-truck"></i>
            </div>
            <a href="#" class="small-box-footer">
                 <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <table class="table table-bordered">
            <thead>
              <tr>
                <th>Fecha</th>
                <th>Total</th>
                <th>Proveedor</th>
                <th width="100">Opciones</th>
              </tr>
              <tbody class="botbus">
                @foreach($Compras_Prov as $cp)
                <tr>
                  <td>{{$cp->fecha}}</td>
                  <td>${{$cp->total}}</td>
                  <td>{{$cp->nombre_proveedor}}</td>
                  <td> <a href="/Nota/{{$cp->id_compras}}" class="btn btn-info">Nota</a> </td>
                </tr>
                @endforeach
              </tbody>
            </thead>
          </table>
	@endif
	@if(isset($Producto_Mobiliario))
	<div class="col-lg-3 col-xs-6">
	</div>
	<div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>
                    $<?= number_format($Total_Compras) ?>
                </h3>
                <p>
                    Compras
                </p>
            </div>
            <div class="icon">
                <i class="fa fa-truck"></i>
            </div>
            <a href="#" class="small-box-footer">
                 <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-blue">
            <div class="inner">
                <h3>
                    $<?= number_format($Total_Ventas) ?>
                </h3>
                <p>
                    Ventas
                </p>
            </div>
            <div class="icon">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <a href="#" class="small-box-footer">
                 <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
	@endif
	@if(isset($Producto_Cocina))
	<div class="col-lg-3 col-xs-6">
	</div>
	<div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>
                    $<?= number_format($Total_Compras) ?>
                </h3>
                <p>
                    Compras
                </p>
            </div>
            <div class="icon">
                <i class="fa fa-truck"></i>
            </div>
            <a href="#" class="small-box-footer">
                 <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-blue">
            <div class="inner">
                <h3>
                    $<?= number_format($Total_Ventas) ?>
                </h3>
                <p>
                    Ventas
                </p>
            </div>
            <div class="icon">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <a href="#" class="small-box-footer">
                 <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
	@endif
	@if(isset($Producto_Botella))
	<div class="col-lg-3 col-xs-6">
	</div>
	<div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>
                    $<?= number_format($Total_Compras) ?>
                </h3>
                <p>
                    Compras
                </p>
            </div>
            <div class="icon">
                <i class="fa fa-truck"></i>
            </div>
            <a href="#" class="small-box-footer">
                 <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-blue">
            <div class="inner">
                <h3>
                    $<?= number_format($Total_Ventas) ?>
                </h3>
                <p>
                    Ventas
                </p>
            </div>
            <div class="icon">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <a href="#" class="small-box-footer">
                 <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
	@endif
    
</div>


@endsection