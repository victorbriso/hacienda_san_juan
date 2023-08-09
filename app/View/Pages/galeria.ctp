<div class="content-sec inner-sec">
	<div class="row">
		<? foreach ($imagenes as $key => $value) {?>			
			<div class="large-4 medium-4 small-12 columns img-mini">
				<div class="cont-img-galeria">
					<?= $this->Html->image('galeria/'.$value, ['class'=>'img-mini-thum', 'onclick'=>'verImagen(this);', 'id'=>$value]); ?>
				</div>	
			</div>	
		<?} ?>		
	</div>
</div>  
<div id="modalImg" class="modal">
	<div class="modal-content">
		<span class="close" onclick="cerrar()">&times;</span>
		<div id="contenedorImg" class="cont-img-galeria-grande"></div>
	</div>
</div>
<style type="text/css">
	.modal-content{
		margin-top: 10px;
		height: 95% !important;
		width: 100%;
	}
	.imgModalGrande{
		max-height: 90% !important;
	}
</style>
<script type="text/javascript">
	function verImagen(img){
		var path = img.id;
		var modal = document.getElementById("modalImg");
		document.getElementById('contenedorImg').innerHTML = '';
		var imgGrande='<img src="/img/galeria/'+path+'" class="imgModalGrande" style="max-height: 90% !important; width:auto !important;">';
		document.getElementById('contenedorImg').innerHTML = imgGrande;
		modal.style.display = "block";
	}
	function cerrar(){
		var modal = document.getElementById("modalImg");
		document.getElementById('contenedorImg').innerHTML = '';
		modal.style.display = "none";
	}
</script>
