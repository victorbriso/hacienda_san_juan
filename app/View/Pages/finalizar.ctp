<div class="content-sec inner-sec">
	<div class="row">
		<div class="large-12 columns">
			<div class="row">
				<div class="large-4 columns">
					<div class="row">
						<div class="large-12 columns" style="text-align: center;">
							<button class="button radius" onclick="muestra('inicio-sesion');">Tengo cuenta</button>
						</div>						
						
					</div>
				</div>
				<div class="large-4 columns">
					<div class="row">
						<div class="large-12 columns" style="text-align: center;">
							<button class="button radius" onclick="muestra('registro');">Registrarme</button>
						</div>
					</div>
				</div>
				<div class="large-4 columns">
					<div class="row">
						<div class="large-12 columns" style="text-align: center;">
							<button class="button radius" onclick="muestra('compra-invitado');">Comprar sin registrarme</button>
						</div>
					</div>
				</div>
				<div class="large-12 columns separacion"></div>
				<div class="large-12 columns inicio-sesion contenido-centrado">
					<?= $this->Form->create('login', array('url' => array( 'controller' => 'Clientes', 'action' => 'login'), 'class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
					<table width="100%">
						<tr>
							<td>
								<?= $this->Form->input('mail', array('class' => 'form-control', 'required', 'placeholder'=>'E-Mail', 'type'=>'email')); ?>
							</td>
							<td>
								<?= $this->Form->input('pass', array('class' => 'form-control', 'required', 'placeholder'=>'Contraseña', 'type'=>'password')); ?>

							</td>
						</tr>
						<tr>
							<td colspan="2" align="center" style="text-align: center;">
								<button type="button" class="button round" onclick="login();">Ingresar</button>
							</td>
						</tr>
						<tr id="mail" style="display: none;">
							<td colspan="2" align="center" style="text-align: center;">
								El correo ingresado no existe
							</td>
						</tr>
						<tr id="pass" style="display: none;">
							<td colspan="2" align="center" style="text-align: center;">
								La contraseña es incorrecta
							</td>
						</tr>
						<tr id="error" style="display: none;">
							<td colspan="2" align="center" style="text-align: center;">
								Error al hacer login
							</td>
						</tr>
					</table>
					<?= $this->Form->end(); ?>
				</div>
				<div class="large-12 columns registro contenido-centrado">
					<?= $this->Form->create('data', array('url' => array( 'controller' => 'Clientes', 'action' => 'add'), 'class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
					<table width="100%">
						<tr>
							<td><?= $this->Form->input('nombre', array('class' => 'form-control', 'required', 'placeholder'=>'Nombre')); ?></td>
							<td>
								<?= $this->Form->input('apellido', array('class' => 'form-control', 'required', 'placeholder'=>'Apellido')); ?>
								<?= $this->Form->input('origen', array('type' => 'hidden', 'value'=>1)); ?>		
							</td>
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
								<input type="checkbox" name="data[data][condiciones]" required="" id="condiciones" onclick="terminosCondiciones();">
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
								<input type="submit" value="Registrar" disabled="" id="bttn" class="button radius">
								<p class="classTrminosCondiciones">Debes aceptar los terminos y condiciones para poder registrarte.</p>
							</td>
						</tr>
					</table>
					<?= $this->Form->end(); ?>
				</div>
				<div class="large-12 columns compra-invitado contenido-centrado">
					<?= $this->Form->create('dataNoUser', array('url' => array( 'controller' => 'Clientes', 'action' => 'add2'), 'class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
					<table width="100%">
						<tr>
							<td><?= $this->Form->input('nombre', array('class' => 'form-control', 'required', 'placeholder'=>'Nombre')); ?></td>
							<td>
								<?= $this->Form->input('apellido', array('class' => 'form-control', 'required', 'placeholder'=>'Apellido')); ?>
								<?= $this->Form->input('origen', array('type' => 'hidden', 'value'=>1)); ?>		
							</td>
						</tr>
						<tr>
							<td><?= $this->Form->input('mail', array('class' => 'form-control', 'required', 'placeholder'=>'E-Mail', 'type'=>'email')); ?></td>
							<td><?= $this->Form->input('fono', array('class' => 'form-control', 'required', 'placeholder'=>'Teléfono')); ?></td>
						</tr>
						<tr>
							<td>
								<select name="data[dataNoUser][regionComuna]" id="comuna" required="">
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
								<input type="checkbox" name="data[dataNoUser][condiciones]" required="" id="condiciones">
								Acepto los <?= $this->Html->link('Terminos y condiciones',   ['controller' => 'Pages', 'action' => 'carrito'],['escape' => false]); ?>
							</td>
							<td>
								<input type="checkbox" name="data[dataNoUser][newletter]" checked="">
								Suscribirme al Newletter
							</td>
						</tr>
						<tr>
							<td colspan="2" align="center" style="text-align: center;">
								<input class="button round" type="submit" value="Continuar">
							</td>
						</tr>
					</table>
					<?= $this->Form->end(); ?>
				</div>
			</div>
		</div>	
	</div>	
</div>
<script type="text/javascript">
	function terminosCondiciones(){
		var pass1 = $('#dataPass').val();
		var pass2 = $('#dataPass2').val();
		if(pass1==pass2){
			$('.password').hide();	
			var isChecked = document.getElementById('condiciones').checked;		
			if(isChecked) {
				$('.classTrminosCondiciones').hide();
				document.getElementById("bttn").disabled = false;
			}else{
				$('.classTrminosCondiciones').show();
				document.getElementById("bttn").disabled = true;
			}
		}
	}
	function valida(){
		var pass1 = $('#dataPass').val();
		var pass2 = $('#dataPass2').val();
		if(pass1==pass2){
			$('.password').hide();
			var isChecked = document.getElementById('condiciones').checked;		
			if(isChecked) {
				document.getElementById("bttn").disabled = false;
			}else{
				document.getElementById("bttn").disabled = true;
			}
		}else{
			$('.password').show();
			document.getElementById("bttn").disabled = true;
		}
	}
	function muestra(clase){
		oculta();
		$('.'+clase).show();
	}
	function oculta(){
		$('.inicio-sesion').hide();
		$('.registro').hide();
		$('.compra-invitado').hide();
	}
	function login(){
		var mail = $('#loginMail').val();
		var pass = $('#loginPass').val();
		$.ajax({
            type: 'POST',
            url: 'loginAjax',
            data            : {
                mail         : mail,
                pass 		 : pass
            },
            success: function (result) {
            	if(result==1){
            		$('#error').show();
            		setTimeout(function(){ $('#error').hide(); }, 1500);
            	}
            	if(result==2){
            		$('#mail').show();
            		setTimeout(function(){ $('#mail').hide(); }, 1500);
            	}
            	if(result==3){
            		$('#pass').show();
            		setTimeout(function(){ $('#pass').hide(); }, 1500);
            	}
            	if(result==4){
            		window.location.href = 'pago';
            	}
            },
            error: function (result){
                console.log(result);
            }
        }); 
	}

</script>