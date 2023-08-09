<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

//App::build(array('Vendor' => array(APP . 'Vendor' . DS . 'lib' . DS .'webpay' . DS)));
//App::uses('Webpay', 'Vendor');
//App::uses('Configuration', 'Vendor');
App::import('Vendor', 'lib/webpay/Webpay');
App::import('Vendor', 'lib/webpay/Configuration');
App::import('Vendor', 'lib/webpay/WebPayNormal');
App::import('Vendor', 'lib/webpay/soap/WSSecuritySoapClient');
App::import('Vendor', 'lib/webpay/soap/WSSESoap');
App::import('Vendor', 'lib/webpay/soap/XMLSecurityDSig');
App::import('Vendor', 'lib/webpay/soap/XMLSecurityKey');
App::import('Vendor', 'lib/webpay/soap/SoapValidation');
App::import('Vendor', 'lib/webpay/wsInitTransactionInput');
App::import('Vendor', 'lib/webpay/wsTransactionDetail');
App::import('Vendor', 'lib/webpay/initTransactionResponse');
App::import('Vendor', 'lib/webpay/getTransactionResult');
App::import('Vendor', 'lib/webpay/getTransactionResultResponse');
App::import('Vendor', 'lib/webpay/transactionResultOutput');
App::import('Vendor', 'lib/webpay/cardDetail');
App::import('Vendor', 'lib/webpay/wsTransactionDetailOutput');
App::import('Vendor', 'lib/webpay/acknowledgeTransaction');
App::import('Vendor', 'lib/webpay/acknowledgeTransactionResponse');
use Transbank\Webpay\Webpay;
use Transbank\Webpay\Configuration;
use Transbank\Webpay\WebPayNormal;
use Transbank\Webpay\soap\WSSecuritySoapClient;

