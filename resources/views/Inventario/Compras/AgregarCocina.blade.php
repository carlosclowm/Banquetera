
<script type="text/javascript">
	$(document).ready(function () {
 
            (function ($) {
 
                $('#cocina').keyup(function () {
 
                    var rex = new RegExp($(this).val(), 'i');
                    $('.bscocina tr').hide();
                    $('.bscocina tr').filter(function () {
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
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="dialogo-agregar-cocina">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Agregar Mobiliario de Cocina</h4>
			</div>
			<div class="modal-body">
				
<div class="input-group">
  <span class="input-group-addon">Buscar</span>
  <input id="cocina" type="text" class="form-control" placeholder="Ingresa El Mobiliario a Buscar...">
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
				<tbody class="bscocina">
					@foreach($Cocina as $cos)
					<tr>
						{!!Form::open(array('url'=>'Compras/Comprar/AgregarCos','method'=>'POST','autocomplete'=>'off'))!!}
            			{{Form::token()}}
						<td>{{$cos->tipo}}</td>
						<td>{{$cos->nombre}}</td>
						<td><input class="form-control" type="number" name="cantidad" onkeyup="Calcular('costoCos{{$cos->id_cocina}}', this.value, {{$cos->costo}} );" onchange="Calcular('costoCos{{$cos->id_cocina}}', this.value, {{$cos->costo}} );"> 
							<input type="text" name="id" value="{{$cos->id_cocina}}" hidden ></td>
						<td><input type="number" name="costo" id="costoCos{{$cos->id_cocina}}"></td>
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