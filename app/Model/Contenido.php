<?php
App::uses('AppModel', 'Model');

class Contenido extends AppModel {
	public function obtieneContendios($id=null){
		if(isset($id)){
			$data=$this->find('first', ['conditions'=>['Contenido.id'=>$id]]);
				return $data;
		}else{
			return array();
		}		
	}
}