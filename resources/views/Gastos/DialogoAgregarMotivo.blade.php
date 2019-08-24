<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="dialogo-agregar-motivo">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Agregar Motivo</h4>
			</div>
			<div class="modal-body">
        {!!Form::open(array('url'=>'Gastos/Motivo/Nuevo','method'=>'POST','autocomplete'=>'off',))!!}
    		{{Form::token()}}
        <div class="form-group">
          <label>Clave</label>
          <input type="text" name="clave" class="form-control" placeholder="Clave del Gasto">
          <label>Nombre</label>
          <input type="text" name="nombre" class="form-control" placeholder="Nombre del Gasto">
          <label>Descripcion</label>
          <textarea name="descripcion" rows="3" cols="50" class="form-control"></textarea>

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
