<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="dialogo-por-pagar-{{$prov->id_proveedor}}">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Abono a la Cuenta</h4>
			</div>
			<div class="modal-body">
          <h3>Debe: $<?= number_format($Total) ?></h3>
          <h4>Abono:</h4>
          <div class="input-group input-group-sm">
            {!!Form::open(array('url'=>'Compras/Comprar/PorPagar','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
              <input type="text" name="id" value="{{$prov->id_proveedor}}" hidden>
              <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
              <input type="text" class="form-control" name="abono" min="0" max="{{$Total}}">
              <span class="input-group-btn">
                  <button class="btn btn-success btn-flat" type="submit">Abonar</button>
              </span>
            {!!Form::close()!!}

        </div>
        </div>



			</div>
		</div>
	</div>
