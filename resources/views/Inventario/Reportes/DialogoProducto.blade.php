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
</script>
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="dialogo-producto">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Resumir por Producto</h4>
			</div>
			<div class="modal-body">
				<div class="input-group">
  <span class="input-group-addon">Buscar</span>
  <input id="botella" type="text" class="form-control" placeholder="Ingresa Producto a Buscar...">
</div>
<table class="table table-hover">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Tipo</th>
						<th>Opciones</th>
					</tr>
				</thead>
				<tbody class="botbus">
					@foreach($Mobiliario as $mob)
					<tr>
						<td>{{$mob->nombre}}</td>
						<td>{{$mob->tipo}}</td>
						<td><a href="/Resumen/Mobiliario/{{$mob->id_mob}}" class="btn btn-success">Resumir</a></td>
					</tr>
					@endforeach
					@foreach($Cocina as $cn)
					<tr>
						<td>{{$cn->nombre}}</td>
						<td>{{$cn->tipo}}</td>
						<td><a href="/Resumen/Cocina/{{$cn->id_cocina}}" class="btn btn-success">Resumir</a></td>
					</tr>
					@endforeach
					@foreach($Botellas as $bot)
					<tr>
						<td>{{$bot->nombre}} {{$bot->capacidad}}ml</td>
						<td>{{$bot->categoria}}</td>
						<td><a href="/Resumen/Botellas/{{$bot->id_botella}}" class="btn btn-success">Resumir</a></td>
					</tr>
					
					@endforeach
				</tbody>
			</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>