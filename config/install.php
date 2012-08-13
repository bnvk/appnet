<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:			Social Igniter : App.Net : Install
* Author: 		Localhost
* 		  		hi@brennannovak.com
*          
* Project:		http://social-igniter.com/
*
* Description: 	Installer values for App.Net for Social Igniter 
*/

/* Settings */
$config['appnet_settings']['widgets']			= 'TRUE';
$config['appnet_settings']['enabled']			= 'TRUE';
$config['appnet_settings']['create_permission'] 	= '3';
$config['appnet_settings']['publish_permission']	= '2';
$config['appnet_settings']['manage_permission']	= '2';
$config['appnet_settings']['client_id']	 			= '';
$config['appnet_settings']['client_secret'] 			= '';
$config['appnet_settings']['social_login'] 			= 'TRUE';
$config['appnet_settings']['login_redirect']			= 'home/';
$config['appnet_settings']['social_connection'] 		= 'TRUE';
$config['appnet_settings']['connections_redirect']	= 'settings/connections/';
/* Sites */
$config['appnet_sites'][] = array(
	'url'		=> 'http://alpha.app.net/', 
	'module'	=> 'app-net',
	'type' 		=> 'remote', 
	'title'		=> 'App.net', 
	'favicon'	=> 'http://alpha.app.net/favicon.ico'
);

