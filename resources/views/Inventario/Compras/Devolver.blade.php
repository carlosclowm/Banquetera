@extends ('layouts.app')
@section ('contenido')
<script src="http://code.jquery.com/jquery-2.1.4.min.js" type="text/javascript"></script>
<div class="nav-tabs-custom">
	<div class="nav nav-tabs pull-right">
		<li class="pull-left header">Devolver</li>
		<li class="active"><a href="/Compras/Devolver">Devolver</a></li>
		<li><a href="/Compras/Comprar">Comprar</a></li>
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
                <th width="100">Categoria</th>
                <th width="200">Nombre</th>
                <th width="100">Cantidad</th>
                <th width="150">Precio(Por Botella)</th>
                <th width="200">Total</th>
                <th width="200">Opciones</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <select class="form-control" onchange="LoadCat(this.value)">
                    <option>Categorias</option>
                    <option value="botellas">Vinos y Licores</option>
                    <option value="cocina">Cocina</option>
                    <option value="mobiliario">Mobiliario</option>
                  </select>
                </td>
                <td>
                  <input list="nombres" name="nombres" class="form-control" onchange="CargarTotal(this.value)">
                  <datalist id="nombres">
                    
                  </datalist>
                </td>
                <td>
                  <input type="number" name="cantidad" class="form-control" value="1" id="cantidad" onchange="NewTotal(this.name, this.value)" >
                </td>
                <td><input type="number" name="totalXbot" class="form-control" id="total" onchange="NewTotal(this.name, this.value)"></td>
                <td>
                <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        <input type="number" name="total" id="Ntotal" class="form-control" disabled>
                                        <span class="input-group-addon">.00</span>
                                    </div>
                </td>
                <td><button onclick="PostProducto()" class="btn btn-success">Agregar</button> <button data-target="#dialogo-nuevo-producto" data-toggle="modal" class="btn btn-info">Nuevo Producto</button></td>
              </tr>
              <tbody id="InvCarMob">
                @foreach($Carrito_Mob as $car_m)
              <tr>
                <td>Mobiliario</td>
                <td>{{$car_m->tipo}} {{$car_m->nombre}}</td>
                <td>{{$car_m->cantidad}}</td>
                <td>$<?= number_format($car_m->costo) ?></td>
                <td>$<?= number_format($car_m->costo*$car_m->cantidad) ?></td>
                <td><a onclick="EliminarMob('{{$car_m->id_carrito}}',$(this));RestaTotal('{{$car_m->costo}}')" class="btn btn-danger"><i class="fa fa-minus"></i></a></td>
              </tr>
              @endforeach
              </tbody>
              <tbody id="InvCarCos">
                @foreach($Carrito_Cos as $car_c)
              <tr>
                <td>Cocina</td>
                <td>{{$car_c->tipo}} {{$car_c->nombre}}</td>
                <td>{{$car_c->cantidad}}</td>
                <td>$<?= number_format($car_c->costo) ?></td>
                <td>$<?= number_format($car_c->costo*$car_c->cantidad) ?></td>
                <td><a onclick="EliminarCos('{{$car_c->id_carrito}}', $(this));RestaTotal('{{$car_c->costo}}')" class="btn btn-danger"><i class="fa fa-minus"></i></a></td>
              </tr>
              @endforeach
              </tbody>
              <tbody id="InvCarBot">
                @foreach($Carrito_Bot as $car_b)
              <tr>
                <td>Vinos y Licores</td>
                <td>{{$car_b->categoria}} {{$car_b->nombre}} {{$car_b->capacidad}}</td>
                <td>{{$car_b->cantidad}}</td>
                <td>$<?= number_format($car_b->costo) ?></td>
                <td>$<?= number_format($car_b->costo*$car_b->cantidad) ?></td>
                <td><a class="btn btn-danger" onclick="EliminarBot('{{$car_b->id_carrito}}', $(this));RestaTotal('{{$car_b->costo}}')"><i class="fa fa-minus"></i></a></td>
              </tr>
              @endforeach
              </tbody>
              
             
            </tbody>
          </table>
        </div>
      </div>
      

  		
      </div>
			<hr>
			<a href="#" data-target="#dialogo-agregar-proveedor" data-toggle="modal" class="btn btn-success" id="btnDevolver">Devolver: ${{$Total}}</a>
    </div>
		@include('Inventario.Compras.AgregarProveedorDev')
    @include('Inventario.Ventas.Producto')
</div>
<script type="text/javascript">
  $(document).ready(function () {

            (function ($) {

                $('#botella').keyup(function () {

                    var rex = new RegExp($(this).val(), 'i');
                    $('.botbus option').hide();
                    $('.botbus option').filter(function () {
                        return rex.test($(this).text());
                    }).show();

                })

            }(jQuery));

        });
  function Calcular(input, valor, costo){
    var inputNombre = document.getElementById(input);
      inputNombre.value = (costo*valor);
  }
