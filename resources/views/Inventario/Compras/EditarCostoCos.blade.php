<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="dialogo-editar-costo-cocina-{{$car_c->id_carrito}}">
  <div class="modal-dialog">
		<div class="modal-content">
      <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Editar Costo Total: {{$car_c->tipo}} {{$car_c->nombre}}</h4>
			</div>
      <div class="modal-body">
        <label for="Costo">Costo Total</label>
        {!!Form::open(array('url'=>'Compras/Comprar/EditarCostoCos','method'=>'POST','autocomplete'=>'off'))!!}
        {{Form::token()}}
        <div class="input-group margin">
          <input type="text" name="id" value="{{$car_c->id_carrito}}" hidden>
            <input type="number" name="costo" value="{{$car_c->costo}}" class="form-control">
            <span class="input-group-btn">
                <button class="btn btn-info btn-flat" type="submit">Editar</button>
            </span>
        </div>
      {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>
