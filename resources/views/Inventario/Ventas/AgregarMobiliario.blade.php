
<script type="text/javascript">
	$(document).ready(function () {

            (function ($) {

                $('#filtrar').keyup(function () {

                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar tr').hide();
                    $('.buscar tr').filter(function () {
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
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="dialogo-agregar-mobiliario">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Agregar Mobiliario</h4>
			</div>
			<div class="modal-body">

<div class="input-group">
  <span class="input-group-addon">Buscar</span>
  <input id="filtrar" type="text" class="form-control" placeholder="Ingresa El Mobiliario a Buscar...">
</div>
				<div class="box-body table-responsive">
		<div class="dataTables_wrapper form-inline" role="grid">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Tipo</th>
						<th>Nombre</th>
						<th width="100">Cantidad</th>
						<th width="100">Costo</th>
						<th width="100">Opcion</th>
					</tr>
				</thead>
				<tbody class="buscar">
					@foreach($Mobiliario as $mob)
					<tr>
						{!!Form::open(array('url'=>'Ventas/Vender/AgregarMob','method'=>'POST','autocomplete'=>'off'))!!}
            			{{Form::token()}}
						<td>{{$mob->tipo}}</td>
						<td>{{$mob->nombre}}</td>
						<td><input class="form-control" type="number" name="cantidad" onkeyup="Calcular('costo{{$mob->id_mob}}', this.value, {{$mob->costo}} );" onchange="Calcular('costo{{$mob->id_mob}}', this.value, {{$mob->costo}} );"> 
							<input type="text" name="id" value="{{$mob->id_mob}}" hidden></td>
							<td><input type="number" name="costo" id="costo{{$mob->id_mob}}"></td>
						<td>
            				<button type="submit" class="btn btn-success">Agregar</button>
						</td>
						{!!Form::close()!!}
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
