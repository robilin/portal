<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/*
 *	@author : Venance Edson
 *  @support: support@xchangewallet.com
 *	date	: dec, 2016
 *	TemboPos
 *	http://www.xchangewallet.com
 *  version: 1.0
 */

class Vodacoms extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('global_model');
        $this->load->helper('form');
    }

    public function index(){

        
    }
    
public function getInitialResponse($conversationID,$originatorConversationID,$transactionID,$serviceID,$responseCode,$responseDesc,$serviceStatus,$initiator)
{
	$config = require realpath(__DIR__.'/../../../includes/config.inc.php');

	$dom = new DOMDocument('1.0','UTF-8');
	$dom->formatOutput = true;
	$version="2.0";

	$namespaceuri=$config['SomeNameThatShouldBeChanged']['URLs']['infowise'];
	$root = $dom->createElementNS($namespaceuri,'mpesaBroker'); //append namespace to root
	$root->appendChild($dom->createAttribute('version'))->appendChild($dom->createTextNode($version)); //append version 2.0
	$dom->appendChild($root);
	$response = $dom->createElement('response');
	$root->appendChild($response);
 	
	$response->appendChild($dom->createElement('conversationID', $conversationID) );
	$response->appendChild($dom->createElement('originatorConversationID', $originatorConversationID) );
	$response->appendChild($dom->createElement('transactionID', $transactionID) );
    $response->appendChild($dom->createElement('serviceID', $serviceID) );
    $response->appendChild($dom->createElement('responseCode', $responseCode) );
    $response->appendChild($dom->createElement('responseDesc', $responseDesc) );
    $response->appendChild($dom->createElement('serviceStatus', $serviceStatus) );
    
	$log_file='log.xml/'.$initiator.'_'.'intial_response_'.date('m-d-Y_hia').'.xml';
	$dom->save($log_file) or die('XML Create Error');
	
	
    $output=$dom->saveXML();
	
	return $output;
	
	
	
}

public function postFinalResults($spId,$timestamp,$resultType,$resultCode,$resultDesc,$serviceReceipt,$serviceID,$originatorConversationID,$conversationID,$transactionID,$initiator,$url,$serviceDate,$spPassword)
{
	$config = require realpath(__DIR__.'/../../../includes/config.inc.php');

	$dom = new DOMDocument('1.0','UTF-8');
	$dom->formatOutput = true;
	$version="2.0";
	$namespaceuri=$config['SomeNameThatShouldBeChanged']['URLs']['infowise'];
	$root = $dom->createElementNS($namespaceuri,'mpesaBroker'); //append namespace to root
	$root->appendChild($dom->createAttribute('version'))->appendChild($dom->createTextNode($version)); //append version 2.0
	$dom->appendChild($root);
	$response = $dom->createElement('result');
	$servicep =$dom->createElement('serviceProvider');
	$trans =$dom->createElement('transaction');
	$response->appendChild($servicep);
	$response->appendChild($trans);
	$root->appendChild($response);
    
	$servicep->appendChild($dom->createElement('spId',$spId));
	$servicep->appendChild($dom->createElement('spPassword',$this->getPassword($spId,2)));
	//$servicep->appendChild($dom->createElement('spPassword',$spPassword));

	$servicep->appendChild($dom->createElement('timestamp',$timestamp));

	$trans->appendChild( $dom->createElement('resultType',$resultType));
	$trans->appendChild( $dom->createElement('resultCode',$resultCode));
	$trans->appendChild( $dom->createElement('resultDesc',$resultDesc));
	$trans->appendChild( $dom->createElement('serviceReceipt',$serviceReceipt));
	$trans->appendChild( $dom->createElement('serviceDate',$serviceDate));
	$trans->appendChild( $dom->createElement('serviceID',$serviceID));
	$trans->appendChild( $dom->createElement('originatorConversationID',$originatorConversationID));
	$trans->appendChild( $dom->createElement('conversationID',$conversationID)); 
	$trans->appendChild( $dom->createElement('transactionID',$transactionID));
	$trans->appendChild( $dom->createElement('initiator',$initiator)); 
	$trans->appendChild( $dom->createElement('initiatorPassword',$this->getpassword($spId,1)));
    	
	$log_file='log.xml/'.$initiator.'_'.'finalResult_'.date('m-d-Y_hia').'.xml';
	$dom->save($log_file) or die('XML Create Error');
		
	$callback_data=$dom->saveXML();
			$ch = curl_init($config['SomeNameThatShouldBeChanged']['URLs']['brokerIP']);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
			curl_setopt($ch, CURLOPT_POSTFIELDS, $callback_data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$results = curl_exec($ch);
			curl_close($ch);
        
	$flog_file='log.xml/'.$initiator.'_'.'confirmResult_'.date('m-d-Y_hia').'.xml';
	if (file_put_contents ($flog_file, $results) !== false) {
     echo 'Success!';
} else {
     echo 'Failed';
}

			
}

public function finalResponse($conversationID,$originatorConversationID,$transactionID,$serviceID,$responseCode,$responseDesc,$serviceStatus,$initiator){
	$config = require realpath(__DIR__.'/../../../includes/config.inc.php');

	$dom = new DOMDocument('1.0','UTF-8');
	$dom->formatOutput = true;
	$version="2.0";
	$namespaceuri=$config['SomeNameThatShouldBeChanged']['URLs']['infowise'];
	$root = $dom->createElementNS($namespaceuri,'mpesaBroker'); //append namespace to root
	$root->appendChild($dom->createAttribute('version'))->appendChild($dom->createTextNode($version)); //append version 2.0
	$dom->appendChild($root);
	$response = $dom->createElement('response');
	$root->appendChild($response);
   	
	//$response->setAttribute('id', 1);
	
	$response->appendChild( $dom->createElement('conversationID', $conversationID));
	$response->appendChild( $dom->createElement('originatorConversationID', $originatorConversationID));
	$response->appendChild( $dom->createElement('transactionID', $transactionID));
    	$response->appendChild( $dom->createElement('serviceID', $serviceID));
    	$response->appendChild( $dom->createElement('responseCode', $responseCode));
    	$response->appendChild( $dom->createElement('responseDesc', $responseDesc));
    	$response->appendChild( $dom->createElement('serviceStatus', $serviceStatus));
	
	$log_file='log.xml/'.$initiator.'_'.'final_response_'.date('m-d-Y_hia').'.xml';
	$dom->save($log_file) or die('XML Create Error');
    
	$output=$dom->saveXML();
	
	return $output;

}

  


}