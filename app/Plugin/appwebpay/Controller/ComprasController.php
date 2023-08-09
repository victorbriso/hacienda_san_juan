<?php
App::uses('AppController', 'Controller');
class ComprasController extends AppController
{
	public function index()
	{
		debug( $this->Session->read('Webpay') );
	}

	/**
	* FUNCIONES PARA ONECLICK
	*/

	/**
	* Función para ingresar a un usuario en Oneclick
	*/
	public function inscripcionOneclick(){

		if ($this->request->is('post') && !empty($this->request->data['TBK_TOKEN']) )
		{
			try
			{
				$usuario = $this->Oneclick->finishInscripcion($this->request->data['TBK_TOKEN']);
			}
			catch ( Exception $e )
			{
				prx($e->getMessage());
			}

			debug($usuario);
			exit;
		}

		/**
		* Se obtienen los datos para iniciar la transacción
		*/
		if($this->request->is('post')){
			$username		= $this->request->data['username'];
			$email			= $this->request->data['email'];
			$responseURL	= Router::url(array('controller' => 'compras', 'action' => 'inscripcionOneclick'), true);
			try
			{
				$this->Oneclick->initInscripcion($username, $email, $responseURL);
			}
			catch ( Exception $e )
			{
				prx($e->getMessage());
			}
		}

	}

	/**
	* Función para dar de baja a un usuario que ya esta inscrito en Oneclick
	*/
	public function bajaOneclick(){
		if($this->request->is('post')){
			try
			{
				/**
				* Se envía el token de usuario que envia Transbank y el username del usuario
				*/
				$baja = $this->Oneclick->removeUser($this->request->data['TBK_USER'], $this->request->data['username']);
			}
			catch ( Exception $e )
			{
				prx($e->getMessage());
			}

			debug($baja);
			exit;
		}
	}

	/**
	* Funcion para realizar un pago en Oneclick
	*/
	public function pagoOneclick(){
		if ( $this->request->is('post') )
		{
			try
			{
				/**
				* monto 	Contiene el monto de la compra
				* oc 		Contiene el número de la Orden de Compra
				* TBK_USER	Contiene el token del usuario entregado por Transbank cuando este se inscribe
				* username 	Contiene el username que tiene el usuario en Transbank
				*/
				$pago = $this->Oneclick->authorize(
					$this->request->data['monto'],
					$this->request->data['oc'],
					$this->request->data['TBK_USER'],
					$this->request->data['username']
				);
			}
			catch ( Exception $e )
			{
				prx($e->getMessage());
			}

			debug($pago);
			exit;
		}
	}

	/**
	* Funcion para reversar un pago en Oneclick
	*/
	public function reversarOneclick(){
		if ( $this->request->is('post') )
		{
			try
			{
				/**
				* Se envía el número de Orden de Compra a reversar
				*/
				$reversa = $this->Oneclick->codeReverseOneClick($this->request->data['oc']);
			}
			catch ( Exception $e )
			{
				prx($e->getMessage());
			}

			debug($reversa);
			exit;
		}
	}

	/**
	* END FUNCIONES PARA ONECLICK
	*/


	/**
	* FUNCIONES PARA PAGO SIMULTANEO
	*/


