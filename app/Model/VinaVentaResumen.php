<?php
App::uses('AppModel', 'Model');

class VinaVentaResumen extends AppModel {
	public $hasMany = 'VinaVentaDetalle';
	public $belongsTo = array(
		'VinaUsuario' => array(
			'className' => 'VinaUsuario',
			'foreignKey' => 'usuario_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	public function comprasCliente($id=null){
		if(isset($id)){
			$data=$this->find('all',[
				'conditions'=>[
					'VinaVentaResumen.usuario_id'=>$id
				]
			]);
			return $data;
		}else{
			return array();
		}
	}
	public function totalVentas(){
		$data=$this->find('all', ['contain'=>['VinaVentaDetalle', 'VinaUsuario'], 'order'=>['VinaVentaResumen.id DESC'], 'conditions'=>['VinaVentaResumen.estado IN'=>[0,1,2]]]);
		return $data;
	}
}