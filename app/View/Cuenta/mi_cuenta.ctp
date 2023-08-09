<div class="content-sec inner-sec">
	<div class="row">
		<div class="large-12 columns" style="margin-bottom: 10px;">
			<div class="large-4 columns">
				<button class="button radius" onclick="verMisDatos();">Datos personales</button>
			</div>
			<div class="large-4 columns">
				<button class="button radius" onclick="verCompras();">Historial de compras</button>
			</div>
			<div class="large-4 columns">
				<?= $this->Html->link('Salir', array('controller'=>'Clientes', 'action' => 'logOut'), array('escape' => false, 'class'=>'button radius btn-naranjo'));?>
			</div>
			<div class="separacion"><p style="color: #fff;">--</p></div>
		</div>
		<div class="large-12 columns contenido-centrado" id="datosPersonales">
			<table style="margin-top: 10px;">
				<tr>
					<td colspan="2"><h4 class="text-center">Mis datos personales</h4></td>
				</tr>
				<tr>
					<td>
						<label class="text-center">Nombre</label>
						<input type="text" name="nombre" id="nombre" value="<?= $datosUsuario['VinaUsuario']['nombre']; ?>">
						<input type="hidden" name="id" id="id" value="<?= $datosUsuario['VinaUsuario']['id']; ?>">
					</td>
					<td>
						<label class="text-center">Apellido</label>
						<input type="text" name="apellido" id="apellido" value="<?= $datosUsuario['VinaUsuario']['apellido']; ?>">
					</td>
				</tr>
				<tr>
					<td>
						<label class="text-center">Fono</label>
						<input type="text" name="fono" id="fono" value="<?= $datosUsuario['VinaUsuario']['fono']; ?>">
					</td>
					<td>
						<label class="text-center">Mail</label>
						<input type="text" name="mail" id="mail" value="<?= $datosUsuario['VinaUsuario']['mail']; ?>">
					</td>
				</tr>
				<tr>
					<td>
						<button class="button radius">Cambiar contraseña</button>
					</td>
					<td>
						<button class="button radius" onclick="verDirecciones();">Direcciones</button>
					</td>
				</tr>
				<tr>
					<td colspan="2"><button class="button radius" style="width: 100%" onclick="actualizaDatos();">Guardar cambios</button></td>
				</tr>
				<tr>
					<td colspan="2">
						<p class="exitoActualizacion" style="color: green; text-align: center; display: none;">Datos Actualizados correctamente</p>
						<p class="fracasoActualizacion" style="color: red; text-align: center; display: none;">Error al actualizar los datos</p>
					</td>
				</tr>
			</table>
		</div>
		<div class="large-12 columns contenido-centrado" id="infoDirecciones" style="display: none;">
			<table>
				<thead>
					<tr>
						<th>#</th>
						<th>Direccion</th>
						<th>Region</th>
						<th>Comuna</th>
						<th>Acción</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="2">
							<input type="text" name="direccion">
						</td>
						<td>
							<select>
								<option selected="" disabled="">--Región</option>
							</select>
						</td>
						<td>
							<select>
								<option selected="" disabled="">--Comuna</option>
							</select>
						</td>
						<td>
							<button class="button radius btn-verde">Agregar</button>
						</td>
					</tr>
					<? foreach ($datosUsuario['VinaUsuario']['direccion'] as $key1 => $value1) {
						$region=explode('-', $value1[0]);
						$comuna=explode('-', $value1[1]);
						?>
						<tr>
							<td><?= $key1+1; ?></td>
							<td><?= $value1[2] ?></td>
							<td><?= $region[1] ?></td>
							<td><?= $comuna[1] ?></td>
							<td><button class="button radius btn-naranjo">Quitar</button></td>
						</tr>
					<?} ?>
					<tr>
						<td colspan="5">
							<button class="button radius" onclick="voler();" style="width: 100%">Volver</button>
						</td>
					</tr>
				</tbody>
			</table>			
		</div>
		<div class="large-12 columns contenido-centrado" id="infoCompras" style="display: none;">
			<table>
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">Fecha</th>
						<th class="text-center">Productos</th>
						<th class="text-center">Total</th>
						<th class="text-center">Estado</th>
						<th class="text-center">Detalle</th>
					</tr>
				</thead>
				<tbody>
					<? foreach ($dataCompras as $key2 => $value2) { 
						$fecha=explode(' ', $value2['VinaVentaResumen']['fecha']);
						if($value2['VinaVentaResumen']['fecha']==0){
							$estado='Pedido en proceso';
						}elseif ($value2['VinaVentaResumen']['fecha']==1) {
							$estado='Pedido en despacho';
						}elseif ($value2['VinaVentaResumen']['fecha']==2) {
							$estado='Pedido entregado';
						}
						?>
						<tr>
							<td class="text-center"><?= $key2+1; ?></td>
							<td class="text-center"><?= $fecha[0]; ?></td>
							<td class="text-center"><?= $value2['VinaVentaResumen']['productos'] ?></td>
							<td class="text-center">$<?= number_format($value2['VinaVentaResumen']['total'], 0, ',', '.') ?></td>
							<td class="text-center"><?= $estado ?></td>
							<td class="text-center"><button class="button radius btn-verde" onclick="muestraDetalle(<?= $value2['VinaVentaResumen']['id'] ?>)">Ver detalle</button></td>
						</tr>
						<tr id="detalle_<?= $value2['VinaVentaResumen']['id'] ?>" style="display: none;" >
							<td colspan="6">
								<table width="100%">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th class="text-center">Producto</th>
											<th class="text-center">Precio</th>
											<th class="text-center">Cantidad</th>
											<th class="text-center">Total</th>
										</tr>
									</thead>
									<tbody>
										<? foreach ($dataResumen[$value2['VinaVentaResumen']['id']] as $key3 => $value3) {?>
												<tr>
													<td><?= $key3+1; ?></td>
													<td><?= $value3['producto']; ?></td>
													<td>$<?= number_format($value3['precio'], 0, ',', '.') ; ?></td>
													<td><?= $value3['cantidad']; ?></td>
													<td>$<?= number_format($value3['precio']*$value3['cantidad'], 0, ',', '.') ; ?></td>
												</tr>
										<?} ?>
									</tbody>
									<tr>
										<td class="text-center" colspan="5"><button class="button radius btn-naranjo" onclick="ocultaDetalle(<?= $value2['VinaVentaResumen']['id'] ?>)">Cerrar</button></td>
									</tr>
								</table>
							</td>
						</tr>
					<?} ?>
				</tbody>
			</table>			
		</div>
	</div>
