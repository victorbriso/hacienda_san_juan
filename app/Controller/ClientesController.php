<?php
App::uses('AppController', 'Controller');
class ClientesController extends AppController {
	public $uses = array();
	public function cuenta(){

	}
	public function registro(){
		$regionesComunas=$this->regiones();
		$this->set(compact('regionesComunas'));
	}
	public function add(){
		if($this->request->is('post')){
			$regiones=$this->regiones();
			$dataDirecion=$this->request->data['data']['regionComuna'];
			$dataDirecion=explode('-', $dataDirecion);
			$direccion[0][0]=$dataDirecion[0].'-'.$regiones['regiones'][$dataDirecion[0]];
			$direccion[0][1]=$dataDirecion[1].'-'.$regiones['comunas'][$dataDirecion[0]][$dataDirecion[1]];
			$direccion[0][2]=$this->request->data['data']['direccion'];
			$direccion[0][3]=1;
			$newletter=(isset($this->request->data['data']['newletter']))?1:0;
			$password=password_hash($this->request->data['data']['pass'], PASSWORD_DEFAULT);
			$dataSave['VinaUsuario']['nombre']=$this->request->data['data']['nombre'];
			$dataSave['VinaUsuario']['apellido']=$this->request->data['data']['apellido'];
			$dataSave['VinaUsuario']['mail']=$this->request->data['data']['mail'];
			$dataSave['VinaUsuario']['tipo']=1;
			$dataSave['VinaUsuario']['validacion']=0;
			$dataSave['VinaUsuario']['direccion']= json_encode($direccion);
			$dataSave['VinaUsuario']['fono']=$this->request->data['data']['fono'];
			$dataSave['VinaUsuario']['clave']=$password;
			$dataSave['VinaUsuario']['newletter']=$newletter;
			$this->loadModel('VinaUsuario');
			if($this->VinaUsuario->save($dataSave)){
                    if(isset($this->request->data['data']['origen']) && $this->request->data['data']['origen']==1){
                         $dataLogin=$dataSave;
                         unset($dataLogin['VinaUsuario']['clave']);
                         $this->Session->write('cliente', $dataLogin);
                         return $this->redirect(array('controller' => 'Pages', 'action' => 'pago'));
                    }
				return $this->redirect(array('controller' => 'Clientes', 'action' => 'clienteNuevo'));
			}else{
				return $this->redirect(array('controller' => 'Clientes', 'action' => 'registro'));
			}
		}else{
			return $this->redirect(array('controller' => 'Clientes', 'action' => 'registro'));
		}
	}
     public function add2(){
          if($this->request->is('post')){
               $regiones=$this->regiones();
               $dataDirecion=$this->request->data['dataNoUser']['regionComuna'];
               $dataDirecion=explode('-', $dataDirecion);
               $direccion[0][0]=$dataDirecion[0].'-'.$regiones['regiones'][$dataDirecion[0]];
               $direccion[0][1]=$dataDirecion[1].'-'.$regiones['comunas'][$dataDirecion[0]][$dataDirecion[1]];
               $direccion[0][2]=$this->request->data['dataNoUser']['direccion'];
               $direccion[0][3]=1;
               $newletter=(isset($this->request->data['dataNoUser']['newletter']))?1:0;
               $dataSave['VinaUsuario']['nombre']=$this->request->data['dataNoUser']['nombre'];
               $dataSave['VinaUsuario']['apellido']=$this->request->data['dataNoUser']['apellido'];
               $dataSave['VinaUsuario']['mail']=$this->request->data['dataNoUser']['mail'];
               $dataSave['VinaUsuario']['tipo']=1;
               $dataSave['VinaUsuario']['validacion']=0;
               $dataSave['VinaUsuario']['direccion']= json_encode($direccion);
               $dataSave['VinaUsuario']['fono']=$this->request->data['dataNoUser']['fono'];
               $dataSave['VinaUsuario']['newletter']=$newletter;
               $this->loadModel('VinaUsuario');
               if($this->VinaUsuario->save($dataSave)){
                    if(isset($this->request->data['dataNoUser']['origen']) && $this->request->data['dataNoUser']['origen']==1){
                         $this->Session->write('compraNoUser', true);
                         $dataSave['VinaUsuario']['id']=$this->VinaUsuario->id;
                         $dataLogin=$dataSave;
                         $this->Session->write('cliente', $dataLogin);
                         return $this->redirect(array('controller' => 'Pages', 'action' => 'pago'));
                    }
                    return $this->redirect(array('controller' => 'Clientes', 'action' => 'clienteNuevo'));
               }else{
                    return $this->redirect(array('controller' => 'Clientes', 'action' => 'registro'));
               }
          }else{
               return $this->redirect(array('controller' => 'Clientes', 'action' => 'registro'));
          }
     }
	public function clienteNuevo(){

	}
	public function login(){
		if($this->request->is('post')){
			if(isset($this->request->data['data']['mail'])&&isset($this->request->data['data']['pass'])){
				$this->loadModel('VinaUsuario');
				$mail=$this->request->data['data']['mail'];
				$pass=$this->request->data['data']['pass'];
				$dataLogin=$this->VinaUsuario->login($mail);
				if(empty($dataLogin)){
					$estado=1;
					$this->set(compact('estado'));
				}else{
					$login=password_verify($pass, $dataLogin['VinaUsuario']['clave']);
					if($login){
						unset($dataLogin['VinaUsuario']['clave']);
						$this->Session->write('cliente', $dataLogin);
						if($this->Session->check('carrito')){
							return $this->redirect(array('controller' => 'Pages', 'action' => 'carrito'));
						}
						return $this->redirect(array('controller' => 'Cuenta', 'action' => 'miCuenta'));
					}else{
						$estado=2;
						$this->set(compact('estado'));
					}	
				}
								
			}else{
				return $this->redirect(array('controller' => 'Clientes', 'action' => 'login'));
			}
		}
	}
	public function miCuenta(){

	}
     public function logOut($controller=null, $action=null){
          $this->Session->delete('cliente');
          if(isset($controller)&&isset($action)){
               return $this->redirect(array('controller' => $controller, 'action' => $action));
          }
          return $this->redirect(array('controller' => 'Clientes', 'action' => 'login'));
     }
	public function regiones(){
		$regiones=array(
		    0 => 'Tarapacá',
		    1 => 'Antofagasta',
		    2 => 'Atacama',
		    3 => 'Coquimbo',
		    4 => 'Valparaíso',
		    5 => 'Libertador B. O Higgins',
		    6 => 'Maule',
		    7 => 'Bíobío',
		    8 => 'La Araucanía',
		    9 => 'Los Lagos',
		    10 => 'Aisén del Gral. C. Ibáñez del Campo',
		    11 => 'Metropolitana de Santiago'
		);
		$comunas=array(
			0 => Array
		        (
		            1 => 'Arica',
                    2 => 'Camarones',
                    3 => 'Putre',
                    4 => 'General Lagos',
                    5 => 'Iquique',
                    6 => 'Camiña',
                    7 => 'Colchane',
                    8 => 'Huara',
                    9 => 'Pica',
                    10 => 'Pozo Almonte',
                    11 => 'Alto Hospicio'

		        ),

		    1 => Array
		        (
		            1 => 'Antofagasta',
                    2 => 'Mejillones',
                    3 => 'Sierra Gorda',
                    4 => 'Taltal',
                    5 => 'Calama',
                    6 => 'Ollagüe',
                    7 => 'San Pedro de Atacama',
                    8 => 'Tocopilla',
                    9 => 'María Elena'

		        ),

		    2 => Array
		        (
		            1 => 'Copiapó',
                    2 => 'Caldera',
                    3 => 'Tierra Amarilla',
                    4 => 'Chañaral',
                    5 => 'Diego de Almagro',
                    6 => 'Vallenar',
                    7 => 'Alto del Carmen',
                    8 => 'Freirina',
                    9 => 'Huasco'

		        ),

		    3 => Array
		        (
		            1 => 'La Serena',
                    2 => 'Coquimbo',
                    3 => 'Andacollo',
                    4 => 'La Higuera',
                    5 => 'Paiguano',
                    6 => 'Vicuña',
                    7 => 'Illapel',
                    8 => 'Canela',
                    9 => 'Los Vilos',
                    10 => 'Salamanca',
                    11 => 'Ovalle',
                    12 => 'Combarbalá',
                    13 => 'Monte Patria',
                    14 => 'Punitaqui',
                    15 => 'Río Hurtado'

		        ),

		    4 => Array
		        (
		            1 => 'Valparaíso',
                    2 => 'Casablanca',
                    3 => 'Concón',
                    4 => 'Juan Fernández',
                    5 => 'Puchuncaví',
                    6 => 'Quilpué',
                    7 => 'Quintero',
                    8 => 'Villa Alemana',
                    9 => 'Viña del Mar',
                    10 => 'Isla de Pascua',
                    11 => 'Los Andes',
                    12 => 'Calle Larga',
                    13 => 'Rinconada',
                    14 => 'San Esteban',
                    15 => 'La Ligua',
                    16 => 'Cabildo',
                    17 => 'Papudo',
                    18 => 'Petorca',
                    19 => 'Zapallar',
                    20 => 'Quillota',
                    21 => 'Calera',
                    22 => 'Hijuelas',
                    23 => 'La Cruz',
                    24 => 'Limache',
                    25 => 'Nogales',
                    26 => 'Olmué',
                    27 => 'San Antonio',
                    28 => 'Algarrobo',
                    29 => 'Cartagena',
                    30 => 'El Quisco',
                    31 => 'El Tabo',
                    32 => 'Santo Domingo',
                    33 => 'San Felipe',
                    34 => 'Catemu',
                    35 => 'Llaillay',
                    36 => 'Panquehue',
                    37 => 'Putaendo',
                    38 => 'Santa María'

		        ),

		    5 => Array
		        (
		            1 => 'Rancagua',
                    2 => 'Codegua',
                    3 => 'Coinco',
                    4 => 'Coltauco',
                    5 => 'Doñihue',
                    6 => 'Graneros',
                    7 => 'Las Cabras',
                    8 => 'Machalí',
                    9 => 'Malloa',
                    10 => 'Mostazal',
                    11 => 'Olivar',
                    12 => 'Peumo',
                    13 => 'Pichidegua',
                    14 => 'Quinta de Tilcoco',
                    15 => 'Rengo',
                    16 => 'Requínoa',
                    17 => 'San Vicente',
                    18 => 'Pichilemu',
                    19 => 'La Estrella',
                    20 => 'Litueche',
                    21 => 'Marchihue',
                    22 => 'Navidad',
                    23 => 'Paredones',
                    24 => 'San Fernando',
                    25 => 'Chépica',
                    26 => 'Chimbarongo',
                    27 => 'Lolol',
                    28 => 'Nancagua',
                    29 => 'Palmilla',
                    30 => 'Peralillo',
                    31 => 'Placilla',
                    32 => 'Pumanque',
                    33 => 'Santa Cruz'

		        ),

		    6 => Array
		        (
		            1 => 'Talca',
                    2 => 'Constitución',
                    3 => 'Curepto',
                    4 => 'Empedrado',
                    5 => 'Maule',
                    6 => 'Pelarco',
                    7 => 'Pencahue',
                    8 => 'Río Claro',
                    9 => 'San Clemente',
                    10 => 'San Rafael',
                    11 => 'Cauquenes',
                    12 => 'Chanco',
                    13 => 'Pelluhue',
                    14 => 'Curicó',
                    15 => 'Hualañé',
                    16 => 'Licantén',
                    17 => 'Molina',
                    18 => 'Rauco',
                    19 => 'Romeral',
                    20 => 'Sagrada Familia',
                    21 => 'Teno',
                    22 => 'Vichuquén',
                    23 => 'Linares',
                    24 => 'Colbún',
                    25 => 'Longaví',
                    26 => 'Parral',
                    27 => 'Retiro',
                    28 => 'San Javier',
                    29 => 'Villa Alegre',
                    30 => 'Yerbas Buenas'

		        ),

		    7 => Array
		        (
		            1 => 'Concepción',
                    2 => 'Coronel',
                    3 => 'Chiguayante',
                    4 => 'Florida',
                    5 => 'Hualqui',
                    6 => 'Lota',
                    7 => 'Penco',
                    8 => 'San Pedro de la Paz',
                    9 => 'Santa Juana',
                    10 => 'Talcahuano',
                    11 => 'Tomé',
                    12 => 'Hualpén',
                    13 => 'Lebu',
                    14 => 'Arauco',
                    15 => 'Cañete',
                    16 => 'Contulmo',
                    17 => 'Curanilahue',
                    18 => 'Los Álamos',
                    19 => 'Tirúa',
                    20 => 'Los Ángeles',
                    21 => 'Antuco',
                    22 => 'Cabrero',
                    23 => 'Laja',
                    24 => 'Mulchén',
                    25 => 'Nacimiento',
                    26 => 'Negrete',
                    27 => 'Quilaco',
                    28 => 'Quilleco',
                    29 => 'San Rosendo',
                    30 => 'Santa Bárbara',
                    31 => 'Tucapel',
                    32 => 'Yumbel',
                    33 => 'Alto Biobío',
                    34 => 'Chillán',
                    35 => 'Bulnes',
                    36 => 'Cobquecura',
                    37 => 'Coelemu',
                    38 => 'Coihueco',
                    39 => 'Chillán Viejo',
                    40 => 'El Carmen',
                    41 => 'Ninhue',
                    42 => 'Ñiquén',
                    43 => 'Pemuco',
                    44 => 'Pinto',
                    45 => 'Portezuelo',
                    46 => 'Quillón',
                    47 => 'Quirihue',
                    48 => 'Ránquil',
                    49 => 'San Carlos',
                    50 => 'San Fabián',
                    51 => 'San Ignacio',
                    52 => 'San Nicolás',
                    53 => 'Treguaco',
                    54 => 'Yungay'

		        ),

		    8 => Array
		        (
		            1 => 'Temuco',
                    2 => 'Carahue',
                    3 => 'Cunco',
                    4 => 'Curarrehue',
                    5 => 'Freire',
                    6 => 'Galvarino',
                    7 => 'Gorbea',
                    8 => 'Lautaro',
                    9 => 'Loncoche',
                    10 => 'Melipeuco',
                    11 => 'Nueva Imperial',
                    12 => 'Padre Las Casas',
                    13 => 'Perquenco',
                    14 => 'Pitrufquén',
                    15 => 'Pucón',
                    16 => 'Saavedra',
                    17 => 'Teodoro Schmidt',
                    18 => 'Toltén',
                    19 => 'Vilcún',
                    20 => 'Villarrica',
                    21 => 'Cholchol',
                    22 => 'Angol',
                    23 => 'Collipulli',
                    24 => 'Curacautín',
                    25 => 'Ercilla',
                    26 => 'Lonquimay',
                    27 => 'Los Sauces',
                    28 => 'Lumaco',
                    29 => 'Purén',
                    30 => 'Renaico',
                    31 => 'Traiguén',
                    32 => 'Victoria'

		        ),

		    9 => Array
		        (
		            1 => 'Valdivia',
                    2 => 'Corral',
                    3 => 'Futrono',
                    4 => 'La Unión',
                    5 => 'Lago Ranco',
                    6 => 'Lanco',
                    7 => 'Los Lagos',
                    8 => 'Máfil',
                    9 => 'Mariquina',
                    10 => 'Paillaco',
                    11 => 'Panguipulli',
                    12 => 'Río Bueno',
                    13 => 'Puerto Montt',
                    14 => 'Calbuco',
                    15 => 'Cochamó',
                    16 => 'Fresia',
                    17 => 'Frutillar',
                    18 => 'Los Muermos',
                    19 => 'Llanquihue',
                    20 => 'Maullín',
                    21 => 'Puerto Varas',
                    22 => 'Castro',
                    23 => 'Ancud',
                    24 => 'Chonchi',
                    25 => 'Curaco de Vélez',
                    26 => 'Dalcahue',
                    27 => 'Puqueldón',
                    28 => 'Queilén',
                    29 => 'Quellón',
                    30 => 'Quemchi',
                    31 => 'Quinchao',
                    32 => 'Osorno',
                    33 => 'Puerto Octay',
                    34 => 'Purranque',
                    35 => 'Puyehue',
                    36 => 'Río Negro',
                    37 => 'San Juan de la Costa',
                    38 => 'San Pablo',
                    39 => 'Chaitén',
                    40 => 'Futaleufú',
                    41 => 'Hualaihué',
                    42 => 'Palena'

		        ),

		    10 => Array
		        (
		            1 => 'Coihaique',
                    2 => 'Lago Verde',
                    3 => 'Aisén',
                    4 => 'Cisnes',
                    5 => 'Guaitecas',
                    6 => 'Cochrane',
                    7 => 'O Higgins',
                    8 => 'Tortel',
                    9 => 'Chile Chico',
                    10 => 'Río Ibáñez',
                    11 => 'Punta Arenas',
                    12 => 'Laguna Blanca',
                    13 => 'Río Verde',
                    14 => 'San Gregorio',
                    15 => 'Cabo de Hornos',
                    16 => 'Antártica',
                    17 => 'Porvenir',
                    18 => 'Primavera',
                    19 => 'Timaukel',
                    20 => 'Natales',
                    21 => 'Torres del Paine'

		        ),

		    11 => Array
		        (
		          1 => 'Santiago',
                    2 => 'Cerrillos',
                    3 => 'Cerro Navia',
                    4 => 'Conchalí',
                    5 => 'El Bosque',
                    6 => 'Estación Central',
                    7 => 'Huechuraba',
                    8 => 'Independencia',
                    9 => 'La Cisterna',
                    10 => 'La Florida',
                    11 => 'La Granja',
                    12 => 'La Pintana',
                    13 => 'La Reina',
                    14 => 'Las Condes',
                    15 => 'Lo Barnechea',
                    16 => 'Lo Espejo',
                    17 => 'Lo Prado',
                    18 => 'Macul',
                    19 => 'Maipú',
                    20 => 'Ñuñoa',
                    21 => 'Pedro Aguirre Cerda',
                    22 => 'Peñalolén',
                    23 => 'Providencia',
                    24 => 'Pudahuel',
                    25 => 'Quilicura',
                    26 => 'Quinta Normal',
                    27 => 'Recoleta',
                    28 => 'Renca',
                    29 => 'San Joaquín',
                    30 => 'San Miguel',
                    31 => 'San Ramón',
                    32 => 'Vitacura',
                    33 => 'Puente Alto',
                    34 => 'Pirque',
                    35 => 'San José de Maipo',
                    36 => 'Colina',
                    37 => 'Lampa',
                    38 => 'Tiltil',
                    39 => 'San Bernardo',
                    40 => 'Buin',
                    41 => 'Calera de Tango',
                    42 => 'Paine',
                    43 => 'Melipilla',
                    44 => 'Alhué',
                    45 => 'Curacaví',
                    46 => 'María Pinto',
                    47 => 'San Pedro',
                    48 => 'Talagante',
                    49 => 'El Monte',
                    50 => 'Isla de Maipo',
                    51 => 'Padre Hurtado',
                    52 => 'Peñaflor'

		        )
		);
		$data['regiones']=$regiones;
		$data['comunas']=$comunas;
		return $data;
	}
}




	