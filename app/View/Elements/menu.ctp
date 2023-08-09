<div class="row">
	<div class="large-3 medium-3 small-12 columns">
		<div id="logo">
			<?= $this->Html->image('logo.png', ['url'=>['controller'=>'Pages', 'action'=>'index']]); ?>
		</div>
	</div>
	<div class="large-9 medium-9 small-12 columns">
		<nav class="top-bar" data-topbar role="navigation">
			<ul class="title-area">
				<li class="name"> </li>
				<!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
				<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
			</ul>
			<section class="top-bar-section">
				<!-- Right Nav Section -->
				<ul class="right">
					<li class="<?= ($this->Html->menuActivo(array('controller' => 'Pages', 'action'=>'index')) ? 'active' : ''); ?>">
						<?= $this->Html->link('Inicio',	['controller' => 'Pages', 'action' => 'index'],['escape' => false, 'style'=>'font-size:15px;']); ?>
					</li>
					<li class="<?= ($this->Html->menuActivo(array('controller' => 'Pages', 'action'=>'nosotros')) ? 'active' : ''); ?>">
						<?= $this->Html->link('Nosotros', ['controller' => 'Pages', 'action' => 'nosotros'],['escape' => false, 'style'=>'font-size:15px;']); ?>		
					</li>
					<li class="<?= ($this->Html->menuActivo(array('controller' => 'Pages', 'action'=>'vinos')) ? 'active' : ''); ?>">
						<?= $this->Html->link('Vinos', ['controller' => 'Pages', 'action' => 'vinos'],['escape' => false, 'style'=>'font-size:15px;']); ?>
					</li>
					<li class="<?= ($this->Html->menuActivo(array('controller' => 'Pages', 'action'=>'galeria')) ? 'active' : ''); ?>">
						<?= $this->Html->link('Galeria',	['controller' => 'Pages', 'action' => 'galeria'],['escape' => false, 'style'=>'font-size:15px;']); ?>
					</li>
					<li class="<?= ($this->Html->menuActivo(array('controller' => 'Pages', 'action'=>'tienda')) ? 'active' : ''); ?>" id="primerNivel" >
						<?= $this->Html->link('Tienda',	['controller' => 'Pages', 'action' => 'tienda'],['escape' => false, 'style'=>'font-size:15px;']); ?>
						<div id="promo"><?= $this->Html->link('Promociones',	['controller' => 'Pages', 'action' => 'promociones'],['escape' => false, 'style'=>'font-size:15px;']); ?></div>
					</li>
					<li class="<?= ($this->Html->menuActivo(array('controller' => 'Pages', 'action'=>'tourDegustaciones')) ? 'active' : ''); ?>">
						<?= $this->Html->link('Tour y degustaciones',	['controller' => 'Pages', 'action' => 'tourDegustaciones'],['escape' => false, 'style'=>'font-size:15px;']); ?>
					</li> 
					<li class="<?= ($this->Html->menuActivo(array('controller' => 'Pages', 'action'=>'contacto')) ? 'active' : ''); ?>">
						<?= $this->Html->link('Contacto',	['controller' => 'Pages', 'action' => 'contacto'],['escape' => false, 'style'=>'font-size:15px;']); ?>
					</li>       
				</ul>
			</section>
		</nav>
	</div>
</div>

<style type="text/css">
	#promo a{
		font-weight: bold;
		float: left;
		margin-top: 10px;	
	}
	#promo{
		float: left;
		display: none;
	}
</style>
<script type="text/javascript">	
	document.getElementById("primerNivel").onmouseover = function() {mouseOver()};
	document.getElementById("primerNivel").onmouseout = function() {mouseOut()};
	function mouseOver() {
		$('#promo').show();
	}
	function mouseOut() {
		$('#promo').hide();
	}		
	
</script>