	/**
	* Función en la cual se inicia la comunicacion con transbank haciendo uso de
	* initTransaccion
	*/
	public function compraPagoSimultaneo(){
		/**
		* Si ya se ingreso el monto a pagar se procede a iniciar el proceso
		*/
		if($this->request->is('post')){
			/**
			 * Se da inicio al proceso initTrancaction().
			 */
			/**
			* $tipoTransaccion 	Especifica que se hará el proceso de pago simultaneo, siempre es TR_NORMAL_WS
			* $idComercio 		Contiene el id de comercio que entrega transbank
			* $sesionId 		No se utilizará
			* $ordenCompra 		Es generado siguiendo el formato YYYYmmddHHmmssabc en donde a, b y c son numeros aleatorios
			* $urlRetorno 		Indica a que URL redirige transbank luego de autorizar la compra
			* $urlFinal 		Indica a que URL redirije transbank luego de que se realiza el pago
			* $codigoComercio 	Contiene el id de comercio que entrega transbank
			* $monto 			Contiene el monto a pagar por el usuario
			*/
			$tipoTransaccion		= 'TR_NORMAL_WS';
			$idComercio 			= '597034043612';
			$ordenCompra 			= date('Y').date('m').date('d').date('H').date('i').date('s').rand(0,9).rand(0,9).rand(0,9);
			$sesionId				= '5';
			$urlRetorno				= Router::url(array('controller' => 'compras', 'action' => 'responsePagoSimultaneo'), true);
			$urlFinal 				= Router::url(array('controller' => 'compras', 'action' => 'pagoRealizado'), true);
			$codigoComercio 		= '597034043612';
			$monto 					= $this->request->data['monto'];

			/**
			* Se guarda la oc en sesion para luego poder compararla con la respuesta de transbank
			*/
			$this->Session->write("OC", $ordenCompra);

			try{
				/**
				* Se hace la llamada del initTransaccion, a esta función se le pasan los parametros definidos anteriormente
				*/
				$this->PagoSimultaneo->initTransaccion( $tipoTransaccion, $idComercio, $ordenCompra, $sesionId, $urlRetorno, $urlFinal, $codigoComercio, $monto );
			}
			catch ( Exception $e )
			{
				/**
				* En caso de que ocurra un error se redirecciona al usuario a la función de rechazo
				*/
prx($e);
				$this->redirect( array('action' => 'pagoRechazado') );
			}
		}
	}

	/**
	* Función en la cual se recibe la respuesta de autorización Transbank con el token de
	* transacción para evaluar si se aprueba o no en nuestro sistema
	*/
	public function responsePagoSimultaneo(){
		if ($this->request->is('post')) {
			if (isset($this->request->data['token_ws'])) {
				try {
					/**
					* Se obtiene el resultado de la transacción y se guarda en sesión
					*/
					$estadoTransaccion = $this->PagoSimultaneo->getTransaccionResult($this->request->data['token_ws']);
					$this->Session->write("estadoTransaccion", $estadoTransaccion);

				} catch (Exception $e) {
					/**
					* Si ocurre un error se redirecciona a la pantalla de rechazo
					*/
					$this->redirect(array('controller' => 'compras', 'action' => 'pagoRechazado'));
				}

				/**
				* Estados de Compra:
				*  0 : Aprobada
				* -1 : Rechazo transacción
				* -2 : Transacción debe reintentarse
				* -3 : Error en transacción
				* -4 : Rechazo transacción
				* -5 : Rechazo por error de tasa
				* -6 : Excede cupo máximo mensual
				* -7 : Excede límite diario por transación
				* -8 : Rubro no autorizado
				*/

				if (isset($estadoTransaccion['tbk_respuesta'])){
					if ($estadoTransaccion['tbk_respuesta'] == 0) {
						/**
						* Se valida si la Orden de compra no esta repetida
						*/
						if ($this->validarDuplicada($estadoTransaccion)){
							/**
							* Se realizan validaciones internas del sistema
							*/
							if($this->validarDatos($estadoTransaccion)){
								/**
								* Si se pasaron las validaciones se procede a finalizar la compra
								*/
								if(is_object($this->PagoSimultaneo->acknowledgeTransaccion($this->Session->read('token')))){
									/**
									* Se procede a guardar los datos de la compra y se muestra el comprobante de la compra
									*/
									$this->layout = 'ajax';
									$this->set(compact('estadoTransaccion'));
								}
							}else{
								/**
								* Si se no pasaron las validaciones por parte del comercio se redirecciona a pagina de
								* pago rechazado (Por parte del comercio deberia cambiarse el estado de la compra)
								*/
								$this->redirect(array('controller' => 'compras', 'action' => 'pagoRechazado'));
							}
						}else{
							/**
							* Ocurre un error debido a que la Orden de Compra esta en la base de datos y se encuentra pagada
							* (Por parte del comercio deberia cambiarse el estado de la compra)
							*/
							$this->redirect(array('controller' => 'compras', 'action' => 'pagoRechazado'));
						}
					}
				}else{
					/**
					* Se le informa a Transbank que se recibio respuesta
					*/
					$acknowledgeTransaccion = $this->PagoSimultaneo->acknowledgeTransaccion($this->Session->read('token'));

					if ( $estadoTransaccion != 0 ) {

						/**
						* Se redirecciona a la pagina de pago rechazado
						*/
						$this->redirect(array('controller' => 'compras', 'action' => 'pagoRechazado'));
					}
				}
			}else{
				/**
				* Si no se recibe el token se redirecciona a la pagina de pago rechazado
				*/
				$this->redirect(array('controller' => 'compras', 'action' => 'pagoRechazado'));
			}

		}
	}

