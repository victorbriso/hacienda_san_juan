<div class="col-md-12" style="overflow-y: scroll; overflow-x: hidden; max-height: 900px;">
	<div class="row">
		<div class="col-md-10">
			<h4>Productos</h4>
		</div>
		<div class="col-md-2">
			<button type="button" class="btn btn-info" data-toggle="modal" data-target="#addVino">
				Agregar Producto
			</button>
		</div>
	</div>
	<? foreach ($productos as $key => $value) {
		$img=(file_exists('../webroot/img/productos/'.$value['VinaProducto']['id'].'.'.$value['VinaProducto']['extension'])?'productos/'.$value['VinaProducto']['id'].'.'.$value['VinaProducto']['extension']:'productos/img-no-disponible-2.png');
		?>
		<div class="col-md-3 admin-productos">
			<div class="card">
				<div align="center" style="background-color: white;">
					<?= $this->Html->image($img, ['class'=>'card-img-top img-fluid img-administrador']); ?>
				</div>
				
				<div class="card-body">
					<h5 class="card-title text-center"><?= $value['VinaProducto']['nombre'] ?></h5>
					<p class="card-text"><small class="text-muted"><?= $value['VinaProducto']['anhio']; ?></small></p>
					<p class="card-text"><?= number_format($value['VinaProducto']['precio'], 0, ',', '.'); ?></p>
					<p class="card-text"><small class="text-muted"><?= $value['VinaVariedad']['nombre']; ?></small></p>
					<p class="card-text"><small class="text-muted"><?= $value['VinaCepa']['nombre']; ?></small></p>
					<p class="card-text"><small class="text-muted"><?= $value['VinaVina']['nombre']; ?></small></p>
					<p class="card-text"><?= substr($value['VinaProducto']['descripcion'], 0, 200) ?>...</p>
				</div>	
				<div class="card-footer text-center">
					<table class="table">
						<tr>
							<td>
								<?= $this->Html->link('Editar', array('action' => 'editar', $value['VinaProducto']['id']), array('escape' => false, 'class'=>'btn btn-warning'));?>
							</td>
							<td>
								<?= $this->Form->create('data', array('url' => array( 'controller' => 'Admines', 'action' => 'cambiaEstados'), 'class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
							    <?= $this->Form->input('tipo', array('class' => 'form-control', 'type'=>'hidden', 'value'=>'2')); ?>
							    <?= $this->Form->input('id', array('class' => 'form-control', 'type'=>'hidden', 'value'=>$value['VinaProducto']['id'])); ?>
							    <input type="submit" class="btn btn-danger" autocomplete="off" data-loading-text="Espera un momento..." value="Quitar" idform="BodegaAddForm" campoForm="addBodega" editForm="0">
							    <?= $this->Form->end(); ?>
							</td>
						</tr>
					</table>    
				</div>	
			</div>	
		</div>
	<?} ?>		
</div>
<div class="modal fade" id="addVino" tabindex="-1" role="dialog" aria-labelledby="addVinoTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= $this->Form->create('VinaProducto', array('url' => array( 'controller' => 'Admines', 'action' => 'addVinoTienda'), 'class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="col-md-12"><h4 class="text-center">Nuevo Producto</h4></div>
					<div class="row">
						<div class="col-md-5">
							<div class="form-group">
								<?= $this->Form->input('nombre', array('class' => 'form-control', 'type'=>'text', 'placeholder'=>'Nombre')); ?>
							</div>
							<div class="form-group">
								<?= $this->Form->input('precio', array('class' => 'form-control', 'type'=>'number', 'placeholder'=>'precio', 'min'=>0, 'step'=>1)); ?>
							</div>
							<div class="form-group">
								<select class="form-control" name="data[VinaProducto][vina_id]">
									<option selected disabled>-->Viñas</option>
									<? foreach ($categorias['vinas'] as $key => $value) {?>									
										<option value="<?=$key?>"><?=$value?></option>
									<?} ?>
								</select>
							</div>
							<div class="form-group">
								<select class="form-control" name="data[VinaProducto][cepa_id]">
									<option selected disabled>-->Cepa</option>
									<? foreach ($categorias['cepas'] as $key => $value) {?>									
										<option value="<?=$key?>"><?=$value?></option>
									<?} ?>
								</select>
							</div>		
							<div class="form-group">
								<select class="form-control" name="data[VinaProducto][variedad_id]">
									<option selected disabled>-->Variedad</option>
									<? foreach ($categorias['variedades'] as $key => $value) {?>									
										<option value="<?=$key?>"><?=$value?></option>
									<?} ?>
								</select>
							</div>							
							
							
						</div>
						<div class="col-md-1"></div>
						<div class="col-md-6">
							<div class="form-group">
								<?= $this->Form->input('desc_es', array('class' => 'form-control summernote', 'type'=>'textarea', 'placeholder'=>'Descripción Español')); ?>
							</div>
							<div class="form-group">
								<?= $this->Form->input('desc_en', array('class' => 'form-control summernote', 'type'=>'textarea', 'placeholder'=>'Descripción Ingles')); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<input type="submit" class="btn btn-primary"  autocomplete="off" data-loading-text="Espera un momento..." value="Guardar">
			</div>
			<?= $this->Form->end(); ?>
		</div>
	</div>
</div>