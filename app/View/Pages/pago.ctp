<div class="content-sec inner-sec">
	<div class="row">
		<div class="large-12 columns">
			<div class="large-4 columns">
				<div class="row">
					<h4 style="text-align: center;">Resumen de compra</h4>
					<table width="100%" class="tabla-carrito">
						<thead>
							<tr>
								<th>#</th>
								<th>Producto</th>
								<th>Precio</th>
								<th>Cant.</th>
								<th>Total</th>
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
										<td align="center"><?= $value['VinaProducto']['cantidad'] ?></td>
										<td id="totalItem<?= $value['VinaProducto']['id'] ?>">$<?= number_format($value['VinaProducto']['precio']*$value['VinaProducto']['cantidad'], 0, ',', '.'); ?></td>
									</tr>
								<?}?>
								<tr>
									<td colspan="3" style="text-align: right; font-weight: bold">Total</td>
									<td colspan="2" style="text-align: right; font-weight: bold" id="totalCarrito">$ <?= number_format($totalCarrito, 0, ',', '.') ?>.- </td>
								</tr>
							<?}else{?>
								<tr>
									<td colspan="5" align="center">No hay productos en el carrito</td>
								</tr>
							<?} ?>
						</tbody>
					</table>	
				</div>
				
			</div>
			<div class="large-4 columns" id="contenedor-direcciones">
				<h4 style="text-align: center;">Forma de entrega</h4>
				<select name="direcciones" id="selectDireccion">
					<option selected="" disabled="" value="n-n">--Seleccione</option>
					<option region="r" comuna="t">Retiro en tienda</option>
					<? foreach ($direcciones as $key => $value) { if(!$value[3]){continue;}
						$region=explode('-', $value[0]);
						$comuna=explode('-', $value[1]);
					 ?>
						<option region="<?=$region[0]?>" comuna="<?=$comuna[0]?>" direccion="<?=$value[2]?>"><?=$value[2]?>-<?=$comuna[1]?>-<?=$region[1]?></option>
					<?} ?>
				</select>			
			</div>
			<div class="large-4 columns">
				<h4 style="text-align: center;">Forma de pago</h4>
				<table width="100%">
					<tr>
						<th style="text-align: center;">Sub Total</th>
					</tr>
					<tr>
						<td style="text-align: center;">$ <?= number_format($totalCarrito, 0, ',', '.') ?>.-</td>
					</tr>
					<tr>
						<th style="text-align: center;">
							Despacho 
							<input type="hidden" id="cantidadProductos" value="<?=$totalProductos?>">
							<input type="hidden" id="totalCarroCalculos" value="<?=$totalCarrito?>"> 
							<input type="hidden" id="totalAPagar" value="<?=$totalCarrito?>">  
							<input type="hidden" id="region" value="0">  
							<input type="hidden" id="comuna" value="0">  
							<input type="hidden" id="txtDireccion" value="0">
							<input type="hidden" id="montoValorDespacho" value="0">   
						</th>
					</tr>
					<tr>
						<td style="text-align: center;" id="valorDespacho">0</td>
					</tr>
					<tr>
						<th style="text-align: center;">Total</th>
					</tr>
					<tr>
						<td style="text-align: center;" align="center" id="totalGeneral">$<?= number_format($totalCarrito, 0, ',', '.') ?>.-</td>
					</tr>
					<tr>
						<td style="text-align: center;">
							<button class="button radius" onclick="pago();">Pagar por transferencia</button>
							<p style="display: none;" id="txtFinTransf">Te enviamos un mail con el detalle de la compra y los datos de transferencia. En 2 segundos serás enviado al inicio</p>
							<p style="display: none;" id="errorTransf">Ocurrio un error al procesar el pedido</p>
						</td>
					</tr>
					<tr>
						<td style="text-align: center;">
							<button class="button radius btn-naranjo" onclick="pagoWebPay();">Pagar por WebPay</button>
							<p style="display: none;" id="errorWebPay">Ocurrio un error al procesar el pedido</p>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
<div style="display: none;" id="formWebPay">
	
