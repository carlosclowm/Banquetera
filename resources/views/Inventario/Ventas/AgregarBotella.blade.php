<script type="text/javascript">
	$(document).ready(function () {

            (function ($) {

                $('#botella').keyup(function () {

                    var rex = new RegExp($(this).val(), 'i');
                    $('.botbus tr').hide();
                    $('.botbus tr').filter(function () {
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
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="dialogo-agregar-botella">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Agregar Vino o Licor</h4>
			</div>
			<div class="modal-body">

<div class="input-group">
  <span class="input-group-addon">Buscar</span>
  <input id="botella" type="text" class="form-control" placeholder="Ingresa El Vino o Licor a Buscar...">
</div>
				<div class="box-body table-responsive">
		<div class="dataTables_wrapper form-inline" role="grid">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Categoria</th>
						<th>Nombre</th>
						<th>Cantidad</th>
						<th width="100">Cantidad</th>
						<th width="100">Opcion</th>
					</tr>
				</thead>
				<tbody class="botbus">
					@foreach($Botella as $bot)
					<tr>
						{!!Form::open(array('url'=>'Ventas/Vender/AgregarBot','method'=>'POST','autocomplete'=>'off'))!!}
            			{{Form::token()}}
						<td>{{$bot->categoria}}</td>
						<td>{{$bot->nombre}}</td>
						<td>{{$bot->capacidad}}</td>
						<td><input class="form-control" type="number" name="cantidad" onkeyup="Calcular('costoBot{{$bot->id_botella}}', this.value, {{$bot->costo}} );" onchange="Calcular('costoBot{{$bot->id_botella}}', this.value, {{$bot->costo}} );"> 
							<input type="text" name="id" value="{{$bot->id_botella}}" hidden></td>
						<td><input type="number" name="costo" id="costoBot{{$bot->id_botella}}"></td>
						<td><button type="submit" class="btn btn-success">Agregar</button></td>
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
