<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="dialogo-fechas">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Resumir por Fechas</h4>
			</div>
			<div class="modal-body">
				<form action="{{ url('/Resumen/Fecha') }}" method="POST">
					@csrf
				<div class="form-group">
					<div class="row">
                        <div class="col-xs-5">
                        	<label>Del: </label>
                            <input type="date" class="form-control" name="del" value="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="col-xs-5">
                        	<label>Hasta: </label>
                            <input type="date" class="form-control" name="hasta" value="<?=date("Y-m-d",strtotime(date('Y-m-d')."+ 1 days")) ?>">
                        </div>

                       

                    </div>
                                  
                </div>
                        	<button type="submit" class="btn btn-success">Resumir</button>

                        	</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>