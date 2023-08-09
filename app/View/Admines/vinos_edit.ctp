<div class="panel panel-default">
	<div class="panel-heading"><h4><i class="fa fa-cog"></i> Edición <?= $data['Vino']['nombre']; ?></h4></div>
	<?= $this->Form->create('Vino', array('url' => array( 'controller' => 'Admines', 'action' => 'vinosEdit'), 'class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
	<div class="panel-body">
		<div class="col-md-12">
		<div class="row">			
			<div class="col-md-5">
				<div class="form-group">
					<?= $this->Form->input('id', array('class' => 'form-control', 'type'=>'hidden', 'value'=>$data['Vino']['id'])); ?>
					<?= $this->Form->input('nombre', array('class' => 'form-control', 'type'=>'text', 'value'=>$data['Vino']['nombre'])); ?>
				</div>
				<div class="form-group">
					<select class="form-control" name="data[Vino][cepa_id]">
						<? foreach ($categorias['cepas'] as $key => $value) {
							if($key==$data['Vino']['cepa_id']){
								$var='selected';
							}else{
								$var='';
							}?>
							<option <?=$var?> value="<?=$key?>"><?=$value?></option>
						<?} ?>
					</select>
				</div>		
				<div class="form-group">
					<select class="form-control" name="data[Vino][variedad_id]">
						<? foreach ($categorias['variedades'] as $key => $value) {
							if($key==$data['Vino']['variedad_id']){
								$var='selected';
							}else{
								$var='';
							}?>
							<option <?=$var?> value="<?=$key?>"><?=$value?></option>
						<?} ?>
					</select>
				</div>
				<div class="form-group">
					<?= $this->Html->image('misVinos/'.$data['Vino']['path_img'], ['class'=>'card-img-top img-fluid img-administrador']); ?>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cambiaImagen">Cambiar Imagen</button>
				</div>		
			</div>
			<div class="col-md-1"></div>
			<div class="col-md-6">
				<div class="form-group">
					<?= $this->Form->input('desc_es', array('class' => 'form-control summernote', 'type'=>'textarea', 'value'=>$data['Vino']['desc_es'])); ?>
				</div>
				<div class="form-group">
					<?= $this->Form->input('desc_en', array('class' => 'form-control summernote', 'type'=>'textarea', 'value'=>$data['Vino']['desc_en'])); ?>
				</div>
			</div>
		</div>	
		</div>
		
	</div>
	<div class="panel-footer">
		<div class="row">
			<div class="pull-right">
				<?= $this->Html->link('Cancelar',	['action' => 'vinos'],['escape' => false, 'class'=>'btn btn-secondary']); ?>
				<input type="submit" class="btn btn-primary"  autocomplete="off" data-loading-text="Espera un momento..." value="Guardar">
			</div>	
		</div>		
	</div>
	<?= $this->Form->end(); ?>
</div>
<div class="modal fade" id="cambiaImagen" tabindex="-1" role="dialog" aria-labelledby="cambiaImagenTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= $this->Form->create('Vino', array('url' => array( 'controller' => 'Admines', 'action' => 'cambiaImagen'), 'class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
			<div class="modal-body">
				<div class="container-fluid">
					<?= $this->Form->input('image', array('type' => 'file', 'class'=>'file', 'multiple')); ?>
					<?= $this->Form->input('id', array('type' => 'hidden','value'=>$data['Vino']['id'])); ?>
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