</script>
<script type="text/javascript">
            function NewTotal(name, value){
              if(name == 'cantidad'){
                var T = value*document.getElementById('total').value;
                document.getElementById('Ntotal').value = T.toLocaleString('de-DE');
              }if(name == 'totalXbot'){
                var T = value*document.getElementById('cantidad').value;
                document.getElementById('Ntotal').value = T.toLocaleString('de-DE');
              }
            }
            var Producto;
            var CatProd;
            var IdProd;
            var TotalUnit;
            var AllTota = '<?= $Total ?>';
            AllTota = parseFloat(AllTota);

            function SumaTotal(costo, cantidad){
              AllTota += parseFloat(costo)*cantidad;
              document.getElementById('btnDevolver').innerText = "Devolver: $"+AllTota.toLocaleString('de-DE');
            }
            function RestaTotal(costo, cantidad){
              AllTota -= parseFloat(costo) * cantidad;
              document.getElementById('btnDevolver').innerText = "Devolver: $"+AllTota.toLocaleString('de-DE');
            }

            function NuevoTotal(cantidad){
              document.getElementById('total').value = TotalUnit * cantidad;
            }
            function CargarTotal(id){
              IdProd = id;
              Producto.forEach(function(row){
                if(row['id_botella'] == id || row['id_cocina'] == id || row['id_mob'] == id){
                  document.getElementById('total').value = row['costo'] * document.getElementById('cantidad').value;
                  document.getElementById('Ntotal').value = row['costo'] * document.getElementById('cantidad').value;
                  TotalUnit = row['costo'];
                  
                }
              });
            }

            function EliminarBot(id, ts){
              ts.closest('tr').remove();
              $.ajax({
                    type: 'GET', //THIS NEEDS TO BE GET
                    url: '/Ventas/Vender/EliminarBot/'+id,
                    dataType: 'json',
                    success: function () {},
                error:function(){ 
                }
                  });
            }
            function EliminarCos(id, ts){
              ts.closest('tr').remove();
              $.ajax({
                    type: 'GET', //THIS NEEDS TO BE GET
                    url: '/Ventas/Vender/EliminarCos/'+id,
                    dataType: 'json',
                    success: function () {},
                    error:function(){ 
                }
                  });
            }
            function EliminarMob(id, ts){
              ts.closest('tr').remove();
              $.ajax({
                    type: 'GET', //THIS NEEDS TO BE GET
                    url: '/Ventas/Vender/EliminarMob/'+id,
                    dataType: 'json',
                    success: function () {},
                error:function(){ 
                }
                  });
            }
            function LoadCat(name){
              if(name == 'botellas'){
                $Tipo = document.getElementById('nombres');
                $Tipo.innerHTML = '';

              $Tipo.disabled = false;
              var Botella = '<?= $Botella ?>';
              Botella =JSON.parse(Botella);
              Producto = Botella;
              CatProd = "Botella";
              var opt = document.createElement('option');
              opt.appendChild( document.createTextNode("Opcion...") );
                $Tipo.appendChild(opt);
              Botella.forEach(function(data){
                var opt = document.createElement('option');
                opt.appendChild( document.createTextNode(data['categoria']+" "+data['nombre']+" "+data['capacidad']) );
                opt.value = data['id_botella'];
                $Tipo.appendChild(opt); 
              });
              }
              if(name == 'cocina'){
                $Tipo = document.getElementById('nombres');
              $Tipo.innerHTML = '';
              
              $Tipo.disabled = false;
              var Cocina = '<?= $Cocina ?>';
              Cocina = JSON.parse(Cocina);
              Producto = Cocina;
              CatProd = "Cocina";
              var opt = document.createElement('option');
              opt.appendChild( document.createTextNode("Opcion...") );
                $Tipo.appendChild(opt);
              Cocina.forEach(function(data){
                var opt = document.createElement('option');
                opt.appendChild( document.createTextNode(data['tipo']+" "+data['nombre']) );
                opt.value = data['id_cocina'];
                $Tipo.appendChild(opt);
              });
              }
              if(name == 'mobiliario'){
                $Tipo = document.getElementById('nombres');
              $Tipo.innerHTML = '';
              $Tipo.disabled = false;
              var Mob = '<?= $Mobiliario ?>';
              Mob = JSON.parse(Mob);
              Producto = Mob;
              CatProd = "Mobiliario";
              var opt = document.createElement('option');
              opt.appendChild( document.createTextNode("Opcion...") );
                $Tipo.appendChild(opt);
              Mob.forEach(function(data){
                var opt = document.createElement('option');
                opt.appendChild( document.createTextNode(data['tipo']+" "+data['nombre']) );
                opt.value = data['id_mob'];
                $Tipo.appendChild(opt);
              });
              }
            }
            


              function PostProducto(){
                SumaTotal(document.getElementById('total').value, document.getElementById('cantidad').value);
                if(CatProd == "Mobiliario"){
                  $.ajax({
                  headers: {
                  'X-CSRF-Token': '<?= csrf_token()  ?>'
                  },
                  type: 'POST',
                  url: '{{route("car.PostMobC")}}',
                  data: {id: IdProd, cantidad: document.getElementById('cantidad').value, costo: document.getElementById('total').value},
                  success:function(datos){ //success es una funcion que se utiliza si el servidor retorna informacion
                      SumaTotal(document.getElementById('total').value, document.getElementById('cantidad').value);
                   },
                  dataType: 'json'
                });
                  $.ajax({
                    type: 'GET', //THIS NEEDS TO BE GET
                    url: '{{route("car.GetMobC")}}',
                    dataType: 'json',
                    success: function (data) {
                      document.getElementById("InvCarMobC").innerHTML = "";
                  data.forEach(function(elemento){
                     document.getElementById("InvCarMob").insertRow(-1).innerHTML = '<td>Mobiliario</td><td>'+elemento['tipo']+' '+elemento['nombre']+'</td><td>'+elemento['cantidad']+'</td><td>$'+elemento['costo']+'</td><td>$'+elemento['cantidad']*elemento['costo']+'</td><td><a class="btn btn-danger" onclick="EliminarMob('+elemento['id_carrito']+', $(this));RestaTotal('+elemento['costo']+', '+elemento['cantidad']+')"><i class="fa fa-minus"></i></a></td>';
                  });
                    


                },error:function(){ 
                     console.log(data);
                }
                  });
                 
                }
                if(CatProd == "Cocina"){
                  $.ajax({
                  headers: {
                  'X-CSRF-Token': '<?= csrf_token()  ?>'
                  },
                  type: 'POST',
                  url: '{{route("car.PostCos")}}',
                  data: {id: IdProd, cantidad: document.getElementById('cantidad').value, costo: document.getElementById('total').value},
                  success:function(datos){ //success es una funcion que se utiliza si el servidor retorna informacion
                      SumaTotal(document.getElementById('total').value, document.getElementById('cantidad').value);
                   },
                  dataType: 'json'
                });
                  $.ajax({
                    type: 'GET', //THIS NEEDS TO BE GET
                    url: '{{route("car.GetCosC")}}',
                    dataType: 'json',
                    success: function (data) {
                      document.getElementById("InvCarCos").innerHTML = "";
                  data.forEach(function(elemento){
                     document.getElementById("InvCarCos").insertRow(-1).innerHTML = '<td>Cocina</td><td>'+elemento['tipo']+' '+elemento['nombre']+'</td><td>'+elemento['cantidad']+'</td><td>$'+elemento['costo']+'</td><td>$'+elemento['cantidad']*elemento['costo']+'</td><td><a class="btn btn-danger" onclick="EliminarCos('+elemento['id_carrito']+', $(this));RestaTotal('+elemento['costo']+', '+elemento['cantidad']+')"><i class="fa fa-minus"></i></a></td>';
                  });
                    


                },error:function(){ 
                     console.log(data);
                }
                  });
                }
                if(CatProd == "Botella"){
                  $.ajax({
                  headers: {
                  'X-CSRF-Token': '<?= csrf_token()  ?>'
                  },
                  type: 'POST',
                  url: '{{route("car.PostBotC")}}',
                  data: {id: IdProd, cantidad: document.getElementById('cantidad').value, costo: document.getElementById('total').value},
                  success:function(datos){ //success es una funcion que se utiliza si el servidor retorna informacion
                      SumaTotal(document.getElementById('total').value, document.getElementById('cantidad').value);
                   },
                  dataType: 'json'
                });
                  $.ajax({
                    type: 'GET', //THIS NEEDS TO BE GET
                    url: '{{route("car.GetBotC")}}',
                    dataType: 'json',
                    success: function (data) {
                      document.getElementById("InvCarBot").innerHTML = "";
                  data.forEach(function(elemento){
                     document.getElementById("InvCarBot").insertRow(-1).innerHTML = '<td>Vinos y Licores</td><td>'+elemento['categoria']+' '+elemento['nombre']+" "+elemento['capacidad']+'</td><td>'+elemento['cantidad']+'</td><td>$'+elemento['costo']+'</td><td>$'+elemento['cantidad']*elemento['costo']+'</td><td><a class="btn btn-danger" onclick="EliminarBot('+elemento['id_carrito']+', $(this));RestaTotal('+elemento['costo']+', '+elemento['cantidad']+')"><i class="fa fa-minus"></i></a></td>';
                  });
                    


                },error:function(){ 
                     console.log(data);
                }
                  });
                }
                
              }
        </script>
@endsection
