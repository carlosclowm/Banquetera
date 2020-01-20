<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="dialogo-nuevo-producto">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Agregar Producto</h4>
			</div>
			<div class="modal-body" align="center">
				<div class="input-group" align="center">
					<select class="form-control" onchange="LoadProd(this.value)">
						<option>Categoria...</option>
						<option>Mobiliario</option>
						<option>Cocina</option>
						<option>Vinos y Licores</option>
					</select>

				</div>

				<div class="input-group" id="Formulario">
					
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function LoadProd(name){
		if(name == 'Mobiliario'){
			document.getElementById('Formulario').innerHTML = "";
		var FormularioMob = '<hr>{!!Form::open(array("url"=>"Inventario/Mobiliario/Nuevo/AgregarToVentas","method"=>"POST","autocomplete"=>"off",))!!}{{Form::token()}} <label>Tipo</label><div class="input-group"><span class="input-group-addon"><i class="fa fa-bars"></i></span><input type="text" name="tipo" class="form-control" placeholder="Tipo de Mobiliario..."></div><br><label>Nombre</label><div class="input-group"><span class="input-group-addon"><i class="fa fa-tags"></i></span><input type="text" name="nombre" class="form-control" placeholder="Nombre del Mobiliario..."></div><div><br><button class="btn btn-primary" type="submit">Agregar</button></div> {!!Form::close()!!}';
		document.getElementById('Formulario').innerHTML = FormularioMob;
		}
		if(name == 'Cocina'){
			document.getElementById('Formulario').innerHTML = "";
		var FormularioCos = '<hr>{!!Form::open(array("url"=>"Inventario/Cocina/Nuevo/AgregarToVentas","method"=>"POST","autocomplete"=>"off",))!!}{{Form::token()}}<label>Tipo</label><div class="input-group"><span class="input-group-addon"><i class="fa fa-bars"></i></span><input type="text" name="tipo" class="form-control" placeholder="Tipo de Mobiliario..."></div><br><label>Nombre</label><div class="input-group"><span class="input-group-addon"><i class="fa fa-tags"></i></span><input type="text" name="nombre" class="form-control" placeholder="Nombre del Mobiliario..."></div><div><br><button class="btn btn-primary" type="submit">Agregar</button></div>{!!Form::close()!!}';
		document.getElementById('Formulario').innerHTML = FormularioCos;
		}
		if(name == 'Vinos y Licores'){
			document.getElementById('Formulario').innerHTML = "";
		var FormularioBot = '<hr>{!!Form::open(array("url"=>"Inventario/Botellas/Nuevo/AgregarToVentas","method"=>"POST","autocomplete"=>"off",))!!}		{{Form::token()}}<label>Categoria</label><div class="input-group"><span class="input-group-addon"><i class="fa fa-bars"></i></span><input type="text" name="categoria" class="form-control" placeholder="Categoria de Botella..."></div>		<br><label>Nombre</label>	<div class="input-group"><span class="input-group-addon"><i class="fa fa-tags"></i></span><input type="text" name="nombre" class="form-control" placeholder="Nombre de la Botella..."></div><br>		<label>Capacidad [ml]</label>	<div class="input-group"><span class="input-group-addon"><i class="fa fa-tags"></i></span><input type="text" name="capacidad" class="form-control" placeholder="Capacidad de la Botella..."></div>		<div><br><button class="btn btn-primary" type="submit">Agregar</button></div>{!!Form::close()!!}';
		document.getElementById('Formulario').innerHTML = FormularioBot;
		}
	}

</script>