<div class="inner-banner">
	<?= $this->Html->image('about-banner.jpg'); ?>
</div>

<div class="content-sec inner-sec">
	<div class="row">
		<div class="large-12 columns">
			<h2>Contacto</h2>
			<p>Escríbenos, te contactaremos a la brevedad</p>
		</div>
		<div class="clearfix"></div>
		<form action="#" class="frm">
			<div class="large-6 medium-6 small-12 columns">
				<input name="" placeholder="Nombre" type="text" class="radius" id="nombre">
				<p class="nombre" style="color: red; display: none;">Debes ingresar tu nombre</p>
			</div>
			<div class="large-6 medium-6 small-12 columns">
				<input name="" placeholder="Email" type="text" class="radius" id="mail">
				<p class="mail" style="color: red; display: none;">Debes ingresar tu mail</p>
			</div>
			<div class="large-6 medium-6 small-12 columns">
				<input name="" placeholder="Teléfono" type="text" class="radius" id="fono">
			</div>
			<div class="large-6 medium-6 small-12 columns">
				<input name="" placeholder="Asunto" type="text" class="radius" id="asunto">
			</div>
			<div class="large-12 columns">
				<textarea placeholder="Mensaje" class="radius" id="mensaje"></textarea>
				<p class="mensaje" style="color: red; display: none;">Debes ingresar un mensaje</p>
				<p class="mensajeEnviado" style="color: green; display: none;">Tú mensaje fue enviado, pronto nos pondremos en contacto</p>
				<p class="mensajeError" style="color: red; display: none;">Ocurrio un error al anviar tú mensaje, favor intentar nuevamente/p>
			</div>
			<div class="large-12 columns">
				<button type="button" class="button round" onclick="enviar();">Enviar</button>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">
	function enviar(){
		$('.nombre').hide();
		$('.mail').hide();
		$('.mensaje').hide();
		var nombre 		= 	$('#nombre').val();
		var mail 		=	$('#mail').val();
		var fono 		= 	$('#fono').val();
		var asunto 		=	$('#asunto').val();
		var mensaje 	=  	$('#mensaje').val();
		if(nombre.lenght < 1){
			$('.nombre').show();
			var valNombre = false;
		}else{
			var valNombre = true;
		}
		if(mail.lenght < 5){
			$('.mail').show();
			var valMail = false;
		}else{
			var valMail = true;
		}
		if(mensaje.lenght < 1){
			$('.mensaje').show();
			var valMensaje = false;
		}else{
			var valMensaje = true;
		}
		if(valMensaje && valMail && valNombre){
			$.ajax({
	            type: 'POST',
	            url: 'contacto',
	            data            : {
	                nombre		: 	nombre,
					mail		: 	mail,
					fono		: 	fono,
					asunto		: 	asunto,
					mensaje		: 	mensaje
	            },
	            success: function (result) {
	            	if(result==3){
	            		$('.mensajeEnviado').show();
	            	}else{
	            		$('.mensajeError').show();
	            	}
	            	if(result==2){
	            		$('.mensajeError').show();
	            	}	            	
	            }
	        }); 	
		}		
	}
</script>