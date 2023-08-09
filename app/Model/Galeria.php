<?php
App::uses('AppModel', 'Model');

class Galeria extends AppModel {
	public function obtieneImagenes(){
		$data=$this->find('list', ['conditions'=>['Galeria.estado'=>true] ,'fields'=>['Galeria.path']]);
		return $data;
	}
}