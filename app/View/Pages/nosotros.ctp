<? foreach ($data['Contenido']['contenido'] as $key => $value) {?>
	<div class="content-sec">
		<div class="row">
			<div class="large-12 columns text-center">
				<h2><?= $value['titulo'][$idioma] ?></h2>
				<p class="texto-justificado"><?= $value['contenido'][$idioma] ?></p>
			</div>
		</div>
	</div> 
<?} ?>