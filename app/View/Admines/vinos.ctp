<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-6">
				<h4>Mis Vinos</h4>
			</div>
			<div class="col-md-6">
				<div class="pull-right">
					<div>
						<button type="button" class="btn btn-info" data-toggle="modal" data-target="#addVino">
							Agregar Vino
						</button>
					</div>
					
				</div>	
			</div>
		</div>
		
		
	</div>
	<div class="panel-body">
		<div class="col-md-12">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Nombre</th>
						<th>Variedad</th>
						<th>Cepa</th>
						<th>Descripciones</th>
						<th>Estado</th>
						<th>Acciones</th>
					</tr> 
				</thead>
				<tbody>
					<? if(!empty($misVinos)){
						foreach ($misVinos as $key => $value) {
							$estado=($value['Vino']['estado'])?'Activo':'No activo';
							?>
							<tr>
								<th><?= $key+1 ?></th>
								<th><?= $value['Vino']['nombre'] ?></th>
								<th><?= $value['VinaVariedad']['nombre'] ?></th>
								<th><?= $value['VinaCepa']['nombre'] ?></th>
								<th><button class="btn btn-info">Ver descripciones</button></th>
								<th><?= $estado ?></th>
								<th>
									<?= $this->Html->link('<span class="fas fa-cog"></span>',	['action' => 'vinosEdit', $value['Vino']['id']],['escape' => false, 'class'=>'btn btn-warning']); ?>
									-
									<button class="btn btn-danger"><span class="fas fa-ban"></span></button>	
								</th>
							</tr>
						<?}
					}else{?>
						<tr>
							<td colspan="6" align="center">No hay registros</td>
								
						</tr>
					<?} ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="modal fade" id="addVino" tabindex="-1" role="dialog" aria-labelledby="addVinoTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= $this->Form->create('Vino', array('url' => array( 'controller' => 'Admines', 'action' => 'addVino'), 'class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="col-md-12"><h4 class="text-center">Nuevo Vino</h4></div>
					<div class="row">
						<div class="col-md-5">
							<div class="form-group">
								<?= $this->Form->input('nombre', array('class' => 'form-control', 'type'=>'text', 'placeholder'=>'Nombre')); ?>
							</div>
							<div class="form-group">
								<select class="form-control" name="data[Vino][cepa_id]">
									<option selected disabled>-->Cepa</option>
									<? foreach ($categorias['cepas'] as $key => $value) {?>									
										<option value="<?=$key?>"><?=$value?></option>
									<?} ?>
								</select>
							</div>		
							<div class="form-group">
								<select class="form-control" name="data[Vino][variedad_id]">
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