</div>
<script type="text/javascript">
	function verDirecciones(){
		$('#datosPersonales').hide();
		$('#infoDirecciones').show();
	}
	function voler(){
		$('#infoDirecciones').hide();
		$('#datosPersonales').show();
	}
	function verCompras(){
		$('#infoDirecciones').hide();
		$('#datosPersonales').hide();
		$('#infoCompras').show();
	}
	function verMisDatos(){
		$('#infoCompras').hide();
		$('#datosPersonales').show();
	}
	function actualizaDatos(){
		var id 			=	$('#id').val();
		var nombre 		=	$('#nombre').val();
		var apellido 	=	$('#apellido').val();
		var fono 		=	$('#fono').val();
		var mail 		=	$('#mail').val();
		$.ajax({
            type: 'POST',
            url: 'actualizaDatos',
            data            : {
            	id 			:	id,
				nombre 		:	nombre,
				apellido 	:	apellido,
				mail 		:	mail,
				fono 		:	fono

            },
            success: function (result) {
            	if(result==1){
            		$('.exitoActualizacion').show();
            		setTimeout(function(){ $('#exitoActualizacion').hide(); }, 1500);
            	}
            	if(result==2){
            		$('.fracasoActualizacion').show();
            		setTimeout(function(){ $('#fracasoActualizacion').hide(); }, 1500);
            	}
            },
            error: function (result){
                $('.fracasoActualizacion').show();
            	setTimeout(function(){ $('#fracasoActualizacion').hide(); }, 1500);
            }
        }); 
	}
	function muestraDetalle(id){
		$('#detalle_'+id).show();
	}
	function ocultaDetalle(id){
		$('#detalle_'+id).hide();
	}
</script>