	/**
	* Se verifica que la Orden de Compra no tenga un estado de pagada en la base de datos
	* @param $data array con la información de la transacción que retorna Transbank
	*/
	public function validarDuplicada($data = null){
		// Aplicar codigo de validacion segun sea el caso
		return true;
	}

	/**
	* Se verifica que la información retornada desde Transbank sea la misma que se envió.
	* @param $data array con la información de la transacción retornada por Transbank
	*/
	public function validarDatos($data = null){
		// Aplicar codigo de validacion segun sea el caso
		return true;
	}

	/**
	* Función que dirige a la vista de pago realizado
	*/
	public function pagoRealizado(){

		if ($this->request->is('post')  && empty($this->request->data['TBK_ORDEN_COMPRA'] ) ) {
			try {
				$estadoTransaccion = $this->Session->read('estadoTransaccion');
				$this->set(compact('estadoTransaccion'));
			} catch (Exception $e) {
				/**
				* Si hay error se redirecciona a la vista de pago rechazado
				*/
				$this->redirect(array('controller' => 'compras', 'action' => 'pagoRechazado'));
			}
		}else{
			/**
			* Si $this->request->data['TBK_ORDEN_COMPRA'] no es vacío y la llamada a
			* getTransaccionResult genera una excepción se redirige a función de pago rechazado
			*/
			try {
				$estadoTransaccion = $this->PagoSimultaneo->getTransaccionResult($this->request->data['TBK_TOKEN']);
			}catch (Exception $e) {
				$this->redirect(array('controller' => 'compras', 'action' => 'pagoRechazado'));
			}
		}
	}

	/**
	* Función que dirige a la vista de pago rechazado
	*/
	public function pagoRechazado(){
		$ordenCompra = $this->Session->read('OC');
		$this->set(compact('ordenCompra'));
	}

	/**
	* END FUNCIONES PARA PAGO SIMULTANEO
	*/

	/**
	* FUNCIONES PARA ANULACIÓN EN PAGO SIMULTANEO
	*/

	/**
	* Función que anula una compra con pago simultaneo
	*/
	public function anularCompra(){
		if ( $this->request->is('post') )
		{
			/**
			* $codigoAutorizacion 	Contiene el número de autorizacion de compra que devuelve Transbank al realizar una compra
			* $montoAutorizado 		Contiene el monto total de la compra
			* $ordenCompra			Contiene el número de la Orden de Compra
			* $montoAnulado			Contiene el monto que se desea anular (Para anulación total es mismo monto autorizado)
			* $idComercio			Contiene el id del comercio entregado por Transbank
			*/

			$codigoAutorizacion = $this->request->data['codigo_autorizacion'];
			$montoAutorizado 	= $this->request->data['monto'];
			$ordenCompra 		= $this->request->data['oc'];
			$montoAnulado 		= $this->request->data['monto'];
			$idComercio 		= '597034043612';

			try{
				$compraAnulada  = $this->PagoSimultaneo->anularCompra($codigoAutorizacion, $montoAutorizado, $ordenCompra, $idComercio, $montoAnulado );
			} catch (Exception $e) {
				pr('Ocurrió un error al anular esta compra.');exit;
			}

			debug($compraAnulada);
			exit;
		}
	}

	/**
	* END FUNCIONES PARA ANULACIÓN EN PAGO SIMULTANEO
	*/
}
