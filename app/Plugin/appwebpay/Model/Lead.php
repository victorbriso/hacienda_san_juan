<?php
App::uses('AppModel', 'Model');
class Lead extends AppModel
{
	/**
	 * CONFIGURACION DB
	 */
	public $useDbConfig		= 'landings';
	public $endPoint		= 'leads.json';

	/**
	 * ESQUEMA DB
	 */
	protected $_schema		= array(
		'nombre'		=> array(
			'type'			=> 'string',
			'null'			=> false,
			'default'		=> false,
			'length'		=> 80,
			'collate'		=> 'utf8_general_ci',
			'charset'		=> 'utf8'
		),
		'email'			=> array(
			'type'			=> 'string',
			'null'			=> false,
			'default'		=> false,
			'length'		=> 150,
			'collate'		=> 'utf8_general_ci',
			'charset'		=> 'utf8'
		),
	);

	/**
	 * VALIDACIONES
	 */
	public $validate = array(
		'nombre' => array(
			'notBlank' => array(
				'rule'			=> array('notBlank'),
				'last'			=> true,
				'message'		=> 'Debes ingresar tu nombre',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
		),
		'email' => array(
			'email' => array(
				'rule'			=> array('email'),
				'last'			=> true,
				'message'		=> 'Debes ingresar tu email',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
		)
	);
}
