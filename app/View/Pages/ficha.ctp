<?
	if($lang=='es'){
		$descripcion=$producto['Vino']['desc_es'];
		$volver='Volver atrás';
	}elseif ($lang=='en') {
		$descripcion=$producto['Vino']['desc_en'];
		$volver='Back';
	}else{
		$descripcion=$producto['Vino']['desc_es'];
		$volver='Volver atrás';
	}

?>

<div class="content-sec inner-sec">
	<div class="row">
		<div class="large-12 columns">
			<div class="separacion-vinos-nuestros"> 
				<h4><?= $producto['Vino']['nombre'] ?></h4>
			</div>
			<div class="separacion"></div> 
			<div class="large-6 columns cont-img-mis-vinos">
            	<?= $this->Html->image('misVinos/'.$producto['Vino']['path_img'], ['class'=>'img-mis-vinos']); ?>
            </div>
			<div class="large-6 columns">
				<div class="large-6 columns">
					<table>
						<thead>
							<tr>
								<th colspan="2" align="center">Caracteristicas técnicas</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Denominación de origen</td>
								<td></td>
							</tr>
							<tr>
								<td>Color</td>
								<td></td>
							</tr>
							<tr>
								<td>Tipo</td>
								<td></td>
							</tr>
							<tr>
								<td>Tipo de uva</td>
								<td></td>
							</tr>
							<tr>
								<td>Alcohol</td>
								<td></td>
							</tr>
							<tr>
								<td>PH / Acidez</td>
								<td></td>
							</tr>
							<tr>
								<td>Azucar residual</td>
								<td></td>
							</tr>
							<tr>
								<td>SO2 total</td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="large-6 columns">
					<table>
						<thead>
							<tr>
								<td colspan="2">Caracteristicas del viñedo</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Suelo</td>
								<td></td>
							</tr>
							<tr>
								<td>Elaboración</td>
								<td></td>
							</tr>
							<tr>
								<td>Crianza</td>
								<td></td>
							</tr>
						</tbody>
					</table>	
				</div>
				
				
			</div>
			<div class="large-12 columns" style="text-align: right;"><a href="javascript: history.go(-1)" class="button radius"><?=$volver?></a></div>
		</div>
	</div>
</div>