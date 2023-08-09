<?php
App::uses('AppModel', 'Model');

class VinaVariedad extends AppModel {
	public function listaVariedades(){
		$data=$this->find('all');
		return $data;
	}
	public function listaVariedadesSimple(){
		$data=$this->find('list', array('fields'=>'VinaVariedad.nombre'));
		return $data;
	}
}