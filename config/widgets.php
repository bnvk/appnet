<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:			Social Igniter : App.Net : Widgets
* Author: 		Localhost
* 		  		hi@brennannovak.com
*          
* Project:		http://social-igniter.com/
*
* Description: 	Installer values for App.Net for Social Igniter 
*/

$config['appnet_widgets'][] = array(
	'regions'	=> array('sidebar','content'),
	'widget'	=> array(
		'module'	=> 'appnet',
		'name'		=> 'Recent Data',
		'method'	=> 'run',
		'path'		=> 'widgets_recent_data',
		'multiple'	=> 'FALSE',
		'order'		=> '1',
		'title'		=> 'Recent Data',
		'content'	=> ''
	)
);