class PagosController extends AppController {
	public function pay(){
		if($this->request->is('post')){
			$this->layout='ajax';
			$this->autoRender = false;
            $monto 			=	$this->request->data['monto'];
            $region 		=	$this->request->data['region'];
            $comuna 		=	$this->request->data['comuna'];
            $direccion 		=	$this->request->data['direccion'];
            $valDespacho 	=	$this->request->data['despacho'];
            $dataDespacho['region']=$this->request->data['region'];
			$dataDespacho['comuna']=$this->request->data['comuna'];
			$dataDespacho['direccion']=$this->request->data['direccion'];
			$dataDespacho['monto']=$this->request->data['despacho'];
			$this->Session->write('infoDespachoBD', $dataDespacho);
            $infoCompra['monto']		=	$monto;
            $infoCompra['region']		=	$region;
            $infoCompra['comuna']		=	$comuna;
            $infoCompra['direccion']	=	$direccion;
            $infoCompra['valDespacho']	=	$valDespacho;
            $this->Session->write('infoCompra', $infoCompra);
            $configuration = new Configuration();
			$configuration->setEnvironment("PRODUCCION");
			$configuration->setCommerceCode("597035622535");
			$configuration->setPrivateKey(
			    "-----BEGIN RSA PRIVATE KEY-----\n" .
	            "MIIEpQIBAAKCAQEAxbkaKSQDoZrscYVoiyilu7XV1xFNVUmOPrUliupuPowsmYvM\n" .
	            "mnIIz2d2NaYoGoNd87rCmjH9aozxn4QGuIy27NbwupY2zKm27IW7VPiWg4pU/51I\n" .
	            "IG2tB+g89SYz+PV5PWFiiPQmXDyXN8mYFxYCxyZ9xzxvTyl9LLXrnZDJ0D7ypVDA\n" .
	            "Sp3Q6AYZJ+4CenJJsiCJLn/IpoIy3yreDJfzD+sDr8xKG7vYAVpryrKCYsovmy7G\n" .
	            "DXdusfkt0x8bPMwdsVWfNhXADZq+m0sxf8dk6jLnK8xcfMLGIkaH6aWW+cQJ2zJj\n" .
	            "Qk+/nVTj+QhBRpZzq1D42e2vF+Uw87QOlHVBzwIDAQABAoIBAQC1saOYqr+rgfJF\n" .
	            "X5LyTif+ltorCHtIJI/SkCQvw74LPES/1Pfv9VqjPTAjnMy9kHqFvtmVWNrHTz26\n" .
	            "mFiUvrpaaipNTDyPVmYCc+Hx835c4oG5Y48kPaUD3yYlITYhUXJYNWWW9MVLfWJ4\n" .
	            "oYhhrphe6cArlh2zYSzmKUabRLIv6goHlkc2iyLO/4sjp81Bbkx3PMptMuhjgD57\n" .
	            "im2m3LYEtU6LmzRQQMhkKR2zbqSQUVm59qHY0+RCJ2AHq+mcGbMYUicyHJQQz/I6\n" .
	            "QwkjJlJnPYU2aICJz/eBHyXQgz8p+EFjbzYms96VvqctixYKcTttqTUjWbzmrlne\n" .
	            "94Xgf/wBAoGBAPGGaTqgI7dZ2fOuxL8wHFc4d4ZJpdNE5gLLon/eNemGIVqPEmcX\n" .
	            "JeV8ye7VOO8/FY0HOQDnLxyqQ20wV/VsNYfcOLinAGvK5K8xMl7eoMqJwS7OiW7E\n" .
	            "DrsQ/4mfvEfUSJjIuQYvWyj5ngIwK+PDmClu9FVQIPJPb24fLUI+NnyXAoGBANGS\n" .
	            "qSjXjzZIG/v4zwGNAdMHoaiqpNEabpxe2loptsteWPMfMDq0pipnPpfFRPeH3P3w\n" .
	            "Y0nYP1rqAcgNpKjoyWTsNwUCsF84w6Zb/vamY9viJRW6pxT0e/7Ap2fp+ZDKYa9B\n" .
	            "D21Nz9bNfGdyIooJWwjP7gnGrQrcIsh8lIQkKbOJAoGABKAFTdkZNf6jfNYg8GRU\n" .
	            "dpsfNtQcN9J+8RjDMN2pfKJT6y8INC8uS5m7KDavE23K1NuJjOngbhUYm3Osi4eZ\n" .
	            "8tMVxvtzt5y4Cl7Pzx9GRvqiV2ofGZ7phU2LBzCm410+UqatXF/1x/AXxYT0ojTx\n" .
	            "qgF07llNeDZrNNml/TnBw1sCgYEArdm6FjVrih4biNUH9ENjBgrIokCc5RHGPFW7\n" .
	            "URxVlTM5GsX+nlSJm5d2JzTwV18PhmDKHNIVDHge7jPTKoOhveTuZ2upn/RY6UJb\n" .
	            "qYSyRg+9r97dB9cgnV54AQ3ph6E7k8Sm5YetKIXh83aNDHFiYVcMInP7zIx9Fk+y\n" .
	            "bEQLi/ECgYEAw02YwIL0Mx5MI1czJgT4bl4CvAXS2yqRFXbDMwA8DMqMqW037flB\n" .
	            "j2z4i5vaEjhflsmaOGI8AWKHKqNre9IH+f1uhsnJlI2+54/6CsGuTc0b8Ok+vmbr\n" .
	            "ElEEBRZxfUWfHfx52UOG2XjH+PFbqQcaAAn+lEhA6KT5IS+eiCT1qDw=\n" .
	            "-----END RSA PRIVATE KEY-----"
			);
			$configuration->setPublicCert(
			    "-----BEGIN CERTIFICATE-----\n" .
	            "MIIDtjCCAp4CCQDLor1+TWmmmDANBgkqhkiG9w0BAQUFADCBnDELMAkGA1UEBhMC\n" .
	            "Y2wxEzARBgNVBAgTCnZhbHBhcmFpc28xFDASBgNVBAcTC3NhbiBhbnRvbmlvMR8w\n" .
	            "HQYDVQQKExZ2aW5hIGhhY2llbmRhIHNhbiBqdWFuMRUwEwYDVQQDEww1OTcwMzU2\n" .
	            "MjI1MzUxKjAoBgkqhkiG9w0BCQEWG2NvbnRhY3RvQGhhY2llbmRhc2FuanVhbi5j\n" .
	            "bDAeFw0yMDA3MjgxODQ3NDNaFw0yNDA3MjcxODQ3NDNaMIGcMQswCQYDVQQGEwJj\n" .
	            "bDETMBEGA1UECBMKdmFscGFyYWlzbzEUMBIGA1UEBxMLc2FuIGFudG9uaW8xHzAd\n" .
	            "BgNVBAoTFnZpbmEgaGFjaWVuZGEgc2FuIGp1YW4xFTATBgNVBAMTDDU5NzAzNTYy\n" .
	            "MjUzNTEqMCgGCSqGSIb3DQEJARYbY29udGFjdG9AaGFjaWVuZGFzYW5qdWFuLmNs\n" .
	            "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAxbkaKSQDoZrscYVoiyil\n" .
	            "u7XV1xFNVUmOPrUliupuPowsmYvMmnIIz2d2NaYoGoNd87rCmjH9aozxn4QGuIy2\n" .
	            "7NbwupY2zKm27IW7VPiWg4pU/51IIG2tB+g89SYz+PV5PWFiiPQmXDyXN8mYFxYC\n" .
	            "xyZ9xzxvTyl9LLXrnZDJ0D7ypVDASp3Q6AYZJ+4CenJJsiCJLn/IpoIy3yreDJfz\n" .
	            "D+sDr8xKG7vYAVpryrKCYsovmy7GDXdusfkt0x8bPMwdsVWfNhXADZq+m0sxf8dk\n" .
	            "6jLnK8xcfMLGIkaH6aWW+cQJ2zJjQk+/nVTj+QhBRpZzq1D42e2vF+Uw87QOlHVB\n" .
	            "zwIDAQABMA0GCSqGSIb3DQEBBQUAA4IBAQAWfhfX99eIVXbJpOPYq3lUiFbES8jE\n" .
	            "4Aat6S07iPmRL4eUxrvCyz+VXOW5sScas8IRr/Zs0WReI/51myUMOgF0TqKnIRAv\n" .
	            "9xstrw65emfDQhgRlWO84HgFvwaATdcyJIt+REsPsHg4cm3BTjRRnkVO+TmcD+c2\n" .
	            "nuGGN091IXbjF51idM5uZBAtrt8J+rEBJIb3MmBjeAYVoQ2CB/vtxxH+Wm4lril1\n" .
	            "Q2PABp4iHykQFtjBL34dn7esMdOaEBTiTAmewK3LAEwSBYM9PR9ub2/vYGKWI2mu\n" .
	            "nwLI8izuHHyyABC5ReAXrMasXNVBqA/+TdEwvYEarrDkY8H5IWuSwRRV\n" .
	            "-----END CERTIFICATE-----\n"
			);
			$transaction = ( new Webpay($configuration))->getNormalTransaction();	   
		    $code_productivo = 597035622535;
		    $code_integracion = 597035622535;
		    $amount     	=   $monto;
		   // $amount     	=   $pagoCompra;
		    $buyOrder  		=   strval(rand(10000, 9999999));
		    $sessionId   	=   date('Y').date('m').date('d').date('H').date('i').date('s').rand(0,9).rand(0,9).rand(0,9);
		    $returnUrl  	=   Router::url(array('controller' => 'Pagos', 'action' => 'webpayResponse'), true);
		    $finalUrl   	=   Router::url(array('controller' => 'Pagos', 'action' => 'webpayResponse'), true);

		    /************************** INICIO LOG TRANSACTION TBK *****************************/
		    $ContenidoLog = "";
			$ContenidoLog .= "****************************** Request initTransaccion (" .date('Y-m-d H:i:s'). ") ******************************" . PHP_EOL;
			$ContenidoLog .= "---------- INFO wsInitTransactionInput ----------" . PHP_EOL;
			$ContenidoLog .= "wSTransactionType: TR_NORMAL_WS"  . PHP_EOL;
			$ContenidoLog .= "code_productivo: " . $code_productivo . PHP_EOL;
			$ContenidoLog .= "sessionId: " . $sessionId . PHP_EOL;
			$ContenidoLog .= "buyOrder: " . $buyOrder . PHP_EOL;
			$ContenidoLog .= "returnURL: " . $returnUrl . PHP_EOL;
			$ContenidoLog .= "finalURL: " . $finalUrl . PHP_EOL;
			$ContenidoLog .= "amount: " . $amount . PHP_EOL;
			/************************** FIN LOG TRANSACTION TBK *****************************/

		    $initResult =   $transaction->initTransaction($amount, $buyOrder, $sessionId, $returnUrl, $finalUrl);
		    $formAction =   $initResult->url;
		    $tokenWs    =   $initResult->token; 
		    //prx($initResult);
		     /************************** INICIO LOG TRANSACTION TBK *****************************/
		    $ContenidoLog .= "****************************** Response initTransaccion (" .date('Y-m-d H:i:s'). ") ******************************" . PHP_EOL;
			$ContenidoLog .= "token: " . $tokenWs . PHP_EOL;
			$ContenidoLog .= "url: " . $formAction . PHP_EOL;
			//EscribirLogWebpay($buyOrder, $ContenidoLog);
			/************************** FIN LOG TRANSACTION TBK *****************************/

		    $this->Session->write('transbank.buyOrder', $buyOrder);
		    $this->Session->write('transbank.tokenWs', $tokenWs);
		    $this->Session->write('transbank.sessionId', $sessionId);
		    $respuesta['formAction']=$formAction;
		    $respuesta['tokenWs']=$tokenWs;
		    return json_encode($respuesta);
		}else{
			return $this->redirect(array('controller' => 'Pages', 'action' => 'tienda'));
		}
	    
	}

