<div class="content-sec">
	<div class="row">
		<div class="large-12 columns text-center">
			<h2><?= $data['Contenido']['contenido'][0]['titulo'][$idioma][0] ?></h2>
			<p class="texto-justificado"><?= $data['Contenido']['contenido'][0]['contenido'][$idioma][0] ?></p>
		</div>
	</div>
</div> 
<? foreach ($data['Contenido']['contenido'][0]['contenido'][$idioma]['extras'] as $key => $value) {?>
	<div class="content-sec">
		<div class="row">
			<div class="large-12 columns">
				<h2><?= $value['titulo'] ?></h2>
				<p class="texto-justificado"><?= $value['bajada'] ?></p>
			</div>
		</div>
	</div> 
<?} ?>