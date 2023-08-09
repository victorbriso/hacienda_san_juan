<?php
App::uses('Model', 'Model');
class AppModel extends Model
{
	public $recursive		= -1;
	public $actsAs			= array('Containable');


	/**
	 * VALIDACION -- VALIDA QUE UNA LLAVE FORANEA EXISTA EN EL MODELO ASOCIADO
	 */
	public function validateForeignKey($data = array())
	{
		$associations	= array_map(
			create_function('$v', 'return $v["foreignKey"];'),
			$this->belongsTo
		);
		$aliases		= array();
		foreach ( $associations as $model => $foreignKey )
		{
			if ( ! array_key_exists($foreignKey, $aliases) )
			{
				$aliases[$foreignKey] = array();
			}
			array_push($aliases[$foreignKey], $model);
		}
		foreach ( $aliases[key($data)] as $model )
		{
			$count	= $this->{$model}->find('count', array(
				'conditions'	=> array("{$model}.{$this->{$model}->primaryKey}" => current($data)),
				'recursive'		=> -1
			));
			if ( $count == 1 )
			{
				return true;
			}
		}
		return false;
	}
}
