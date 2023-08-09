<div class="col-md-12">
	<div class="row">
		<div class="col-md-4">
			<table class="table">
				<?= $this->Form->create('data', array('url' => array( 'controller' => 'Admines', 'action' => 'agregaCategorias'), 'class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
				<tr>
					<td align="center">
						<h4>Cepas</h4>
					</td>
				</tr>
				<tr>
					<td>
						<?= $this->Form->input('nombre', array('class' => 'form-control', 'required', 'placeholder'=>'Cepa')); ?>
						<?= $this->Form->input('tipo', array('class' => 'form-control', 'type'=>'hidden', 'value'=>'1')); ?>
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" class="btn btn-success btn-block" autocomplete="off" data-loading-text="Espera un momento..." value="Guardar" idform="BodegaAddForm" campoForm="addBodega" editForm="0">
					</td>
				</tr>
				<?= $this->Form->end(); ?>
				<? foreach ($cepas as $key => $value) {?>
					<tr>
						<td>
							<?= $value['VinaCepa']['nombre'] ?>
						</td>
					</tr>
				<?} ?>
			</table>
		</div>	
		<div class="col-md-4">
			<table class="table">
				<?= $this->Form->create('data', array('url' => array( 'controller' => 'Admines', 'action' => 'agregaCategorias'), 'class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
				<tr>
					<td align="center">
						<h4>Viñas</h4>
					</td>
				</tr>
				<tr>
					<td>
						<?= $this->Form->input('nombre', array('class' => 'form-control', 'required', 'placeholder'=>'Viña')); ?>
						<?= $this->Form->input('tipo', array('class' => 'form-control', 'type'=>'hidden', 'value'=>'3')); ?>
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" class="btn btn-success btn-block" autocomplete="off" data-loading-text="Espera un momento..." value="Guardar" idform="BodegaAddForm" campoForm="addBodega" editForm="0">
					</td>
				</tr>
				<?= $this->Form->end(); ?>
				<? foreach ($vinas as $key => $value) {?>
					<tr>
						<td>
							<?= $value['VinaVina']['nombre'] ?>
						</td>
					</tr>
				<?} ?>
			</table>
		</div>	
		<div class="col-md-4">
			<table class="table">
				<?= $this->Form->create('data', array('url' => array( 'controller' => 'Admines', 'action' => 'agregaCategorias'), 'class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
				<tr>
					<td align="center">
						<h4>Variedades</h4>
					</td>
				</tr>
				<tr>
					<td>
						<?= $this->Form->input('nombre', array('class' => 'form-control', 'required', 'placeholder'=>'Variedad')); ?>
						<?= $this->Form->input('tipo', array('class' => 'form-control', 'type'=>'hidden', 'value'=>'2')); ?>
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" class="btn btn-success btn-block" autocomplete="off" data-loading-text="Espera un momento..." value="Guardar" idform="BodegaAddForm" campoForm="addBodega" editForm="0">
					</td>
				</tr>
				<?= $this->Form->end(); ?>
				<? foreach ($variedades as $key => $value) {?>
					<tr>
						<td>
							<?= $value['VinaVariedad']['nombre'] ?>
						</td>
					</tr>
				<?} ?>
			</table>
		</div>	
	</div>
	
</div>