<div class="col-md-12">
	<div class="row">
		<div class="col-md-12">
			<h4 class="text-center">Productos Descontinuados</h4>
		</div>
		<div class="col-md-12">
			<table id="productosDesc" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>#</th>
						<th>Producto</th>
						<th>Viña</th>
						<th>Año</th>
						<th>Precio</th>
						<th>Variedad</th>
						<th>Cepa</th>
						<th>Accion</th>
					</tr>
				</thead>
				<tbody>
					<? if(!empty($productos)){
						foreach ($productos as $key => $value) {?>
							<tr>
								<td><?= $key+1 ?></td>
								<td><?= $value['VinaProducto']['nombre'] ?></td>
								<td><?= $value['VinaVina']['nombre']; ?></td>
								<td><?= $value['VinaProducto']['anhio']; ?></td>
								<td>$<?= number_format($value['VinaProducto']['precio'], 0, ',', '.'); ?></td>
								<td><?= $value['VinaVariedad']['nombre']; ?></td>
								<td><?= $value['VinaCepa']['nombre']; ?></td>
								<td>
									<?= $this->Form->create('data', array('url' => array( 'controller' => 'Admines', 'action' => 'cambiaEstados'), 'class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
								    <?= $this->Form->input('tipo', array('class' => 'form-control', 'type'=>'hidden', 'value'=>'1')); ?>
								    <?= $this->Form->input('id', array('class' => 'form-control', 'type'=>'hidden', 'value'=>$value['VinaProducto']['id'])); ?>
								    <input type="submit" class="btn btn-success btn-block" autocomplete="off" data-loading-text="Espera un momento..." value="Habilitar" idform="BodegaAddForm" campoForm="addBodega" editForm="0">
								    <?= $this->Form->end(); ?>
								</td>
							</tr>
							
							<?}
						}else{?>
							<tr>
								<td colspan="8" class="text-center">
									No hay productos descontinuados
								</td>	
							</tr>							
					<?} ?>			
				</tbody>
			</table>			
		</div>
	</div>
		
</div>
<script type="text/javascript">
	$(document).ready(function() {
	    $('#productosDesc').DataTable();
	} );
</script>