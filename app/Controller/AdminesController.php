<?php
class AdminesController extends AppController {
	public function beforeFilter(){
		if($this->request->params['action']!='login'){
			if(!$this->Session->check('admin')){
				return $this->redirect(
		            array('controller' => 'Admines', 'action' => 'login')
		        );
			}	
		}
	}
	public function pruebas(){
		$this->loadModel('VinaVentaResumen');
		//$this->loadModel('VinaUsuario');
		//$data[];
		$data=array('id'=>44, 'usuario_id'=>41);
		//$this->VinaUsuario->id=44;
		//$this->VinaVentaResumen->save($data);
		prx($this->VinaVentaResumen->totalVentas());
	}
	public function login(){
		$this->layout='loginAdmin';
		if($this->request->is('post')){
			$this->loadModel('VinaUsuario');
			$data=$this->VinaUsuario->loginUserAdmin($this->request->data['data']['mail'],$this->request->data['data']['pass']);
			if(is_array($data)){
				$this->Session->write('admin', $data);
				return $this->redirect(
		            array('controller' => 'Admines', 'action' => 'index')
		        );
			}else{
				return $this->redirect(
		            array('controller' => 'Admines', 'action' => 'login')
		        );
			}
		}
	}
	public function logout(){
		$this->layout='loginAdmin';
		$this->Session->delete('admin');
		return $this->redirect(array('controller' => 'Admines', 'action' => 'login'));
	}
	public function index(){
		$this->layout='admin';
		$this->loadModel('VinaVentaResumen');
		$this->loadModel('VinaProducto');
		$dataVentas=$this->VinaVentaResumen->totalVentas();prx($dataVentas);
		$productos=$this->VinaProducto->listaNombresProductos();//prx($productos);
		$estados=$this->obtieneEstadosPedidos();
		foreach ($dataVentas as $key => $value) {
			$detallePedidos[$value['VinaVentaResumen']['id']]['pedido']=$value['VinaVentaDetalle'];
			$detallePedidos[$value['VinaVentaResumen']['id']]['cliente']=$value['VinaUsuario'];
		}
		$this->set(compact('dataVentas', 'productos', 'estados', 'detallePedidos'));
		//prx($this->VinaVentaResumen->totalVentas());
	}
	public function indexTxt(){
		$this->layout='admin';
	}
	public function indexSlider(){
		$this->layout='admin';
	}
	public function nosotrosTxt(){
		$this->layout='admin';
	}
	public function nosotrosSlider(){
		$this->layout='admin';
	}
	public function vinos(){
		$this->layout='admin';
		$this->loadModel('Vino');
		$misVinos=$this->Vino->obtieneVinos();
		$categorias=$this->todasLasCategorias();
		//prx($misVinos);
		$this->set(compact('misVinos', 'categorias'));
	}
	public function addVino(){
		if($this->request->is('post')){
			$this->request->data['Vino']['path_img']='img-no-disponible.png';
			$this->loadModel('Vino');
			if($this->Vino->save($this->request->data)){
				$id=$this->Vino->id;
				return $this->redirect(
		            array('controller' => 'Admines', 'action' => 'vinosEdit', $id)
		        );
			}else{
				return $this->redirect(
		            array('controller' => 'Admines', 'action' => 'vinos')
		        );
			}
		}else{
			return $this->redirect(
	            array('controller' => 'Admines', 'action' => 'vinos')
	        );
		}
	}
	public function addVinoTienda(){
		if($this->request->is('post')){
			$this->request->data['VinaProducto']['stock']=0;
			$this->loadModel('VinaProducto');
			$this->VinaProducto->create();
			if($this->VinaProducto->save($this->request->data)){
				$id=$this->VinaProducto->id;
				return $this->redirect(
		            array('controller' => 'Admines', 'action' => 'editar', $id)
		        );
			}else{
				return $this->redirect(
		            array('controller' => 'Admines', 'action' => 'productos')
		        );
			}
		}else{
			return $this->redirect(
	            array('controller' => 'Admines', 'action' => 'productos')
	        );
		}
	}
	public function registroVentas(){
		
	}
	public function vinosEdit($id=null){
		$this->layout='admin';
		if($this->request->is('post')){
			if(isset($this->request->data['Vino']['id'])){
				$this->loadModel('Vino');
				$id=$this->request->data['Vino']['id'];
				$this->Vino->id=$this->request->data['Vino']['id'];
				if($this->Vino->save($this->request->data)){
					return $this->redirect(
			            array('controller' => 'Admines', 'action' => 'vinosEdit', $id)
			        );
				}else{
					return $this->redirect(
			            array('controller' => 'Admines', 'action' => 'vinosEdit', $id)
			        );
				}
			}else{
				return $this->redirect(
		            array('controller' => 'Admines', 'action' => 'vinos')
		        );
			}
		}else{
			if(isset($id)){
				$this->loadModel('Vino');
				$data=$this->Vino->obtieneVinosEdit($id);
				$categorias=$this->todasLasCategorias();
				$this->set(compact('data', 'categorias'));			
			}else{
				return $this->redirect(
		            array('controller' => 'Admines', 'action' => 'vinos')
		        );
			}	
		}		
	}
	public function cambiaImagenProductos(){
		if($this->request->is('post')){
			$directorio='../webroot/img/productos/';
			$id=$this->request->data['VinaProducto']['id'];
			$extension=explode('.', $this->request->data['VinaProducto']['image']['name']);
	    	$cargar = $directorio.basename($id.'.'.$extension[1]);	    	
	    	if (move_uploaded_file($this->request->data['VinaProducto']['image']['tmp_name'], $cargar)) {
		    	$this->loadModel('VinaProducto');
		    	$this->VinaProducto->id=$id;
		    	$dataSave['VinaProducto']['id']=$id;
		    	$dataSave['VinaProducto']['extension']=$extension[1];
		    	$this->VinaProducto->save($dataSave);
		    }
		    return $this->redirect(
	            array('controller' => 'Admines', 'action' => 'editar', $id)
	        );
		}else{
			return $this->redirect(
	            array('controller' => 'Admines', 'action' => 'productos')
	        );
		}		
	}
	public function cambiaImagen(){
		if($this->request->is('post')){
			$directorio='../webroot/img/misVinos/';
	    	$cargar = $directorio.basename($this->request->data['Vino']['image']['name']);
	    	$id=$this->request->data['Vino']['id'];
	    	if (move_uploaded_file($this->request->data['Vino']['image']['tmp_name'], $cargar)) {
		    	$this->loadModel('Vino');
		    	$this->Vino->id=$id;
		    	$dataSave['Vino']['id']=$id;
		    	$dataSave['Vino']['path_img']=$this->request->data['Vino']['image']['name'];
		    	$this->Vino->save($dataSave);
		    }
		    return $this->redirect(
	            array('controller' => 'Admines', 'action' => 'vinosEdit', $id)
	        );
		}else{
			return $this->redirect(
	            array('controller' => 'Admines', 'action' => 'vinos')
	        );
		}		
	}
	public function vinosSlider(){
		$this->layout='admin';
	}
	public function galeria(){
		$this->layout='admin';
	}
	public function categorias(){
		$this->layout='admin';
		$this->loadModel('VinaCepa');
		$this->loadModel('VinaVariedad');
		$this->loadModel('VinaVina');
		$cepas=$this->VinaCepa->listaCepas();
		$variedades=$this->VinaVariedad->listaVariedades();
		$vinas=$this->VinaVina->listaVinas();
		$this->set(compact('cepas', 'variedades', 'vinas'));
	}
	public function productos(){
		$this->layout='admin';
		$this->loadModel('VinaProducto');
		$productos=$this->VinaProducto->listaProductos();
		$categorias=$this->todasLasCategorias();
		$this->set(compact('productos', 'categorias'));
	}
	public function ventas(){
		$this->layout='admin';
	}
	public function agregaCategorias(){
		if($this->request->is('post')){
			if($this->request->data['data']['tipo']==1){
				$this->loadModel('VinaCepa');
				$base='VinaCepa';
			}elseif ($this->request->data['data']['tipo']==2) {
				$this->loadModel('VinaVariedad');
				$base='VinaVariedad';
			}elseif ($this->request->data['data']['tipo']==3) {
				$this->loadModel('VinaVina');
				$base='VinaVina';
			}else{
				return $this->redirect(
		            array('controller' => 'Admines', 'action' => 'categorias')
		        );
			}
			$dataSave=array($base=>array('nombre'=>$this->request->data['data']['nombre']));
			if($this->$base->save($dataSave)){
				return $this->redirect(
		            array('controller' => 'Admines', 'action' => 'categorias')
		        );
			}else{
				return $this->redirect(
		            array('controller' => 'Admines', 'action' => 'categorias')
		        );
			}			
		}else{
			return $this->redirect(
	            array('controller' => 'Admines', 'action' => 'categorias')
	        );
		}
	}
	public function descontinuados(){
		$this->layout='admin';
		$this->loadModel('VinaProducto');
		$productos=$this->VinaProducto->listaProductosDescontinuados();
		$this->set(compact('productos'));
	}
	public function cambiaEstados(){
		if($this->request->is('post')){
			if(isset($this->request->data['data']['id'])&&isset($this->request->data['data']['tipo'])){
				if($this->request->data['data']['tipo']==1){
					$estado=1;
					$destino='descontinuados';
				}elseif ($this->request->data['data']['tipo']==2) {
					$estado=0;
					$destino='productos';
				}else{
					return $this->redirect(
			            array('controller' => 'Admines', 'action' => $destino)
			        );
				}
				$this->loadModel('VinaProducto');
				$this->VinaProducto->id=$this->request->data['data']['id'];
				$dataSave=array('VinaProducto'=>array('id'=>$this->request->data['data']['id'], 'descontinuado'=>$estado));
				if($this->VinaProducto->save($dataSave)){
					return $this->redirect(
			            array('controller' => 'Admines', 'action' => $destino)
			        );
				}else{
					return $this->redirect(
			            array('controller' => 'Admines', 'action' => $destino)
			        );
				}
			}else{
				return $this->redirect(
		            array('controller' => 'Admines', 'action' => $destino)
		        );
			}
		}else{
			return $this->redirect(
	            array('controller' => 'Admines', 'action' => $destino)
	        );
		}
	}
	public function editar($id=null){
		if($this->request->is('post')){
			if(isset($this->request->data['VinaProducto']['id'])){
				$this->loadModel('VinaProducto');
				if($this->VinaProducto->save($this->request->data)){
					return $this->redirect(
			            array('controller' => 'Admines', 'action' => 'editar', $this->request->data['VinaProducto']['id'])
			        );
				}else{
					return $this->redirect(
			            array('controller' => 'Admines', 'action' => 'productos')
			        );
				}
			}else{
				return $this->redirect(
		            array('controller' => 'Admines', 'action' => 'productos')
		        );
			}
		}
		if(isset($id)){
			$this->layout='admin';
			$this->loadModel('VinaProducto');
			$producto=$this->VinaProducto->obtieneProducto($id);
			$generalXategorias=$this->todasLasCategorias();
			if(!empty($producto)){
				$this->set(compact('producto', 'generalXategorias'));
			}else{
				return $this->redirect(
		            array('controller' => 'Admines', 'action' => 'productos')
		        );
			}			
		}else{
			return $this->redirect(
	            array('controller' => 'Admines', 'action' => 'productos')
	        );
		}
	}
	private function todasLasCategorias(){
		$this->loadModel('VinaCepa');
		$this->loadModel('VinaVariedad');
		$this->loadModel('VinaVina');
		$data['vinas']		=	$this->VinaVina->listaVinasSimple();
		$data['cepas']		=	$this->VinaCepa->listaCepasSimple();
		$data['variedades']	=	$this->VinaVariedad->listaVariedadesSimple();
		return $data;
	}
	private function obtieneEstadosPedidos(){
		$data[0]='Por Pagar';
		$data[1]='Pagado Transbank';
		$data[2]='Pagado Transferencia';
		$data[3]='Entregado';
		$data[4]='Anulado';
		return $data;
	}
	public function cambiaEstadosPedidos($pedidoId=null, $estado=null){
		if(isset($pedidoId)&&isset($estado)){
			$data=array('id'=>$pedidoId, 'estado'=>$estado);
			$this->loadModel('VinaVentaResumen');
			$this->VinaVentaResumen->save($data);
			return $this->redirect(array('controller' => 'Admines', 'action' => 'index'));
		}else{
			return $this->redirect(array('controller' => 'Admines', 'action' => 'index'));
		}
	}
}