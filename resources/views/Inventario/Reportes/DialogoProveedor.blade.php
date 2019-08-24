<script type="text/javascript">
	$(document).ready(function () {

            (function ($) {

                $('#proveedor').keyup(function () {

                    var rex = new RegExp($(this).val(), 'i');
                    $('.botbus tr').hide();
                    $('.botbus tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();

                })

            }(jQuery));

        });
</script>
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="dialogo-proveedor">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Resumir por Proveedor</h4>
			</div>
			<div class="modal-body">
				<div class="input-group">
  <span class="input-group-addon">Buscar</span>
  <input id="proveedor" type="text" class="form-control" placeholder="Ingresa El Proveedor a Buscar...">
</div>
<table class="table table-hover">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Empresa</th>
						<th>RFC</th>
						<th>Telefono</th>
						<th width="200">Opcion</th>
					</tr>
				</thead>
				<tbody class="botbus">
          @foreach($Proveedores as $prov)
          <tr>
            <td>{{$prov->nombre}}</td>
            <td>{{$prov->empresa}}</td>
            <td>{{$prov->rfc}}</td>
            <td>{{$prov->telefono}}</td>
            <td><a href="/Resumen/Proveedor/{{$prov->id_proveedor}}" class="btn btn-success">Seleccionar</a></td>
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