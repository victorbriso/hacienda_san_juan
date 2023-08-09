<?php
if($output['responseCode']==0){
	if($output['paymentTypeCode']=='VD'){
		$tipo_transaccion='Aprobado Venta debito';		
	}elseif($output['paymentTypeCode']=='VN'){
		$tipo_transaccion='Aprobado Venta normal';		
	}
	elseif($output['paymentTypeCode']=='VC'){
		$tipo_transaccion='Aprobado Venta en cuotas';		
	}
	elseif($output['paymentTypeCode']=='S1'){
		$tipo_transaccion='Aprobado 3 cuotas sin interés';		
	}
	elseif($output['paymentTypeCode']=='S2'){
		$tipo_transaccion='Aprobado 2 cuotas in interés';		
	}
	elseif($output['paymentTypeCode']=='NC'){
		$tipo_transaccion='Aprobado N cuotas sin interés';		
	}
	$respuesta= "Transacción Aprobada";
}elseif($output['responseCode']==1){
	$respuesta= "Rechazo de la transacción";
	$tipo_transaccion='Transacción rechazada';	
}elseif($output['responseCode']==2){
	$respuesta= "Transacción debe reintentarse";
	$tipo_transaccion='Transacción rechazada';	
}elseif($output['responseCode']==3){
	$respuesta= "Error de transacción";
	$tipo_transaccion='Transacción rechazada';	
}elseif($output['responseCode']==4){
	$respuesta= "Rechazo de la transacción";
	$tipo_transaccion='Transacción rechazada';	
}elseif($output['responseCode']==5){
	$respuesta= "rechazo por error de la tasa";
	$tipo_transaccion='Transacción rechazada';	
}elseif($output['responseCode']==6){
	$respuesta= "Excede cupo máximo menual";
	$tipo_transaccion='Transacción rechazada';	
}elseif($output['responseCode']==7){
	$respuesta= "Excede limite diario";
	$tipo_transaccion='Transacción rechazada';	
}elseif($output['responseCode']==8){
	$respuesta= "Rubro no autorizado";
	$tipo_transaccion='Transacción rechazada';	
}else{
	$respuesta= "ERROR GENERAL";
	$tipo_transaccion='Transacción rechazada';	
}

?>
<div class="content-sec inner-sec">
	<div class="row">
		<div class="large-12 columns">
			<h4 class="text-center">Datos de la transacción</h4>
			<table>
				<tr>
					<td colspan=2>Detalle de transacción</td>
				</tr>
				<tr>
					<td>Tipo de transacción</td>
					<td><?php echo $tipo_transaccion; ?></td>
				</tr>
				<tr>
					<td>Código de autorización</td>
					<td><?php echo $output['authorizationCode']; ?></td>
				</tr>
				<tr>
					<td>Estado</td>
					<td><?php echo $respuesta; ?></td>
				</tr>
				<tr>
					<td>Orden de compra</td>
					<td><?php echo $output['buyOrder']; ?></td>
				</tr>
				<tr>
					<td>Fecha y hora de transacción</td>
					<td><?php echo $result['transactionDate']; ?></td>
				</tr>
			</table>
		</div>
	</div>
</div>