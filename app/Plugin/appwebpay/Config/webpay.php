<?php
$config = array(
	'Webpay' => array(
		'Oneclick' => array(
			'endpoint'		=> 'https://webpay3gint.transbank.cl/webpayserver/wswebpay/OneClickPaymentService?wsdl',
			'server_cert'	=> dirname(__FILE__) . DS . implode(DS, array('webpay', 'oneclick', 'tbk.pem')),
			'private_key'	=> dirname(__FILE__) . DS . implode(DS, array('webpay', 'oneclick', '597020000540.key')),
			'cert_file'		=> dirname(__FILE__) . DS . implode(DS, array('webpay', 'oneclick', '597020000540.crt'))
		),
		'PagoSimultaneo' => array(
			'endpoint'		=> 'https://webpay3gint.transbank.cl/WSWebpayTransaction/cxf/WSWebpayService?wsdl',
			'server_cert'	=> dirname(__FILE__) . DS . implode(DS, array('webpay', 'pagoSimultaneo', 'tbk.pem')),
			'private_key'	=> dirname(__FILE__) . DS . implode(DS, array('webpay', 'pagoSimultaneo', '597020000540.key')),
			'cert_file'		=> dirname(__FILE__) . DS . implode(DS, array('webpay', 'pagoSimultaneo', '597020000540.crt'))
		),
		'Anulacion' => array(
			'endpoint'		=> 'https://webpay3gint.transbank.cl/WSWebpayTransaction/cxf/WSCommerceIntegrationService?wsdl',
			'server_cert'	=> dirname(__FILE__) . DS . implode(DS, array('webpay', 'anulacion', 'tbk.pem')),
			'private_key'	=> dirname(__FILE__) . DS . implode(DS, array('webpay', 'anulacion', '597020000540.key')),
			'cert_file'		=> dirname(__FILE__) . DS . implode(DS, array('webpay', 'anulacion', '597020000540.crt'))
		)
	)
);
