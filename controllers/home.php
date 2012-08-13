<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:			Social Igniter : App.Net : Home Controller
* Author: 		Localhost
* 		  		hi@brennannovak.com
* 
* Project:		http://social-igniter.com
* 
* Description: This file is for the App.Net Home Controller class
*/
class Home extends Dashboard_Controller
{
    function __construct()
    {
        parent::__construct();

		$this->load->config('appnet');

		$this->data['page_title'] = 'App.Net';
	}
	
	function custom()
	{
		$this->data['sub_title'] = 'Custom';
	
		$this->render();
	}
}