<div class="content-sec inner-sec">
	<div class="row contenido-centrado">
		<div class="large-9 medium-9 small-12 columns contenido-centrado">
			<div class="row">
			<div class="large-9 medium-9 small-12 columns contenido-centrado">
			<? if(isset($estado)){
				if($estado==1){?>
					<h4>El correo ingresado no existe</h4><br>
				<?}elseif ($estado==2) {?>
					<h4>La contraseña ingresada no es valida</h4>
				<?}
			} ?>	
			</div>
			
			<?= $this->Form->create('data', array('url' => array( 'controller' => 'Clientes', 'action' => 'login'), 'class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
			<table>
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
						<input class="button round" type="submit" value="Ingresar">
					</td>
				</tr>
			</table>
			<?= $this->Form->end(); ?>	
			</div>
			
		</div>
	</div>	
</div>