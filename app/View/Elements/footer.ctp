<div class="newsletter">
	<div class="row">
		<div class="large-12 columns">
			<h2 class="white">Suscribete al newsletter</h2>
			<p>Mantente informado de las noticias.</p>
		</div>
		<div class="large-2 medium-2 columns hide-for-small">&nbsp;</div>
		<div class="large-8 medium-8 small-12 columns">
			<form>
				<div class="large-12">
					<div class="row">
						<div class="large-6 columns">
							<input placeholder="E-Mail" class="radius" type="text" id="mailSuscripcion">
						</div>
						<div class="large-6 columns">
							<button class="button radius" type="button" onclick="suscripcion();">suscribeme</button>
						</div>
						<div class="large-12 columns">
							<p class="exitoSuscripcion" style="color: green; display: none;">Te has suscrito con exito</p>
							<p class="fracasoSuscripcion" style="color: red; display: none;">Ocurrio un error favor volver a intentar</p>
						</div>
					</div>	
				</div>		
			</form>
		</div>
		<div class="large-2 medium-2 columns hide-for-small">&nbsp;</div>
	</div>
</div>
<div class="footer-sec">
	<div class="row">
		<div class="large-3 medium-3 small-12 columns">
			<div class="foot-1">
				<h4>accesos rápidos</h4>
				<ul>
					<li>
						<?= $this->Html->link('Inicio',	['controller' => 'Pages', 'action' => 'index'],['escape' => false]); ?>
					</li>
					<li>
						<?= $this->Html->link('Nosotros', ['controller' => 'Pages', 'action' => 'nosotros'],['escape' => false]); ?>		
					</li>
					<li>
						<?= $this->Html->link('Vinos', ['controller' => 'Pages', 'action' => 'vinos'],['escape' => false]); ?>
					</li>
					<li>
						<?= $this->Html->link('Galeria',	['controller' => 'Pages', 'action' => 'galeria'],['escape' => false]); ?>
					</li>
					<li>
						<?= $this->Html->link('Tienda',	['controller' => 'Pages', 'action' => 'tienda'],['escape' => false]); ?>
					</li>
					<li>
						<?= $this->Html->link('Tour y degustaciones',	['controller' => 'Pages', 'action' => 'contacto'],['escape' => false]); ?>
					</li> 
					<li>
						<?= $this->Html->link('Contacto',	['controller' => 'Pages', 'action' => 'contacto'],['escape' => false]); ?>
					</li>    
				</ul>
			</div>
		</div>
		<div class="large-3 medium-3 small-12 columns">
			<div class="foot-1">
				<h4>Vinos</h4>
				<ul>
					<li>
						<?= $this->Html->link('Pinot Noir',	['controller' => 'Pages', 'action' => 'vinos'],['escape' => false]); ?>
					</li>  
					<li>
						<?= $this->Html->link('Syrah',	['controller' => 'Pages', 'action' => 'vinos'],['escape' => false]); ?>
					</li>  
					<li>
						<?= $this->Html->link('Sauvignon Blanc',	['controller' => 'Pages', 'action' => 'vinos'],['escape' => false]); ?>
					</li>  
				</ul>
			</div>
		</div>
		<div class="large-4 medium-3 small-12 columns">
			<div class="foot-1">
				<h4>Oficina</h4>
				<p>Dr. Sotero del Rio 508 of 1029, Santiago<br>+562 2662 1007</p>
				<h4>Viñedo</h4>
				<p>Camino Leyda-Santo Domingo, kilometro 11</p>
				<ul>
					<li><a href="mailto:info@companyname.com" target="_blank">contacto@haciendasanjuan.cl</a></li>
					<li><a href="tel:+56226621007" target="_blank">+562 2662 1007</a></li>
				</ul>
			</div>
		</div>
		<div class="large-2 medium-3 small-12 columns">
			<div class="foot-1">
				
				<h4>Encuentranos en</h4>
				<div class="social">
					<div class="facebook">
						<a href="#" class="facebook"></a>
					</div>
					<div class="twitter">
						<a href="#" class="twitter"></a>
					</div>
					<div class="gplus">
						<a href="#" class="gplus"></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="copy">
	<div class="row">
		<div class="large-12 columns">
			Copyright &copy; 2020 Hacienda San Juan. Todos los derechos reservados. Sitio realizado por <a href="https://vbstechnology.cl" target="_blank">VBS Technology</a>.
		</div>
	</div>
</div>
<script type="text/javascript">
	function suscripcion(){
		var mail = $('#mailSuscripcion').val();
		$.ajax({
            type: 'POST',
            url: '/Pages/newsLetter',
            data            : {
                mail         : mail
            },
            success: function (result) {
            	if(result==1){
            		$('.exitoSuscripcion').show();
            		setTimeout(function(){ $('.exitoSuscripcion').hide(); }, 1500);
            	}
            	if(result==2){
            		$('.fracasoSuscripcion').show();
            		setTimeout(function(){ $('.fracasoSuscripcion').hide(); }, 1500);
            	}
            },
            error: function (result){
                $('.fracasoSuscripcion').show();
            	setTimeout(function(){ $('.fracasoSuscripcion').hide(); }, 1500);
            }
        }); 
	}
</script>