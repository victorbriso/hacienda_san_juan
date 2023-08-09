<?php
App::uses('AppModel', 'Model');

class VinaProducto extends AppModel {
	public $belongsTo = array(
		'VinaCepa' => array(
			'className' => 'VinaCepa',
			'foreignKey' => 'cepa_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'VinaVariedad' => array(
			'className' => 'VinaVariedad',
			'foreignKey' => 'variedad_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'VinaVina' => array(
			'className' => 'VinaVina',
			'foreignKey' => 'vina_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	public function listaProductos(){
		$data=$this->find('all', array(
			'conditions'=>array(
				'VinaProducto.estado'=>true,
				'VinaProducto.descontinuado'=>true
			),
			'order'=>array('VinaProducto.cepa_id'=>'asc')
		));
		return $data;
	}
	public function listaProductosDescontinuados(){
		$data=$this->find('all', array(
			'conditions'=>array(
				'VinaProducto.estado'=>true,
				'VinaProducto.descontinuado'=>false
			)
		));
		return $data;
	}
	public function obtieneProducto($id=null){
		if(isset($id)){
			$data=$this->find('first', array(
				'conditions'=>array(
					'VinaProducto.id'=>$id
				)
			));
			return $data;
		}else{
			return array();
		}
	}
	public function obtieneMisProductos(){
		$data=$this->find('all', array(
			'conditions'=>array(
				'VinaProducto.vina_id'=>8
			)
		));
		return $data;
	}
	public function listaProductosPromo(){
		$data=$this->find('all', array(
			'conditions'=>array(
				'VinaProducto.estado'=>true,
				'VinaProducto.descontinuado'=>true,
				'VinaProducto.promocion'=>true
			)
		));
		return $data;
	}
	public function listaNombresProductos(){
		$data=$this->find('list', array(
			'fields'=>array(
				'VinaProducto.nombre'
			)
		));
		return $data;
	}
}