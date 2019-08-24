<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="dialogo-agregar-gasto">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Agregar Gasto</h4>
			</div>
			<div class="modal-body">
        {!!Form::open(array('url'=>'Gastos/Nuevo','method'=>'POST','autocomplete'=>'off',))!!}
    		{{Form::token()}}
        <div class="form-group">
          <div class="form-group">
            <label>Clave</label>
            <select class="form-Control" name="clave">
              @foreach($Motivos as $mt)
              <option value="{{$mt->id_gasto}}">{{$mt->id_gasto}} | {{$mt->nombre}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Monto</label>
            <input type="number" name="monto" class="form-control" placeholder="Monto del Gasto">
          </div>

        <button type="submit" name="button" class="btn btn-success">Agregar</button>
        {!!Form::close()!!}
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
