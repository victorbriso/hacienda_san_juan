<?php
App::uses('AppModel', 'Model');

class Vino extends AppModel {
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
		)
	);
	public function obtieneVinos(){
		$data=$this->find('all');
		return $data;
	}
	public function obtieneVinosPublico(){
		$data=$this->find('all', array(
			'conditions'=>array(
				'Vino.estado'=>true
			)
		));
		return $data;
	}
	public function obtieneVinosEdit($id=null){
		if(isset($id)){
			$data=$this->find('first', array(
				'conditions'=>array(
					'Vino.id'=>$id
				)
			));
			return $data;
		}else{
			return array();
		}		
	}
}