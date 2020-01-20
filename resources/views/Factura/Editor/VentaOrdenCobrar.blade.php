@extends ('layouts.app')
@section('contenido')
    <section class="content invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <img src="/logo.svg" width="200">
                                <small class="pull-right">Fecha: {{$Compra->fecha}}</small>
                                <a href="/Mover/PorCobrar/Venta/{{$Compra->id_ventas}}" class="btn btn-danger"> Mover a Venta</a>
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
                    <div id="Alertas">
                    	
                    </div>
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
                                <th width="100">Cantidad</th>
                                <th width="150">Precio</th>
                                <th>Total</th>
                                <th width="200">Opciones</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($Mobiliario as $car_m)
                              <tr>
                                <td>{{$car_m->tipo}}</td>
                                <td>{{$car_m->nombre}}</td>
                                <td><input type="number" name="cantidad" id="cantidad" value="{{$car_m->cantidad}}" class="form-control" onchange="NewPrice(this.name, this.value, 'Mobiliario')"></td>
                                <td><input type="number" name="precio" id="precio" class="form-control" value="{{$car_m->costo}}" onchange="NewPrice(this.name, this.value, 'Mobiliario')"></td>
                                <td id="TotalMob">${{$car_m->cantidad*$car_m->costo}}</td>
                                <td><a onclick="PutMobiliario('<?= $car_m->id_venta ?>', '<?= $Compra->id_ventas ?>')" class="btn btn-success"><i class="fa fa-pencil"></i></a> <a onclick="DelMobiliario('<?= $car_m->id_venta ?>', $(this), '<?= $Compra->id_ventas ?>')" class="btn btn-danger"><i class="fa fa-minus"></i></a></td>
                              </tr>
                              <script type="text/javascript">
			                	function NewPrice(name, val, cat){
			                		if(cat == 'Mobiliario'){
			                			if(name == 'cantidad'){
			                				var number = document.getElementById('precio').value*val;
			                				document.getElementById('TotalMob').innerText = "$"+number.toLocaleString('en-IN');
			                			}else{
			                				var number = document.getElementById('cantidad').value*val;
			                				document.getElementById('TotalMob').innerText = "$"+number.toLocaleString('en-IN');
			                			}
			                		}
			                	}
			                	function PutMobiliario($id, $Factura){
			                		$.ajax({
					                  headers: {
					                  'X-CSRF-Token': '<?= csrf_token()  ?>'
					                  },
					                  type: 'POST',
					                  url: '{{route("Factura.PutMobCobrar")}}',
					                  data: {id: $id, cantidad: document.getElementById('cantidad').value, costo: document.getElementById('precio').value, factura: $Factura},
					                  dataType: 'json',
					                  success:function(datos){ //success es una funcion que se utiliza si el servidor retorna informacion
					                   },
					                });
					                var midiv = document.createElement("div");
					                midiv.setAttribute("class","alert alert-success alert-dismissable");
									midiv.innerHTML =  '<i class="fa fa-check"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <b>Echo!</b> Venta editada.';
									document.getElementById("Alertas").appendChild(midiv);
									$.ajax({
					                    type: 'GET', //THIS NEEDS TO BE GET
					                    url: '/Orden/GetTotalVendidoCobrar/'+'<?= $Compra->id_ventas ?>',
					                    dataType: 'json',
					                    success: function (data) {
					                      document.getElementById('TotalFactura').innerText = '$'+data.toLocaleString('en-IN');

					                },error:function(){ 
					                     console.log(data);
					                }
					                  });
			                	}
			                	function DelMobiliario($id, div, $Factura){
			                		div.closest('tr').remove();
			                		$.ajax({
                            headers: {
                            'X-CSRF-Token': '<?= csrf_token()  ?>'
                            },
				                    type: 'POST', //THIS NEEDS TO BE GET
				                    url: '/Orden/PorCobrar/Eliminar/',
                            data: {id: $id, factura: $Factura},
				                    dataType: 'json',
				                    success: function () {},
				                error:function(){ 
				                }
				                  });
                          $.ajax({
                              type: 'GET', //THIS NEEDS TO BE GET
                              url: '/Orden/GetTotalVendidoCobrar/'+'<?= $Compra->id_ventas ?>',
                              dataType: 'json',
                              success: function (data) {
                                document.getElementById('TotalFactura').innerText = '$'+data.toLocaleString('en-IN');

                          },error:function(){ 
                               console.log(data);
                          }
                            });
			                	}
			                </script>
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
                  							<th width="100">Cantidad</th>
                  							<th width="100">Precio</th>
                                			<th width="100">Total</th>
                                			<th width="150">Opciones</th>
                  						</tr>
                  					</thead>
                  					<tbody>
                  						@foreach($Cocina as $car_c)
                  						<tr>
                  							<td>{{$car_c->tipo}}</td>
                  							<td>{{$car_c->nombre}}</td>
                  							<td><input type="number" name="cantidadCos" id="cantidadCos" class="form-control" value="{{$car_c->cantidad}}" onchange="NewPriceCos(this.name, this.value)"></td>
                  							<td><input type="number" name="precioCos" id="precioCos" class="form-control" value="{{$car_c->costo}}" onchange="NewPriceCos(this.name, this.value)"></td>
                                			<td id="TotalCos">${{$car_c->cantidad*$car_c->costo}}</td>
                                			<td><a onclick="PutCos('<?= $car_c->id_venta ?>', '<?= $Compra->id_ventas ?>')" class="btn btn-success"><i class="fa fa-pencil"></i></a> <a onclick="DelCos('<?= $car_c->id_venta ?>', $(this), '<?= $Compra->id_ventas ?>')" class="btn btn-danger"><i class="fa fa-minus"></i></a></td>
                  						</tr>
                  						<script type="text/javascript">
                  							function NewPriceCos(name, val){
                  								if(name == 'cantidadCos'){
					                				var number = document.getElementById('precioCos').value*val;
					                				document.getElementById('TotalCos').innerText = "$"+number.toLocaleString('en-IN');
					                			}else{
					                				var number = document.getElementById('cantidadCos').value*val;
					                				document.getElementById('TotalCos').innerText = "$"+number.toLocaleString('en-IN');
					                			}
                  							}

                                function PutCos($id, $Factura){
                                  $.ajax({
                                  headers: {
                                  'X-CSRF-Token': '<?= csrf_token()  ?>'
                                  },
                                  type: 'POST',
                                  url: '{{route("Factura.PutCosCobrar")}}',
                                  data: {id: $id, cantidad: document.getElementById('cantidadCos').value, costo: document.getElementById('precioCos').value, factura: $Factura},
                                  dataType: 'json',
                                  success:function(datos){ //success es una funcion que se utiliza si el servidor retorna informacion
                                   },
                                });
                                var midiv = document.createElement("div");
                                midiv.setAttribute("class","alert alert-success alert-dismissable");
                                midiv.innerHTML =  '<i class="fa fa-check"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <b>Echo!</b> Venta editada.';
                                document.getElementById("Alertas").appendChild(midiv);
                                $.ajax({
                                    type: 'GET', //THIS NEEDS TO BE GET
                                    url: '/Orden/GetTotalVendidoCobrar/'+'<?= $Compra->id_ventas ?>',
                                    dataType: 'json',
                                    success: function (data) {
                                      document.getElementById('TotalFactura').innerText = '$'+data.toLocaleString('en-IN');

                                },error:function(){ 
                                     console.log(data);
                                }
                                  });
                                }

                                function DelCos($id, div, $Factura){
                                  div.closest('tr').remove();
                                  $.ajax({
                                    headers: {
                                    'X-CSRF-Token': '<?= csrf_token()  ?>'
                                    },
                                    type: 'POST', //THIS NEEDS TO BE GET
                                    url: '/Orden/PorCobrar/EliminarCos/',
                                    data: {id: $id, factura: $Factura},
                                    dataType: 'json',
                                    success: function () {},
                                error:function(){ 
                                }
                                  });
                                  $.ajax({
                              type: 'GET', //THIS NEEDS TO BE GET
                              url: '/Orden/GetTotalVendidoCobrar/'+'<?= $Compra->id_ventas ?>',
                              dataType: 'json',
                              success: function (data) {
                                document.getElementById('TotalFactura').innerText = '$'+data.toLocaleString('en-IN');

                          },error:function(){ 
                               console.log(data);
                          }
                            });
                                }
                  						</script>
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
                  							<th width="100">Cantidad</th>
                  							<th width="100">Precio</th>
                                <th width="100">Total</th>
                                <th width="150">Opciones</th>
                  						</tr>
                  					</thead>
                  					<tbody>
                  						@foreach($Botella as $car_b)
                  						<tr>
                  							<td>{{$car_b->categoria}}</td>
                  							<td>{{$car_b->nombre}}</td>
                  							<td>{{$car_b->capacidad}}</td>
                  							<td><input type="number" name="cantidadBot" id="cantidadBot" class="form-control" value="{{$car_b->cantidad}}"  onchange="NewPriceBot(this.name, this.value)"></td>
                  							<td><input type="number" name="costoBot" id="costoBot" class="form-control" value="{{$car_b->costo}}"  onchange="NewPriceBot(this.name, this.value)"></td>
                                <td id="TotalBot">${{$car_b->cantidad*$car_b->costo}}</td>
                                <td><a onclick="PutBot('<?= $car_b->id_venta ?>', '<?= $Compra->id_ventas ?>')" class="btn btn-success"><i class="fa fa-pencil"></i></a> <a onclick="DelBot('<?= $car_b->id_venta ?>', $(this), '<?= $Compra->id_ventas ?>')" class="btn btn-danger"><i class="fa fa-minus"></i></a></td>
                  						</tr>
                              <script type="text/javascript">
                                function NewPriceBot(name, val){
                                  if(name == 'cantidadBot'){
                                    var number = document.getElementById('costoBot').value*val;
                                    document.getElementById('TotalBot').innerText = "$"+number.toLocaleString('en-IN');
                                  }else{
                                    var number = document.getElementById('cantidadBot').value*val;
                                    document.getElementById('TotalBot').innerText = "$"+number.toLocaleString('en-IN');
                                  }
                                }

                                function PutBot($id, $Factura){
                                  $.ajax({
                                  headers: {
                                  'X-CSRF-Token': '<?= csrf_token()  ?>'
                                  },
                                  type: 'POST',
                                  url: '{{route("Factura.PutBotCobrar")}}',
                                  data: {id: $id, cantidad: document.getElementById('cantidadBot').value, costo: document.getElementById('costoBot').value, factura: $Factura},
                                  dataType: 'json',
                                  success:function(datos){ //success es una funcion que se utiliza si el servidor retorna informacion
                                   },
                                });
                                var midiv = document.createElement("div");
                                midiv.setAttribute("class","alert alert-success alert-dismissable");
                                midiv.innerHTML =  '<i class="fa fa-check"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <b>Echo!</b> Venta editada.';
                                document.getElementById("Alertas").appendChild(midiv);
                                $.ajax({
                                    type: 'GET', //THIS NEEDS TO BE GET
                                    url: '/Orden/GetTotalVendidoCobrar/'+'<?= $Compra->id_ventas ?>',
                                    dataType: 'json',
                                    success: function (data) {
                                      document.getElementById('TotalFactura').innerText = '$'+data.toLocaleString('en-IN');

                                },error:function(){ 
                                     console.log(data);
                                }
                                  });
                                }

                                function DelBot($id, div, $Factura){
                                  div.closest('tr').remove();
                                  $.ajax({
                                    headers: {
                                    'X-CSRF-Token': '<?= csrf_token()  ?>'
                                    },
                                    type: 'POST', //THIS NEEDS TO BE GET
                                    url: '/Orden/PorCobrar/EliminarBot/',
                                    data: {id: $id, factura: $Factura},
                                    dataType: 'json',
                                    success: function () {},
                                error:function(){ 
                                }
                                  });
                                   $.ajax({
                              type: 'GET', //THIS NEEDS TO BE GET
                              url: '/Orden/GetTotalVendidoCobrar/'+'<?= $Compra->id_ventas ?>',
                              dataType: 'json',
                              success: function (data) {
                                document.getElementById('TotalFactura').innerText = '$'+data.toLocaleString('en-IN');

                          },error:function(){ 
                               console.log(data);
                          }
                            });
                                }
                              </script>
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
                            <p class="lead">Cuenta Por Cobrar</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th>Total:</th>
                                        <td id="TotalFactura">$<?= number_format($Compra->total) ?></td>
                                    </tr>
                                    <tr>
                                      <th>Abonado:</th>
                                      <td>$<?= number_format($Compra->abonado) ?></td>
                                    </tr>
                                    <tr>
                                      <th><h4> <strong>Debe:</strong> </h4><p>(Se Actualiza al Reiniciar)</p></th>
                                      <td><h4>$<?= number_format($Compra->total-$Compra->abonado) ?></h4></td>
                                    </tr>
                                </tbody></table>
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <a href="/Orden/PorCobrar/{{$Compra->id_ventas}}"><button class="btn btn-default"><i class="fa fa-times"></i> Salir</button></a>
                            <button class="btn btn-primary pull-right" style="margin-right: 5px;" onclick="window.print();"><i class="fa fa-download"></i> Generar PDF</button>
                            <a href="/Ventas/Vender" class="btn btn-success">Hacer Otra Venta</a>
                        </div>
                    </div>
                </section>

  </body>
@endsection