	public function webpayResponse()
	{
		
		$configuration = new Configuration();
		$configuration->setEnvironment("PRODUCCION");
		$configuration->setCommerceCode("597035622535");
		$configuration->setPrivateKey(
		    "-----BEGIN RSA PRIVATE KEY-----\n" .
            "MIIEpQIBAAKCAQEAxbkaKSQDoZrscYVoiyilu7XV1xFNVUmOPrUliupuPowsmYvM\n" .
            "mnIIz2d2NaYoGoNd87rCmjH9aozxn4QGuIy27NbwupY2zKm27IW7VPiWg4pU/51I\n" .
            "IG2tB+g89SYz+PV5PWFiiPQmXDyXN8mYFxYCxyZ9xzxvTyl9LLXrnZDJ0D7ypVDA\n" .
            "Sp3Q6AYZJ+4CenJJsiCJLn/IpoIy3yreDJfzD+sDr8xKG7vYAVpryrKCYsovmy7G\n" .
            "DXdusfkt0x8bPMwdsVWfNhXADZq+m0sxf8dk6jLnK8xcfMLGIkaH6aWW+cQJ2zJj\n" .
            "Qk+/nVTj+QhBRpZzq1D42e2vF+Uw87QOlHVBzwIDAQABAoIBAQC1saOYqr+rgfJF\n" .
            "X5LyTif+ltorCHtIJI/SkCQvw74LPES/1Pfv9VqjPTAjnMy9kHqFvtmVWNrHTz26\n" .
            "mFiUvrpaaipNTDyPVmYCc+Hx835c4oG5Y48kPaUD3yYlITYhUXJYNWWW9MVLfWJ4\n" .
            "oYhhrphe6cArlh2zYSzmKUabRLIv6goHlkc2iyLO/4sjp81Bbkx3PMptMuhjgD57\n" .
            "im2m3LYEtU6LmzRQQMhkKR2zbqSQUVm59qHY0+RCJ2AHq+mcGbMYUicyHJQQz/I6\n" .
            "QwkjJlJnPYU2aICJz/eBHyXQgz8p+EFjbzYms96VvqctixYKcTttqTUjWbzmrlne\n" .
            "94Xgf/wBAoGBAPGGaTqgI7dZ2fOuxL8wHFc4d4ZJpdNE5gLLon/eNemGIVqPEmcX\n" .
            "JeV8ye7VOO8/FY0HOQDnLxyqQ20wV/VsNYfcOLinAGvK5K8xMl7eoMqJwS7OiW7E\n" .
            "DrsQ/4mfvEfUSJjIuQYvWyj5ngIwK+PDmClu9FVQIPJPb24fLUI+NnyXAoGBANGS\n" .
            "qSjXjzZIG/v4zwGNAdMHoaiqpNEabpxe2loptsteWPMfMDq0pipnPpfFRPeH3P3w\n" .
            "Y0nYP1rqAcgNpKjoyWTsNwUCsF84w6Zb/vamY9viJRW6pxT0e/7Ap2fp+ZDKYa9B\n" .
            "D21Nz9bNfGdyIooJWwjP7gnGrQrcIsh8lIQkKbOJAoGABKAFTdkZNf6jfNYg8GRU\n" .
            "dpsfNtQcN9J+8RjDMN2pfKJT6y8INC8uS5m7KDavE23K1NuJjOngbhUYm3Osi4eZ\n" .
            "8tMVxvtzt5y4Cl7Pzx9GRvqiV2ofGZ7phU2LBzCm410+UqatXF/1x/AXxYT0ojTx\n" .
            "qgF07llNeDZrNNml/TnBw1sCgYEArdm6FjVrih4biNUH9ENjBgrIokCc5RHGPFW7\n" .
            "URxVlTM5GsX+nlSJm5d2JzTwV18PhmDKHNIVDHge7jPTKoOhveTuZ2upn/RY6UJb\n" .
            "qYSyRg+9r97dB9cgnV54AQ3ph6E7k8Sm5YetKIXh83aNDHFiYVcMInP7zIx9Fk+y\n" .
            "bEQLi/ECgYEAw02YwIL0Mx5MI1czJgT4bl4CvAXS2yqRFXbDMwA8DMqMqW037flB\n" .
            "j2z4i5vaEjhflsmaOGI8AWKHKqNre9IH+f1uhsnJlI2+54/6CsGuTc0b8Ok+vmbr\n" .
            "ElEEBRZxfUWfHfx52UOG2XjH+PFbqQcaAAn+lEhA6KT5IS+eiCT1qDw=\n" .
            "-----END RSA PRIVATE KEY-----"
		);
		$configuration->setPublicCert(
		    "-----BEGIN CERTIFICATE-----\n" .
            "MIIDtjCCAp4CCQDLor1+TWmmmDANBgkqhkiG9w0BAQUFADCBnDELMAkGA1UEBhMC\n" .
            "Y2wxEzARBgNVBAgTCnZhbHBhcmFpc28xFDASBgNVBAcTC3NhbiBhbnRvbmlvMR8w\n" .
            "HQYDVQQKExZ2aW5hIGhhY2llbmRhIHNhbiBqdWFuMRUwEwYDVQQDEww1OTcwMzU2\n" .
            "MjI1MzUxKjAoBgkqhkiG9w0BCQEWG2NvbnRhY3RvQGhhY2llbmRhc2FuanVhbi5j\n" .
            "bDAeFw0yMDA3MjgxODQ3NDNaFw0yNDA3MjcxODQ3NDNaMIGcMQswCQYDVQQGEwJj\n" .
            "bDETMBEGA1UECBMKdmFscGFyYWlzbzEUMBIGA1UEBxMLc2FuIGFudG9uaW8xHzAd\n" .
            "BgNVBAoTFnZpbmEgaGFjaWVuZGEgc2FuIGp1YW4xFTATBgNVBAMTDDU5NzAzNTYy\n" .
            "MjUzNTEqMCgGCSqGSIb3DQEJARYbY29udGFjdG9AaGFjaWVuZGFzYW5qdWFuLmNs\n" .
            "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAxbkaKSQDoZrscYVoiyil\n" .
            "u7XV1xFNVUmOPrUliupuPowsmYvMmnIIz2d2NaYoGoNd87rCmjH9aozxn4QGuIy2\n" .
            "7NbwupY2zKm27IW7VPiWg4pU/51IIG2tB+g89SYz+PV5PWFiiPQmXDyXN8mYFxYC\n" .
            "xyZ9xzxvTyl9LLXrnZDJ0D7ypVDASp3Q6AYZJ+4CenJJsiCJLn/IpoIy3yreDJfz\n" .
            "D+sDr8xKG7vYAVpryrKCYsovmy7GDXdusfkt0x8bPMwdsVWfNhXADZq+m0sxf8dk\n" .
            "6jLnK8xcfMLGIkaH6aWW+cQJ2zJjQk+/nVTj+QhBRpZzq1D42e2vF+Uw87QOlHVB\n" .
            "zwIDAQABMA0GCSqGSIb3DQEBBQUAA4IBAQAWfhfX99eIVXbJpOPYq3lUiFbES8jE\n" .
            "4Aat6S07iPmRL4eUxrvCyz+VXOW5sScas8IRr/Zs0WReI/51myUMOgF0TqKnIRAv\n" .
            "9xstrw65emfDQhgRlWO84HgFvwaATdcyJIt+REsPsHg4cm3BTjRRnkVO+TmcD+c2\n" .
            "nuGGN091IXbjF51idM5uZBAtrt8J+rEBJIb3MmBjeAYVoQ2CB/vtxxH+Wm4lril1\n" .
            "Q2PABp4iHykQFtjBL34dn7esMdOaEBTiTAmewK3LAEwSBYM9PR9ub2/vYGKWI2mu\n" .
            "nwLI8izuHHyyABC5ReAXrMasXNVBqA/+TdEwvYEarrDkY8H5IWuSwRRV\n" .
            "-----END CERTIFICATE-----\n"
		);
		$transaction 	= ( new Webpay($configuration))->getNormalTransaction();
	    $tokenWs    	=  filter_input(INPUT_POST, 'token_ws');
	    $result     	=  (array)$transaction->getTransactionResult($tokenWs);
	    $this->Session->write('transbank.webpayResponse', $result);
	    if(!isset($result['detailOutput'])){
	    	return $this->redirect(array('controller' => 'Pages', 'action' => 'errorPago'));
	    }
	    $output     	=   (array)$result['detailOutput'];
	    if($output['responseCode']==0){
	    	$this->mailPagoTBK();
	    	$this->Session->delete('carrito');
	    }
		
	    $this->set(compact('output', 'result', 'tokenWs'));
	}


