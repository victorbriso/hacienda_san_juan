<?php
App::uses('AppController', 'Controller');
class CuentaController extends AppController {
	public $uses = array();
	public function miCuenta(){
		if($this->Session->check('cliente')){
			$clienteId=$this->Session->read('cliente.VinaUsuario.id');
			$this->loadModel('VinaUsuario');
			$this->loadModel('VinaVentaResumen');
			$this->loadModel('VinaVentaDetalle');
			$datosUsuario=$this->VinaUsuario->datosClientes($clienteId);
			$datosUsuario['VinaUsuario']['direccion']=json_decode($datosUsuario['VinaUsuario']['direccion'], true);
			$dataCompras=$this->VinaVentaResumen->comprasCliente($clienteId);
			$idsCompras=array();
			foreach ($dataCompras as $key1 => $value1) {
				array_push($idsCompras, $value1['VinaVentaResumen']['id']);
			}
			$idsCompras=array_unique($idsCompras);
			$detalleCompras=$this->VinaVentaDetalle->detalleComrpas($idsCompras);
			foreach ($idsCompras as $key2 => $value2) {
				$dataResumen[$value2]=array();
			}
			foreach ($detalleCompras as $key3 => $value3) {
				$data['producto']		=		$value3['VinaProducto']['nombre'];
				$data['precio']			=		$value3['VinaVentaDetalle']['precio'];
				$data['cantidad']		=		$value3['VinaVentaDetalle']['cantidad'];
				$data['total']			=		$value3['VinaVentaDetalle']['cantidad']*$value3['VinaVentaDetalle']['precio'];
				array_push($dataResumen[$value3['VinaVentaDetalle']['vina_venta_resumen_id']], $data);
			}
			$this->set(compact('datosUsuario', 'dataCompras', 'dataResumen'));
		}else{
			return $this->redirect(array('controller' => 'Clientes', 'action' => 'logOut'));
		}
	}
	public function actualizaDatos(){
		if($this->request->is('post')){
			$this->layout='ajax';
			$this->autoRender=false;
			$this->loadModel('VinaUsuario');
			$this->VinaUsuario->id=$this->request->data['id'];
			$dataUpdate['VinaUsuario']['id']		=	$this->request->data['id'];
			$dataUpdate['VinaUsuario']['nombre']	=	$this->request->data['nombre'];
			$dataUpdate['VinaUsuario']['apellido']	=	$this->request->data['apellido'];
			$dataUpdate['VinaUsuario']['mail']		=	$this->request->data['mail'];
			$dataUpdate['VinaUsuario']['fono']		=	$this->request->data['fono'];
			if($this->VinaUsuario->save($dataUpdate)){
				return 1;
			}else{
				return 2;
			}
		}else{
			return $this->redirect(array('controller' => 'Clientes', 'action' => 'logOut'));
		}
	}
	public function pruebasSistema(){
		prx(phpinfo());
	}
}