<div class="content-sec inner-sec">
	<?= $this->Form->create('data', array('url' => array( 'controller' => 'Clientes', 'action' => 'add'), 'class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
		<table width="100%">
			<tr>
				<td><?= $this->Form->input('nombre', array('class' => 'form-control', 'required', 'placeholder'=>'Nombre')); ?></td>
				<td><?= $this->Form->input('apellido', array('class' => 'form-control', 'required', 'placeholder'=>'Apellido')); ?></td>
			</tr>
			<tr>
				<td><?= $this->Form->input('mail', array('class' => 'form-control', 'required', 'placeholder'=>'E-Mail', 'type'=>'email')); ?></td>
				<td><?= $this->Form->input('fono', array('class' => 'form-control', 'required', 'placeholder'=>'Teléfono')); ?></td>
			</tr>
			<tr>
				<td>
					<select name="data[data][regionComuna]" id="comuna" required="">
						<option selected="" disabled="" value="0">--Seleccione</option>
						<? foreach ($regionesComunas['regiones'] as $key => $value) {?>
							<optgroup label="<?= $value ?>">
								<? foreach ($regionesComunas['comunas'][$key] as $key2 => $value2) { ?>
									<option value="<?= $key ?>-<?= $key2 ?>"><?= $value2 ?></option>
								<?} ?>
							</optgroup>							
						<?} ?>
					</select>
				</td>
				<td>
					<?= $this->Form->input('direccion', array('class' => 'form-control', 'required', 'placeholder'=>'Dirección')); ?>
				</td>
			</tr>
			<tr>
				<td>
					<?= $this->Form->input('pass', array('class' => 'form-control', 'required', 'placeholder'=>'Contraseña', 'type'=>'password')); ?>
				</td>
				<td>
					<?= $this->Form->input('pass2', array('class' => 'form-control', 'required', 'placeholder'=>'Confirmar Contraseña', 'type'=>'password', 'onkeyup'=>'valida()')); ?>
				</td>
			</tr>
			<tr>
				<td>
					<input type="checkbox" name="data[data][condiciones]" required="" id="condiciones">
					Acepto los <?= $this->Html->link('Terminos y condiciones',   ['controller' => 'Pages', 'action' => 'carrito'],['escape' => false]); ?>
				</td>
				<td>
					<input type="checkbox" name="data[data][newletter]" checked="">
					Suscribirme al Newletter
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center" style="text-align: center;">
					<p class="password" style="display: none;">Las contraseñas no coinciden</p>
					<input class="button round" type="submit" value="Registrar" disabled="" id="bttn">
				</td>
			</tr>
		</table>
	<?= $this->Form->end(); ?>
</div>
<script type="text/javascript">
	function valida(){
		var pass1 = $('#dataPass').val();
		var pass2 = $('#dataPass2').val();
		if(pass1==pass2){
			$('.password').hide();
			document.getElementById("bttn").disabled = false;

		}else{
			$('.password').show();
			document.getElementById("bttn").disabled = true;
		}
	}
</script>