</div>
<script type="text/javascript">
	$(document).ready(function(){
        $('#contenedor-direcciones').on('change', '#selectDireccion', function(event){
			event.preventDefault();
			var region 			=	$('option:selected', this).attr('region');
			var comuna 			=	$('option:selected', this).attr('comuna');
			var txtDireccion 	=	$('option:selected', this).attr('direccion');
			$('#region').val(region);
			$('#comuna').val(comuna);
			$('#txtDireccion').val(txtDireccion);
            var textDespacho = 'El envío será realizado por pagar';
            var productos = $('#cantidadProductos').val();
            var montoCalculos = parseInt($('#totalCarroCalculos').val());
            if(region==4){
            	if(comuna==28){            		
            		if(productos>=3){
            			montoDepacho=0;
            		}else{
            			montoDepacho=5000;
            		}
            		document.getElementById("valorDespacho").innerHTML=montoDepacho;
            		var pago=montoDepacho+montoCalculos;
            		document.getElementById("totalGeneral").innerHTML= new Intl.NumberFormat("es-CL", {style: "currency", currency: "CLP"}).format(pago) +'.-';
            		$('#totalAPagar').val(pago);
            		$('#montoValorDespacho').val(montoDepacho);
            	}else if(comuna==32){
            		if(productos>=3){
            			montoDepacho=0;
            		}else{
            			montoDepacho=5000;
            		}
            		document.getElementById("valorDespacho").innerHTML=montoDepacho;
            		var pago=montoDepacho+montoCalculos;
            		document.getElementById("totalGeneral").innerHTML= new Intl.NumberFormat("es-CL", {style: "currency", currency: "CLP"}).format(pago) +'.-';
            		$('#totalAPagar').val(pago);
            		$('#montoValorDespacho').val(montoDepacho);
            	}else{
            		document.getElementById("valorDespacho").innerHTML=textDespacho;
            	}
            }else if(region==11){
            	if(
            		comuna==1 || 
            		comuna==2 || 
            		comuna==3 ||
            		comuna==6 ||
					comuna==7 ||
					comuna==8 ||
					comuna==9 ||
					comuna==10 ||
					comuna==11 ||
					comuna==13 ||
					comuna==14 ||
					comuna==15 ||
					comuna==16 ||
					comuna==17 ||
					comuna==18 ||
					comuna==19 ||
					comuna==20 ||
					comuna==21 ||
					comuna==22 ||
					comuna==23 ||
					comuna==24 ||
					comuna==26 ||
					comuna==27 ||
					comuna==28 ||
					comuna==29 ||
					comuna==30 ||
					comuna==31 ||
					comuna==32 ||
					comuna==33
            		){
            		if(productos>=3){
            			montoDepacho=0;
            		}else{
            			montoDepacho=5000;
            		}
            		document.getElementById("valorDespacho").innerHTML=montoDepacho;
            		var pago=montoDepacho+montoCalculos;
            		document.getElementById("totalGeneral").innerHTML= new Intl.NumberFormat("es-CL", {style: "currency", currency: "CLP"}).format(pago) +'.-';
            		$('#montoValorDespacho').val(montoDepacho);
            	}else{
            		document.getElementById("valorDespacho").innerHTML=textDespacho;
            	}
            }else if(region=='r' && comuna=='t'){
            	document.getElementById("valorDespacho").innerHTML='Tienda en San Juan, <a href="https://www.google.cl/maps/place/Hacienda+San+Juan/@-33.6385845,-71.5645827,17z/data=!3m1!4b1!4m5!3m4!1s0x96624805c95e0629:0x836657586bf7b0b4!8m2!3d-33.6385845!4d-71.562394" target="_blanc">ver mapa</a>';
            }else if(region!='r'){
            	if(region!=4 || region!=11){
	            	document.getElementById("valorDespacho").innerHTML=textDespacho;
	            }
            }
		});
	});
	function pago(){
		var montoPago = $('#totalAPagar').val();
		var region 	  =	$('#region').val();
		var comuna    =	$('#comuna').val();
		var direccion =	$('#txtDireccion').val();
		var despacho  =	$('#montoValorDespacho').val();
		$.ajax({
            type: 'POST',
            url: 'pagoTransferencia',
            data            : {
                monto       : montoPago,
                region 		: region,
                comuna 		: comuna,
                direccion   : direccion,
                despacho 	: despacho

            },
            success: function (result) {
            	console.log(result);
            	if(result==3){
					$('#txtFinTransf').show();
					setTimeout(function(){ location.href='tienda'; }, 2000);					
            	}else{
            		$('#errorTransf').show();
            	}
            },
            error: function (result){
                console.log(result);
            }
        }); 
	}
	function pagoWebPay(){
		var montoPago = $('#totalAPagar').val();
		var region 	  =	$('#region').val();
		var comuna    =	$('#comuna').val();
		var direccion =	$('#txtDireccion').val();
		var despacho  =	$('#montoValorDespacho').val();
		$.ajax({
            type: 'POST',
            url: '/Pagos/pay',
            data            : {
                monto       : montoPago,
                region 		: region,
                comuna 		: comuna,
                direccion   : direccion,
                despacho 	: despacho
            },
            success: function (result) {
            	console.log(result);
            	var respuesta = JSON.parse(result);
            	console.log(respuesta);
            	var destino = respuesta.formAction;
            	var tokenWS = respuesta.tokenWs;formWebPay
            	var formulario = '<form name="pagofinalWP" method="post" action="'+destino+'"><input type="hidden" name="token_ws" value="'+tokenWS+'"></form>';
            	document.getElementById("formWebPay").innerHTML= formulario;
            	setTimeout(function(){
            		document.pagofinalWP.submit()
				}, 500);
            },
            error: function (result){
                $('#errorWebPay').show();
            }
        }); 
	}
</script>
