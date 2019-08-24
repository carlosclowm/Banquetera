<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="dialogo-razon{{$prov->id_proveedor}}">
  <div class="modal-dialog">
		<div class="modal-content">
      <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Razon de la Devolucion</h4>
			</div>
      <div class="modal-body">
        <label for="Costo">Razon</label>
        {!!Form::open(array('url'=>'Compras/Devolver/Compra','method'=>'POST','autocomplete'=>'off'))!!}
        {{Form::token()}}
        <div class="input-group margin">
          <input type="text" name="id" value="{{$prov->id_proveedor}}" hidden>
            <textarea name="razon" rows="6" cols="75"></textarea>
            <span class="input-group-btn">
                <button class="btn btn-info btn-flat" type="submit">Devolver</button>
            </span>
        </div>
      {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>
