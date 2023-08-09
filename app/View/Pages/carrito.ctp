<div class="content-sec inner-sec">
	<div class="row">
		<table width="100%" class="tabla-carrito">
			<thead>
				<tr>
					<th>#</th>
					<th>Producto</th>
					<th>Precio</th>
					<th>Cantidad</th>
					<th>Total</th>
					<th>Quitar</th>
				</tr>
			</thead>
			<tbody>
				<? if(!empty($carrito)){
					$iteral=0;
					foreach ($carrito as $key => $value) { $iteral++; ?>
						<tr>
							<td><?= $iteral ?></td>
							<td><?= $value['VinaProducto']['nombre'] ?></td>
							<td>$<?= number_format($value['VinaProducto']['precio'], 0, ',', '.'); ?></td>
							<td align="center">
								<table width="100%">
									<tr>
										<td><i class="fa fa-minus-square-o" aria-hidden="true" id="<?= $value['VinaProducto']['id'] ?>" onclick="quita(this)" ></i></td>
										<td id="cantidadProducto<?= $value['VinaProducto']['id'] ?>"><?= $value['VinaProducto']['cantidad'] ?></td>
										<td><i class="fa fa-plus-square-o" aria-hidden="true" id="<?= $value['VinaProducto']['id'] ?>" onclick="agrega(this)"></i></td>
									</tr>
								</table>																		
							</td>
							<td id="totalItem<?= $value['VinaProducto']['id'] ?>">$<?= number_format($value['VinaProducto']['precio']*$value['VinaProducto']['cantidad'], 0, ',', '.'); ?></td>
							<td>
								<?= $this->Html->link('<i class="fa fa-trash-o fa-lg"></i>', array('action' => 'eliminaProducto', $value['VinaProducto']['id']), array('escape' => false));?>
							</td>
						</tr>
					<?}?>
					<tr>
						<td colspan="5" style="text-align: right; font-weight: bold">Total</td>
						<td style="text-align: right; font-weight: bold" id="totalCarrito">$ <?= number_format($totalCarrito, 0, ',', '.') ?>.- </td>
					</tr>
				<?}else{?>
					<tr>
						<td colspan="6" align="center">No hay productos en el carrito</td>
					</tr>
				<?} ?>
			</tbody>
		</table>
		<div class="row">
			<div class="botonera-carrito">
				<?= $this->Html->link('Finalizar compra', array('action' => 'finalizar'), array('escape' => false, 'class'=>'button radius btn-verde'));?>
			</div>			
			<div class="botonera-carrito">
				<?= $this->Html->link('Volver a la tienda', array('action' => 'tienda'), array('escape' => false, 'class'=>'button radius btn-azul'));?>
			</div>
			<div class="botonera-carrito">
				<?= $this->Html->link('Vaciar Carrito', array('action' => 'vaciarCarrito'), array('escape' => false, 'class'=>'button radius btn-naranjo'));?>
			</div>			
		</div>
	</div>
</div>
<script type="text/javascript">
	function quita(data){
		$.ajax({
            type: 'POST',
            url: 'restaProducto',
            data            : {
                id           : data.id
            },
            success: function (result) {
            	var dataResult = JSON.parse(result);
            	var cantidad= dataResult.cantidad;
            	var subTotal= parseInt(dataResult.subttl);
            	var total=parseInt(dataResult.total);  
                document.getElementById('cantidadProducto'+data.id).innerHTML = cantidad;
                document.getElementById('totalItem'+data.id).innerHTML = '$' + subTotal;
                document.getElementById('totalCarrito').innerHTML = '$' + total;
            }
        }); 
	}
	function agrega(data){
		$.ajax({
            type: 'POST',
            url: 'sumaProducto',
            data            : {
                id           : data.id
            },
            success: function (result) {
            	var dataResult = JSON.parse(result);
            	var cantidad= dataResult.cantidad;
            	var subTotal= parseInt(dataResult.subttl);
            	var total=parseInt(dataResult.total);          
                document.getElementById('cantidadProducto'+data.id).innerHTML = cantidad;
                document.getElementById('totalItem'+data.id).innerHTML = '$' + subTotal;
                document.getElementById('totalCarrito').innerHTML = '$' + total;
            }
        }); 
	}
</script>