<?
$img=(file_exists('../webroot/img/productos/'.$producto['VinaProducto']['id'].'.'.$producto['VinaProducto']['extension'])?'productos/'.$producto['VinaProducto']['id'].'.'.$producto['VinaProducto']['extension']:'productos/img-no-disponible-2.png');
?>

<div class="col-md-12">
	<h4 class="text-center"> <?=$producto['VinaProducto']['nombre']?> </h4>
	<div class="row">
		<?= $this->Form->create('VinaProducto', array('url' => array( 'controller' => 'Admines', 'action' => 'editar'), 'class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
		<div class="col-md-6">
			<table class="table">
				<tr>
					<td align="center">
						<?= $this->Html->image($img, ['class'=>'card-img-top img-fluid img-administrador']); ?>
					</td>
				</tr>
				<tr>
					<td>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cambiaImagen">Cambiar Imagen</button>
					</td>
				</tr>
				<tr>
					<td>
						<?= $this->Form->input('descripcion', array('class' => 'form-control summernote', 'value'=>$producto['VinaProducto']['descripcion'], 'type'=>'textarea')); ?>
					</td>
				</tr>
			</table>
		</div>
		<div class="col-md-6">
			<table class="table">
				<tr>
					<td>Nombre</td>
					<td><?= $this->Form->input('nombre', array('class' => 'form-control', 'value'=>$producto['VinaProducto']['nombre'], 'type'=>'text')); ?>
						<?= $this->Form->input('id', array('class' => 'form-control', 'value'=>$producto['VinaProducto']['id'], 'type'=>'hidden')); ?>
					</td>
				</tr>
				<tr>
					<td>Año</td>
					<td><?= $this->Form->input('anhio', array('class' => 'form-control', 'value'=>$producto['VinaProducto']['anhio'], 'type'=>'number')); ?></td>
				</tr>
				<tr>
					<td>Viña</td>
					<td>
						<select class="form-control" name="data[VinaProducto][vina_id]">
							<? foreach ($generalXategorias['vinas'] as $key => $value) {
								if($key==$producto['VinaProducto']['vina_id']){
									$var='selected';
								}else{
									$var='';
								}?>
								<option <?=$var?> value="<?=$key?>"><?=$value?></option>
							<?} ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Cepa</td>
					<td>
						<select class="form-control" name="data[VinaProducto][cepa_id]">
							<? foreach ($generalXategorias['cepas'] as $key => $value) {
								if($key==$producto['VinaProducto']['cepa_id']){
									$var='selected';
								}else{
									$var='';
								}?>
								<option <?=$var?> value="<?=$key?>"><?=$value?></option>
							<?} ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Variedad</td>
					<td>
						<select class="form-control" name="data[VinaProducto][variedad_id]">
							<? foreach ($generalXategorias['variedades'] as $key => $value) {
								if($key==$producto['VinaProducto']['variedad_id']){
									$var='selected';
								}else{
									$var='';
								}?>
								<option <?=$var?> value="<?=$key?>"><?=$value?></option>
							<?} ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Promoción</td>
					<td>
						<? $check=($producto['VinaProducto']['promocion'])?'checked':''; ?>
						<input type="checkbox" name="data[VinaProducto][promocion]" value="<?=$producto['VinaProducto']['promocion']?>" <?= $check ?>>
					</td>
				</tr>
				<tr>
					<td>Destacado</td>
					<td>
						<? $check=($producto['VinaProducto']['destacado'])?'checked':''; ?>
						<input type="checkbox" name="data[VinaProducto][destacado]" value="<?=$producto['VinaProducto']['destacado']?>" <?= $check ?>>
					</td>
				</tr>
				<tr>
					<td>Precio</td>
					<td>
						<?= $this->Form->input('precio', array('class' => 'form-control', 'value'=>$producto['VinaProducto']['precio'], 'type'=>'number')); ?>
					</td>
				</tr>
			</table>
		</div>
		<div class="col-md-12">
			<div class="pull-right">
                <input type="submit" class="btn btn-success"  autocomplete="off" data-loading-text="Espera un momento..." value="Guardar cambios">
				<?= $this->Html->link('Cancelar', array('action' => 'productos'), array('class' => 'btn-form-submit btn btn-danger')); ?>
			</div>
		</div>
		<?= $this->Form->end(); ?>
	</div>
</div>
<div class="modal fade" id="cambiaImagen" tabindex="-1" role="dialog" aria-labelledby="cambiaImagenTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= $this->Form->create('VinaProducto', array('url' => array( 'controller' => 'Admines', 'action' => 'cambiaImagenProductos'), 'class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
			<div class="modal-body">
				<div class="container-fluid">
					<?= $this->Form->input('image', array('type' => 'file', 'class'=>'file', 'multiple')); ?>
					<?= $this->Form->input('id', array('class' => 'form-control', 'value'=>$producto['VinaProducto']['id'], 'type'=>'hidden')); ?>
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