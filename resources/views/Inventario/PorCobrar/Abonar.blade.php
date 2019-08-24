<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="dialogo-abonar{{$pc->id_ventas}}">
  <div class="modal-dialog">
		<div class="modal-content">
      <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Abonar al Adeudo</h4>
			</div>
      <div class="modal-body">
        {!!Form::open(array('url'=>'Cuentas/PorCobrar/Abonar','method'=>'POST','autocomplete'=>'off'))!!}
        {{Form::token()}}
        <div class="input-group margin">
            <h4>Total a Deber:  {{$pc->total-$pc->abonado}}</h4>
            <input type="text" name="id" value="{{$pc->id_ventas}}" hidden>
            <div class="input-group input-group-sm">
              <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                <input type="number" class="form-control" name="abono">
                <span class="input-group-btn">
                    <button class="btn btn-info btn-flat" type="submit">Abonar</button>
                </span>
            </div>
        </div>
      {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>
