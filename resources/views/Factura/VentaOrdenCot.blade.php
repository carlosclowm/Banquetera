@extends ('layouts.app')
@section('contenido')
    <section class="content invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                 <img src="/logo.svg" width="200">
                                <small class="pull-right">Fecha: {{$Compra->fecha}}</small>
                            </h2>
                        </div><!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            De
                            <address>
                                <strong>Toriba</strong><br>
                                Calzada de los Paraísos #170 <br>
                                Col. Ciudad Granja <br>
                                C.P. 45010, Zapopan, Jalisco.<br>
                                Telefono: +52 (01) (33) 3070 1792 / 3070 3152 / 53<br>
                                (044) 3313 35 43 98 <br>
                                Correo: contacto@toriba.com.mx
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            Para
                            <address>
                                <strong>{{$Cliente->nombre}}</strong><br>
                                {{$Cliente->domicilio}} <br>
                                Telefono: {{$Cliente->telefono}}<br>
                                Correo: {{$Cliente->correo}}
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <b>Orden #{{$Compra->id_ventas}}</b><br>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                          @if($Mobiliario->count() > 0)
                          <label for="">Mobiliario</label>
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Tipo</th>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Total</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($Mobiliario as $car_m)
                              <tr>
                                <td>{{$car_m->tipo}}</td>
                                <td>{{$car_m->nombre}}</td>
                                <td>{{$car_m->cantidad}}</td>
                                <td>$<?= number_format($car_m->costo) ?></td>
                                <td>$<?= number_format($car_m->costo*$car_m->cantidad) ?></td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                          <hr>
                          @endif
                          @if($Cocina->count() > 0)
                          <label for="">Cocina</label>
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Tipo</th>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Total</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($Cocina as $car_c)
                              <tr>
                                <td>{{$car_c->tipo}}</td>
                                <td>{{$car_c->nombre}}</td>
                                <td>{{$car_c->cantidad}}</td>
                                <td>$<?= number_format($car_c->costo) ?></td>
                                <td>$<?= number_format($car_c->costo*$car_c->cantidad) ?></td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                          <hr>
                          @endif
                          @if($Botella->count() > 0)
                          <label for="">Vinos y Licores</label>
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Categoria</th>
                                <th>Nombre</th>
                                <th>Capacidad</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Total</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($Botella as $car_b)
                              <tr>
                                <td>{{$car_b->categoria}}</td>
                                <td>{{$car_b->nombre}}</td>
                                <td>{{$car_b->capacidad}}</td>
                                <td>{{$car_b->cantidad}}</td>
                                <td>$<?= number_format($car_b->costo) ?></td>
                                <td>$<?= number_format($car_b->cantidad*$car_b->costo) ?></td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                          @endif
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">

                        </div><!-- /.col -->
                        <div class="col-xs-6">
                            <p class="lead">Cuenta Cotizada</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th>Total:</th>
                                        <td>$<?= number_format($Compra->total) ?></td>
                                    </tr>
                                </tbody></table>
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <button class="btn btn-default"><i class="fa fa-print"></i> Imprimir</button>
                            <button class="btn btn-primary pull-right" style="margin-right: 5px;" onclick="window.print();"><i class="fa fa-download"></i> Generar PDF</button>
                            <a href="/Ventas/Cotizar" class="btn btn-success">Hacer Otra Cotizacion</a>
                        </div>
                    </div>
                </section>
  </body>
@endsection
