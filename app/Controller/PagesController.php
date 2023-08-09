<?php
App::uses('AppController', 'Controller');
class PagesController extends AppController {
	public $uses = array();
	public function index(){		 
	}
	public function nosotros(){
		$this->loadModel('Contenido');
		$data=$this->Contenido->obtieneContendios(2);
		$data['Contenido']['contenido']=json_decode($data['Contenido']['contenido'], true);
		if($this->Session->check('idioma')){
			$idioma=$this->Session->read('idioma');
		}else{
			$idioma='es';
		}	
		$this->set(compact('data', 'idioma'));
	}
	public function finalizar(){
		if($this->Session->check('cliente')){
			return $this->redirect(array('controller' => 'Pages', 'action' => 'pago'));
		}
		App::import('Controller', 'Clientes');  
    	$ClientesController    =   new ClientesController;  
    	$regionesComunas     =   $ClientesController->regiones();
    	$this->set(compact('regionesComunas'));
	}
	public function edad(){
		if($this->Session->check('idioma')){
			return $this->redirect(array('controller' => 'Pages', 'action' => 'index'));
		}else{
			$this->layout='edad';
		}		
	}
	public function idioma($idioma){
		$this->Session->write('idioma', $idioma);
		return $this->redirect(array('controller' => 'Pages', 'action' => 'index'));
	}
	public function loginAjax(){
		$this->layout='ajax';
		$this->autoRender=false;
		if($this->request->is('post')){
			if(isset($this->request->data['mail'])&&isset($this->request->data['pass'])){
				$this->loadModel('VinaUsuario');
				$mail=$this->request->data['mail'];
				$pass=$this->request->data['pass'];
				$dataLogin=$this->VinaUsuario->login($mail);
				if(empty($dataLogin)){
					return 2;
				}else{
					$login=password_verify($pass, $dataLogin['VinaUsuario']['clave']);
					if($login){
						unset($dataLogin['VinaUsuario']['clave']);
						$this->Session->write('cliente', $dataLogin);
						return 4;
					}else{
						return 3;
					}	
				}
			}else{
				return 1;
			}
		}else{
			return 1;
		}
	}
	public function compraNoUser(){
		App::import('Controller', 'Clientes'); 
		$ClientesController    =   new ClientesController;  
    	$regiones     =   $ClientesController->regiones();
		$dataDirecion=$this->request->data['dataNoUser']['regionComuna'];
		$dataDirecion=explode('-', $dataDirecion);
		$direccion[0][0]=$dataDirecion[0].'-'.$regiones['regiones'][$dataDirecion[0]];
		$direccion[0][1]=$dataDirecion[1].'-'.$regiones['comunas'][$dataDirecion[0]][$dataDirecion[1]];
		$direccion[0][2]=$this->request->data['dataNoUser']['direccion'];
		$direccion[0][3]=1;
		$newletter=(isset($this->request->data['dataNoUser']['newletter']))?1:0;
		$dataSave['VinaUsuario']['nombre']=$this->request->data['dataNoUser']['nombre'];
		$dataSave['VinaUsuario']['apellido']=$this->request->data['dataNoUser']['apellido'];
		$dataSave['VinaUsuario']['mail']=$this->request->data['dataNoUser']['mail'];
		$dataSave['VinaUsuario']['tipo']=1;
		$dataSave['VinaUsuario']['validacion']=0;
		$dataSave['VinaUsuario']['direccion']= json_encode($direccion);
		$dataSave['VinaUsuario']['fono']=$this->request->data['dataNoUser']['fono'];
		$dataSave['VinaUsuario']['newletter']=$newletter;
		$dataLogin=$dataSave;
        $this->Session->write('cliente', $dataLogin);
        $this->Session->write('compraNoUser', true);
        return $this->redirect(array('controller' => 'Pages', 'action' => 'finalizar'));
	}
	public function vinos(){
		$this->loadModel('Vino');
		$misProductos=$this->Vino->obtieneVinosPublico();
		$lang='es';
		$this->set(compact('misProductos', 'lang'));
	}
	public function galeria(){
		$this->loadModel('Galeria');
		$imagenes=$this->Galeria->obtieneImagenes();
		$this->set(compact('imagenes'));
	}
	public function tienda(){
		$this->loadModel('VinaProducto');
		$this->loadModel('VinaCepa');
		$this->loadModel('VinaVariedad');
		$cuentaUsuario=$this->Session->check('cliente');
		$productos=$this->VinaProducto->listaProductos();
		$cepas=$this->VinaCepa->listaCepas();
		$variedades=$this->VinaVariedad->listaVariedades();
		$this->set(compact('productos', 'cepas', 'variedades', 'cuentaUsuario'));
	}
	public function contacto(){
		if($this->request->is('post')){
			$nombre 	=	$this->request->data['nombre'];
			$mail 		=	$this->request->data['mail'];
			$fono 		=	$this->request->data['fono'];
			$asunto 	=	$this->request->data['asunto'];
			$mensaje 	=	$this->request->data['mensaje'];
			$this->layout='ajax';
			$this->autoRender = false;
			App::uses('CakeEmail', 'Network/Email');
			$this->CakeEmail = new CakeEmail();
			$this->CakeEmail 
			->emailFormat('html')
			->template('contacto')
			->viewVars(compact('nombre', 'mail', 'fono', 'asunto', 'mensaje'))
			->from(array('contacto@haciendasanjuan.cl' => 'Hacienda San Juan'))
			->subject('Contacto desde la web')
			->to('contacto@haciendasanjuan.cl')
			->replyto($mail)
			->cc($mail);
			if($this->CakeEmail->send()){
				return 3;
			}else{
				return 2;
			}
		}
	}
	public function agregaProducto(){
		if($this->request->is('post')){
			$this->layout='ajax';
			$this->autoRender = false;
			$cantidad=$this->request->data['cantidad'];
			if($this->Session->check('carrito')){
				if(array_key_exists($this->request->data['id'], $this->Session->read('carrito'))){
					$carrito=$this->Session->read('carrito');
					$carrito[$this->request->data['id']]['VinaProducto']['cantidad']=$carrito[$this->request->data['id']]['VinaProducto']['cantidad']+$cantidad;
					if($this->Session->write('carrito', $carrito)){
						$estado=1;
					}else{
						$estado=0;
					}
				}else{
					$carrito=$this->Session->read('carrito');
					$this->loadModel('VinaProducto');
					$dataNuevo=$this->VinaProducto->obtieneProducto($this->request->data['id']);
					$dataNuevo['VinaProducto']['cantidad']=$cantidad;
					$carrito[$this->request->data['id']]=$dataNuevo;
					if($this->Session->write('carrito', $carrito)){
						$estado=1;
					}else{
						$estado=0;
					}
				}
			}else{
				$this->loadModel('VinaProducto');
				$dataNuevo=$this->VinaProducto->obtieneProducto($this->request->data['id']);
				$dataNuevo['VinaProducto']['cantidad']=$cantidad;
				$carrito[$this->request->data['id']]=$dataNuevo;
				if($this->Session->write('carrito', $carrito)){
					$estado=1;
				}else{
					$estado=0;
				}
			}
			echo $estado;

		}else{
			$estado=0;
			
		}
	}
	public function carrito(){
		$carrito=$this->Session->read('carrito');
		$totalCarrito=array();
		if(!empty($carrito)){
			foreach ($carrito as $key => $value) {
				$valorItem=$value['VinaProducto']['precio']*$value['VinaProducto']['cantidad'];
				array_push($totalCarrito, $valorItem);
			}	
		}
		$cuentaUsuario=$this->Session->check('cliente');
		$totalCarrito=array_sum($totalCarrito);
		$this->set(compact('carrito', 'totalCarrito', 'cuentaUsuario'));
	}
	public function pruebas(){
		$this->Session->delete('carrito');
		prx($this->Session->read('carrito'));
	}
	public function validarDatos($data = null){
		// Aplicar codigo de validacion segun sea el caso
		return true;
	}
	public function vaciarCarrito(){
		$this->Session->delete('carrito');
		return $this->redirect(array('controller' => 'Pages', 'action' => 'tienda'));
	}
	public function ficha($id=null){
		if(isset($id)){
			$this->loadModel('Vino');
			$producto=$this->Vino->obtieneVinosEdit($id);
			$lang='es';
			$this->set(compact('producto', 'lang'));
		}else{
			return $this->redirect(array('controller' => 'Pages', 'action' => 'vinos'));
		}
	}
	public function promociones(){
		$this->loadModel('VinaProducto');
		$this->loadModel('VinaCepa');
		$this->loadModel('VinaVariedad');
		$productos=$this->VinaProducto->listaProductosPromo();
		$cepas=$this->VinaCepa->listaCepas();
		$variedades=$this->VinaVariedad->listaVariedades();
		$this->set(compact('productos', 'cepas', 'variedades'));
	}
	public function restaProducto(){
		$this->layout='ajax';
		$this->autoRender = false;
		$id=$this->request->data['id'];
		$carrito=$this->Session->read('carrito');
		$cantidad=$carrito[$id]['VinaProducto']['cantidad'];
		if($cantidad>1){
			$carrito[$id]['VinaProducto']['cantidad']=$carrito[$id]['VinaProducto']['cantidad']-1;
			$estado=1;
		}else{
			$estado=0;
		}
		$totalCarrito=array();
		foreach ($carrito as $key => $value) {
			$valorItem=$value['VinaProducto']['precio']*$value['VinaProducto']['cantidad'];
			array_push($totalCarrito, $valorItem);
		}
		$this->Session->write('carrito', $carrito);
		$totalCarrito=array_sum($totalCarrito);
		$data['estado']=$estado;
		$data['total']=$totalCarrito;
		$data['cantidad']=$carrito[$id]['VinaProducto']['cantidad'];
		$data['subttl']=$carrito[$id]['VinaProducto']['cantidad']*$carrito[$id]['VinaProducto']['precio'];
		$data=json_encode($data);
		return $data;
	}
	public function sumaProducto(){
		$this->layout='ajax';
		$this->autoRender = false;
		$id=$this->request->data['id'];
		$carrito=$this->Session->read('carrito');
		$cantidad=$carrito[$id]['VinaProducto']['cantidad'];
		$carrito[$id]['VinaProducto']['cantidad']=$carrito[$id]['VinaProducto']['cantidad']+1;
		$estado=1;
		$totalCarrito=array();
		foreach ($carrito as $key => $value) {
			$valorItem=$value['VinaProducto']['precio']*$value['VinaProducto']['cantidad'];
			array_push($totalCarrito, $valorItem);
		}
		$this->Session->write('carrito', $carrito);
		$totalCarrito=array_sum($totalCarrito);
		$data['estado']=$estado;
		$data['total']=$totalCarrito;
		$data['cantidad']=$carrito[$id]['VinaProducto']['cantidad'];
		$data['subttl']=$carrito[$id]['VinaProducto']['cantidad']*$carrito[$id]['VinaProducto']['precio'];
		$data=json_encode($data);
		return $data;
	}
	public function eliminaProducto($id=null){
		if(isset($id)){
			$carrito=$this->Session->read('carrito');
			unset($carrito[$id]);
			if(empty($carrito)){
				return $this->redirect(array('controller' => 'Pages', 'action' => 'tienda'));
			}
			$this->Session->write('carrito', $carrito);
			return $this->redirect(array('controller' => 'Pages', 'action' => 'carrito'));
		}else{
			return $this->redirect(array('controller' => 'Pages', 'action' => 'carrito'));
		}
	}
	public function pago(){
		if($this->Session->check('cliente')&&$this->Session->check('carrito')){
			$cliente=$this->Session->read('cliente');
			$carrito=$this->Session->read('carrito');
			$totalCarrito=array();
			$totalProductos=array();
			foreach ($carrito as $key => $value) {
				$valorItem=$value['VinaProducto']['precio']*$value['VinaProducto']['cantidad'];
				array_push($totalCarrito, $valorItem);
				array_push($totalProductos, $value['VinaProducto']['cantidad']);
			}	
			$totalCarrito=array_sum($totalCarrito);
			$totalProductos=array_sum($totalProductos);
			$direcciones=json_decode($cliente['VinaUsuario']['direccion']);
			$this->set(compact('cliente', 'carrito', 'totalCarrito', 'direcciones', 'totalProductos'));
		}else{
			return $this->redirect(array('controller' => 'Pages', 'action' => 'tienda'));
		}
	}
	public function pagoTransferencia(){
		$this->layout='ajax';
		$this->autoRender = false;
		if($this->request->is('post')){
			if(isset($this->request->data['monto'])&&isset($this->request->data['region'])&&isset($this->request->data['comuna'])&&isset($this->request->data['direccion'])&&isset($this->request->data['despacho'])){
				$dataDespacho['region']=$this->request->data['region'];
				$dataDespacho['comuna']=$this->request->data['comuna'];
				$dataDespacho['direccion']=$this->request->data['direccion'];
				$dataDespacho['monto']=$this->request->data['despacho'];
				$this->Session->write('infoDespachoBD', $dataDespacho);
				$resumenId=$this->guardaVentaTrans();
				if($resumenId){
					$carrito=$this->Session->read('carrito');
					$cliente=$this->Session->read('cliente');
					$totalCarrito=array();
					foreach ($carrito as $key => $value) {
						$valorItem=$value['VinaProducto']['precio']*$value['VinaProducto']['cantidad'];
						array_push($totalCarrito, $valorItem);
					}	
					$totalCarrito=array_sum($totalCarrito);
					$monto=$this->request->data['monto'];
					$despacho=$this->request->data['despacho'];
					$mail=$cliente['VinaUsuario']['mail'];
					App::uses('CakeEmail', 'Network/Email');
					$this->CakeEmail = new CakeEmail();
					$this->CakeEmail 
					->emailFormat('html')
					->template('transferencia')
					->viewVars(compact('carrito', 'monto', 'totalCarrito', 'despacho', 'resumenId'))
					->from(array('contacto@haciendasanjuan.cl' => 'Tienda On Line'))
					->subject('Datos de pago')
					->to($mail);
					if($this->CakeEmail->send()){
						$this->Session->delete('carrito');
						if($this->Session->check('compraNoUser')){
							$this->Session->delete('cliente');
						}
						return 3;
					}else{
						return 2;
					}
				}else{
					return 5;
				}				
			}else{
				return 4;
			}
		}else{
			return 1;
		}
	}
	private function guardaVentaTrans(){
		if($this->Session->check('carrito')){
			if($this->Session->check('cliente')){
				$carrito=$this->Session->read('carrito');
				$cliente=$this->Session->read('cliente');
				$totalCarrito=array();
				$totalProductos=array();
				foreach ($carrito as $key => $value) {
					$valorItem=$value['VinaProducto']['precio']*$value['VinaProducto']['cantidad'];
					array_push($totalCarrito, $valorItem);
					array_push($totalProductos, $value['VinaProducto']['cantidad']);
				}	
				$totalCarrito=array_sum($totalCarrito);
				$totalProductos=array_sum($totalProductos);
				date_default_timezone_set('America/Santiago');
				$fecha= date('Y-m-d H:i:s', time());
				$dataSaveResumen['VinaVentaResumen']['productos']=$totalProductos;
				$dataSaveResumen['VinaVentaResumen']['total']=$totalCarrito;
				$dataSaveResumen['VinaVentaResumen']['fecha']=$fecha;
				$dataSaveResumen['VinaVentaResumen']['usuario_id']=$cliente['VinaUsuario']['id'];
				$dataSaveResumen['VinaVentaResumen']['estado']=0;
				$dataSaveResumen['VinaVentaResumen']['data_despacho']=json_encode($this->Session->read('infoDespachoBD'));
				$this->loadModel('VinaVentaResumen');
				if($this->VinaVentaResumen->save($dataSaveResumen)){
					$resumenId=$this->VinaVentaResumen->id;
					$dataDetalle=array();
					foreach ($carrito as $key => $value) {
						$varDataDetalle['VinaVentaDetalle']['producto_id']=$value['VinaProducto']['id'];
						$varDataDetalle['VinaVentaDetalle']['precio']=$value['VinaProducto']['precio'];
						$varDataDetalle['VinaVentaDetalle']['cantidad']=$value['VinaProducto']['cantidad'];
						$varDataDetalle['VinaVentaDetalle']['vina_venta_resumen_id']=$resumenId;
						array_push($dataDetalle, $varDataDetalle);
					}
					$this->loadModel('VinaVentaDetalle');
					if($this->VinaVentaDetalle->saveAll($dataDetalle)){
						return $resumenId;
					}else{
						return false;
					}
				}else{
					return false;
				}
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	public function fichas($id=null){
		if(isset($id)){

		}else{
			return $this->redirect(array('controller' => 'Pages', 'action' => 'tienda'));
		}
	}
	public function tourDegustaciones(){
		$this->loadModel('Contenido');
		$data=$this->Contenido->obtieneContendios(4);
		$data['Contenido']['contenido']=json_decode($data['Contenido']['contenido'], true);
		if($this->Session->check('idioma')){
			$idioma=$this->Session->read('idioma');
		}else{
			$idioma='es';
		}	
		$this->set(compact('data', 'idioma'));
	}
	public function newsLetter(){
		if($this->request->is('post')){
			$this->layout='ajax';
			$this->autoRender=false;
			$this->loadModel('Newsletter');
			$dataSave['Newsletter']['mail']=$this->request->data['mail'];
			if($this->Newsletter->save($dataSave)){
				return 1;
			}else{
				return 2;
			}
		}else{
			return $this->redirect(array('controller' => 'Pages', 'action' => 'index'));
		}
	}
	public function errorPago(){
		
	}
}