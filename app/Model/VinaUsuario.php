<?php
App::uses('AppModel', 'Model');

class VinaUsuario extends AppModel {
	public function login($mail=null){
		if(isset($mail)){
			$data=$this->find('first', array(
				'conditions'=>array(
					'VinaUsuario.mail'=>$mail
				)
			));
			return $data;
		}else{
			return array();
		}		
	}
	public function datosClientes($id=null){
		if(isset($id)){
			$data=$this->find('first', array(
				'conditions'=>array(
					'VinaUsuario.id'=>$id
				),
				'fields'=>array(
					'VinaUsuario.id', 'VinaUsuario.nombre', 'VinaUsuario.apellido', 'VinaUsuario.mail', 'VinaUsuario.fono', 'VinaUsuario.direccion'
				)
			));
			return $data;
		}else{
			return array();
		}		
	}
	public function loginUserAdmin($mail=null, $pass=null){
		if(isset($mail)&&isset($pass)){
			$data=$this->find('first', array(
				'conditions'=>array(
					'VinaUsuario.mail'=>$mail,
					'VinaUsuario.tipo'=>2
				)
			));
			if(!empty($data)){
				if(password_verify($pass, $data['VinaUsuario']['clave'])){
					unset($data['VinaUsuario']['clave']);
					
					return $data;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	public function todosLosUsuarios(){
		$data=$this->find('all');
		return $data;
	}
}