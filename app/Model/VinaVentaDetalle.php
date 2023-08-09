<?php
App::uses('AppModel', 'Model');

class VinaVentaDetalle extends AppModel {
	public $belongsTo = array(
		'VinaProducto' => array(
			'className' => 'VinaProducto',
			'foreignKey' => 'producto_id',
			'conditions' => '',
			'fields' => 'nombre',
			'order' => ''
		)
	);
	public function detalleComrpas($ids=null){
		if(isset($ids)){
			$data=$this->find('all',[
				'conditions'=>[
					'VinaVentaDetalle.vina_venta_resumen_id IN'=>$ids
				]
			]);
			return $data;
		}else{
			return array();
		}
	}
	public function obtieneTodo(){
		$data=$this->find('all');
			return $data;
	}
}