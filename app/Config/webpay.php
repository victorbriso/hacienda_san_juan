<?php
$configuraciones=0;

//-------------------------------------------------- DESARROLLO --------------------------------------------------
if ($configuraciones == 0) {

	$config = array(
		'Webpay' => array(
			'PagoSimultaneo' => array(
				'endpoint'		=> 'https://webpay3gint.transbank.cl/WSWebpayTransaction/cxf/WSWebpayService?wsdl',
				'server_cert'	=> dirname(__FILE__) . DS . implode(DS, array('webpay', 'pagoSimultaneo', 'tbk.pem.crt')),
				'private_key'	=> dirname(__FILE__) . DS . implode(DS, array('webpay', 'pagoSimultaneo', '597020000540.key')),
				'cert_file'		=> dirname(__FILE__) . DS . implode(DS, array('webpay', 'pagoSimultaneo', '597020000540.crt'))
			),
			'Anulacion' => array(
				'endpoint'		=> 'https://webpay3gint.transbank.cl/WSWebpayTransaction/cxf/WSCommerceIntegrationService?wsdl',
				'server_cert'	=> dirname(__FILE__) . DS . implode(DS, array('webpay', 'anulacion', 'serverTBK.crt')),
				'private_key'	=> dirname(__FILE__) . DS . implode(DS, array('webpay', 'anulacion', '597034043612.key')),
				'cert_file'		=> dirname(__FILE__) . DS . implode(DS, array('webpay', 'anulacion', '597034043612.crt'))
			)
		)
	);
/*
	$config = array(
		'Webpay' => array(
			'PagoSimultaneo' => array(
				'endpoint'		=> 'https://webpay3gint.transbank.cl/WSWebpayTransaction/cxf/WSWebpayService?wsdl',
				'server_cert'	=> dirname(__FILE__) . DS . implode(DS, array('webpay', 'pagoSimultaneo', 'tbk.pem')),
				'private_key'	=> dirname(__FILE__) . DS . implode(DS, array('webpay', 'pagoSimultaneo', '597020000541.key')),
				'cert_file'		=> dirname(__FILE__) . DS . implode(DS, array('webpay', 'pagoSimultaneo', '597020000541.crt'))
			),
			'Anulacion' => array(
				'endpoint'		=> 'https://webpay3gint.transbank.cl/WSWebpayTransaction/cxf/WSCommerceIntegrationService?wsdl',
				'server_cert'	=> dirname(__FILE__) . DS . implode(DS, array('webpay', 'anulacion', 'tbk.pem')),
				'private_key'	=> dirname(__FILE__) . DS . implode(DS, array('webpay', 'anulacion', '597020000541.key')),
				'cert_file'		=> dirname(__FILE__) . DS . implode(DS, array('webpay', 'anulacion', '597020000541.crt'))
			)
		)
	);
*/
}

//-------------------------------------------------- PRODUCCIÓN --------------------------------------------------
if ($configuraciones == 1) {

	$config = array(
		'Webpay' => array(
			'PagoSimultaneo' => array(
				'endpoint'		=> 'https://webpay3g.transbank.cl/WSWebpayTransaction/cxf/WSWebpayService?wsdl',
				'server_cert'	=> dirname(__FILE__) . DS . implode(DS, array('webpay', 'pagoSimultaneo', 'serverTBK.crt')),
				'private_key'	=> dirname(__FILE__) . DS . implode(DS, array('webpay', 'pagoSimultaneo', '597034043612.key')),
				'cert_file'		=> dirname(__FILE__) . DS . implode(DS, array('webpay', 'pagoSimultaneo', '597034043612.crt'))
			),
			'Anulacion' => array(
				'endpoint'		=> 'https://webpay3g.transbank.cl/WSWebpayTransaction/cxf/WSWebpayService?wsdl',
				'server_cert'	=> dirname(__FILE__) . DS . implode(DS, array('webpay', 'anulacion', 'serverTBK.crt')),
				'private_key'	=> dirname(__FILE__) . DS . implode(DS, array('webpay', 'anulacion', '597034043612.key')),
				'cert_file'		=> dirname(__FILE__) . DS . implode(DS, array('webpay', 'anulacion', '597034043612.crt'))
			)
		)
	);

}
