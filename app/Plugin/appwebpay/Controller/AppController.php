<?php
App::uses('Controller', 'Controller');
class AppController extends Controller
{
	public $helpers		= array(
		'Session', 'Html', 'Form'
	);
	public $components	= array(
		'Session',
		'Webpay.Oneclick',
		'Webpay.PagoSimultaneo'
	);
}

