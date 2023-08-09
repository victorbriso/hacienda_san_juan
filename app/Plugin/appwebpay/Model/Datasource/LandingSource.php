<?php
App::uses('HttpSocket', 'Network/Http');
class LandingSource extends DataSource
{
	public $description = 'Cliente Landings BrandOn';
	public $client = null;
	public $connected = false;
	protected $_baseConfig = array(
		'host' => null,
		'login' => null,
		'password' => '',
		'form' => null
	);

/**
 * Constructor
 *
 * @param array $config An array defining the configuration settings
 */
	public function __construct($config = array())
	{
		parent::__construct($config);
		$this->Http = new HttpSocket();
	}

/**
 * listSources() is for caching. You'll likely want to implement caching in
 * your own way with a custom datasource. So just ``return null``.
 */
	public function listSources($data = null)
	{
		return null;
	}

/**
 * calculate() is for determining how we will count the records and is
 * required to get ``update()`` and ``delete()`` to work.
 *
 * We don't count the records here but return a string to be passed to
 * ``read()`` which will do the actual counting. The easiest way is to just
 * return the string 'COUNT' and check for it in ``read()`` where
 * ``$data['fields'] === 'COUNT'``.
 */
	public function calculate(Model $model, $func, $params = array())
	{
		return 'COUNT';
	}

/**
 * Implement the C in CRUD. Calls to ``Model::save()`` without $model->id
 * set arrive here.
 */
	public function create(Model $model, $fields = null, $values = null)
	{
		$campos			= $model->data[$model->alias];
		$data			= array(
			'Cliente'		=> array(
				'identificador'		=> $this->config['login'],
				'clave'				=> $this->config['password']
			),
			'Formulario'	=> array(
				'identificador'		=> $this->config['form'],
			),
			'Campo'			=> $campos
		);
		$response		= json_decode($this->Http->post($this->config['host'] . $model->endPoint, $data), true);
		if ( is_null($response) )
		{
			$response		= array('code' => 500, 'message' => 'WS offline');
		}
		$model->data	= $response;
		return true;
	}

/**
 * Implement the R in CRUD. Calls to ``Model::find()`` arrive here.
 */
    public function read(Model $model, $queryData = array(), $recursive = null)
	{
		return null;
	}

/**
 * Implement the U in CRUD. Calls to ``Model::save()`` with $Model->id
 * set arrive here. Depending on the remote source you can just call
 * ``$this->create()``.
 */
	public function update(Model $model, $fields = null, $values = null, $conditions = null)
	{
		return null;
	}

/**
 * Implement the D in CRUD. Calls to ``Model::delete()`` arrive here.
 */
	public function delete(Model $model, $id = null)
	{
		return null;
	}
}
