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
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="dialogo-agregar-proveedor">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Elegir un Proveedor</h4>
			</div>
			<div class="modal-body">

<div class="input-group">
  <span class="input-group-addon">Buscar</span>
  <input id="cliente" type="text" class="form-control" placeholder="Ingresa El Proveedor a Buscar...">
</div>
				<div class="box-body table-responsive">
		<div class="dataTables_wrapper form-inline" role="grid">
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
            <td> <a href="/Compras/Comprar/Realizar/{{$prov->id_proveedor}}" class="btn btn-success">Comprar</a>
								<a href="#" data-target="#dialogo-por-pagar-{{$prov->id_proveedor}}" data-toggle="modal" class="btn btn-success">Por Pagar</a>
						</td>
          </tr>
					@include('Inventario.Compras.ComprasPorPagar')
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
