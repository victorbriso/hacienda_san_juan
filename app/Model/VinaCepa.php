<?php
App::uses('AppModel', 'Model');

class VinaCepa extends AppModel {
	public function listaCepas(){
		$data=$this->find('all');
		return $data;
	}
	public function listaCepasSimple(){
		$data=$this->find('list', array('fields'=>'VinaCepa.nombre'));
		return $data;
	}
}