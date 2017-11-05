<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Vodacoms API configurations
 */
  
$config['vodacom_api_username']='mpesa';
$config['vodacom_api_password']='mpesa_password';
$config['vodacom_namespace']='http://infowise.co.tz/broker/';
$config['vodacom_call_back_url']='https://41.217.203.47:28443/broker/receive';

/*
 * Airtel API configurations
 */

$config['airtel_api_username']= 'airtelmoney_username';
$config['airtel_api_password']= 'airtelmoney_password';
$config['airtel_namespace']= 'http://tempuri.com';

/*
 * Tigo API configurations
 */

$config['tigo_api_username']= 'tigopesa_username';
$config['tigo_api_password']= 'tigopesa_password';

/*
 * Riverton Namespace
 */

$config['riverton_namespace']= 'http://riverton.co.tz/apis';

/*
 * xml version config
 */
$config['version']='2.0';