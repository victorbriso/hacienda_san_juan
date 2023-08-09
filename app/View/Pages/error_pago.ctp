<div class="content-sec inner-sec">
	<div class="row">
		<div class="large-12 columns">
			<h4 class="text-center">Ocurrio un error en la transacción</h4>
			<?= $this->Html->link('Volver a la tienda', array('action' => 'tienda'), array('escape' => false, 'class'=>'button radius btn-azul text-center'));?>
			<?= $this->Html->link('Volver al carrito', array('action' => 'carrito'), array('escape' => false, 'class'=>'button radius btn-naranjo text-center'));?>
		</div>
	</div>
</div>