	public function mailPagoTBK(){
		$resumenId=$this->guardaVentaTrans();
		if($resumenId){
			$carrito=$this->Session->read('carrito');
			$cliente=$this->Session->read('cliente');
			$totalCarrito=array();
			foreach ($carrito as $key => $value) {
				$valorItem=$value['VinaProducto']['precio']*$value['VinaProducto']['cantidad'];
				array_push($totalCarrito, $valorItem);
			}	
			$totalCarrito=array_sum($totalCarrito);
			$monto=$this->Session->read('infoCompra.monto');
			$despacho=$this->Session->read('infoCompra.valDespacho');
			$mail=$cliente['VinaUsuario']['mail'];
			App::uses('CakeEmail', 'Network/Email');
			$this->CakeEmail = new CakeEmail();
			$this->CakeEmail 
			->emailFormat('html')
			->template('pagotbk')
			->viewVars(compact('carrito', 'monto', 'totalCarrito', 'despacho', 'resumenId'))
			->from(array('contacto@haciendasanjuan.cl' => 'Tienda On Line'))
			->subject('Compra exitosa Hacienda San Juan')
			->bcc('contacto@haciendasanjuan.cl')
			->to($mail);
			if($this->CakeEmail->send()){
				$this->Session->delete('carrito');
				if($this->Session->check('compraNoUser')){
					$this->Session->delete('cliente');
				}
				return 3;
			}else{
				return 2;
			}
		}else{
			return 5;
		}
	}
	private function guardaVentaTrans(){
		if($this->Session->check('carrito')){
			if($this->Session->check('cliente')){
				$carrito=$this->Session->read('carrito');
				$cliente=$this->Session->read('cliente');
				$totalCarrito=array();
				$totalProductos=array();
				foreach ($carrito as $key => $value) {
					$valorItem=$value['VinaProducto']['precio']*$value['VinaProducto']['cantidad'];
					array_push($totalCarrito, $valorItem);
					array_push($totalProductos, $value['VinaProducto']['cantidad']);
				}	
				$totalCarrito=array_sum($totalCarrito);
				$totalProductos=array_sum($totalProductos);
				date_default_timezone_set('America/Santiago');
				$fecha= date('Y-m-d H:i:s', time());
				$dataSaveResumen['VinaVentaResumen']['productos']=$totalProductos;
				$dataSaveResumen['VinaVentaResumen']['total']=$totalCarrito;
				$dataSaveResumen['VinaVentaResumen']['fecha']=$fecha;
				$dataSaveResumen['VinaVentaResumen']['usuario_id']=$cliente['VinaUsuario']['id'];
				$dataSaveResumen['VinaVentaResumen']['estado']=1;
				$dataSaveResumen['VinaVentaResumen']['data_despacho']=json_encode($this->Session->read('infoDespachoBD'));
				$this->loadModel('VinaVentaResumen');
				if($this->VinaVentaResumen->save($dataSaveResumen)){
					$resumenId=$this->VinaVentaResumen->id;
					$dataDetalle=array();
					foreach ($carrito as $key => $value) {
						$varDataDetalle['VinaVentaDetalle']['producto_id']=$value['VinaProducto']['id'];
						$varDataDetalle['VinaVentaDetalle']['precio']=$value['VinaProducto']['precio'];
						$varDataDetalle['VinaVentaDetalle']['cantidad']=$value['VinaProducto']['cantidad'];
						$varDataDetalle['VinaVentaDetalle']['vina_venta_resumen_id']=$resumenId;
						array_push($dataDetalle, $varDataDetalle);
					}
					$this->loadModel('VinaVentaDetalle');
					if($this->VinaVentaDetalle->saveAll($dataDetalle)){
						return $resumenId;
					}else{
						return false;
					}
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
}




	