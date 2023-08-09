<?php
App::uses('AppModel', 'Model');

class VinaVina extends AppModel {
	public function listaVinas(){
		$data=$this->find('all');
		return $data;
	}
	public function listaVinasSimple(){
		$data=$this->find('list', array('fields'=>'VinaVina.nombre'));
		return $data;
	}
}