<script type="text/javascript">
	$(document).ready(function () {

            (function ($) {

                $('#cliente').keyup(function () {

                    var rex = new RegExp($(this).val(), 'i');
                    $('.botbus tr').hide();
                    $('.botbus tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();

                })

            }(jQuery));

        });
</script>
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="dialogo-agregar-cliente-cot">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Elegir un Cliente</h4>
			</div>
			<div class="modal-body">

<div class="input-group">
  <span class="input-group-addon">Buscar</span>
  <input id="cliente" type="text" class="form-control" placeholder="Ingresa El Cliente a Buscar...">
</div>
				<div class="box-body table-responsive">
		<div class="dataTables_wrapper form-inline" role="grid">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Domicilio</th>
						<th>Telefono</th>
						<th>Correo</th>
						<th width="100">Opcion</th>
					</tr>
				</thead>
				<tbody class="botbus">
          @foreach($Cliente as $cli)
          <tr>
            <td>{{$cli->nombre}}</td>
            <td>{{$cli->domicilio}}</td>
            <td>{{$cli->telefono}}</td>
            <td>{{$cli->correo}}</td>
            <td> <a href="/Ventas/Cotizar/{{$cli->id_cliente}}" class="btn btn-success">Cotizar</a> </td>
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
