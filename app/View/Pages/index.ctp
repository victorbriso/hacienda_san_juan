<div class="slider-sec">
	<div class="slider single-item">
		<div>
			<?= $this->Html->image('slide1.jpg'); ?>
		</div>
		<div>
			<?= $this->Html->image('slide2.jpg'); ?>
		</div>
		<div>
			<?= $this->Html->image('slide3.jpg'); ?>
		</div>
	</div>
	<!--
	<div class="row">
		<div class="large-12 columns no-pad">
			<div class="banner-txt">
				<a href="#" class="button round">Visitar tienda</a>
			</div>
		</div>
	</div>
	-->
	          
</div>
<div class="content-sec">
	<div class="row">
		<div class="large-12 columns text-center">
			<h2>Viña Hacienda San Juan</h2>
			<p>Viña boutique que, desde su plantación en 2012, cultiva uvas bajo procesos orgánicos y biodinámicos, obteniendo vinos costeros de  alta gama y personalidad única, en completa armonía con el medioambiente y el trabajo vitivinícola.<br>Sus cepas Pinot Noir, Syrah y Chardonnay, expresan las excepcionales características geográcas que entrega terroir de San Juan, ubicado en valle de San Antonio-Leyda.</p>
			<?= $this->Html->link('Ver más', ['controller' => 'RegistroLocales', 'action' => 'dashboard'],['escape' => false, 'class'=>'button round grey']); ?>
		</div>
	</div>
</div> 
<script type="text/javascript">
	$('.single-item').slick();
</script>  