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
		
		if ($connection = $this->social_auth->check_connection_user($this->session->userdata('user_id'), 'appnet', 'primary'))
		{
			$this->load->library('appnet_api', array('access_token' =>$connection->auth_one));
		}
		else
		{
			redirect('settings/connections');	
		}
	}
	
	function timeline()
	{
		$this->data['sub_title'] = 'Timeline';
		
		$timeline = $this->appnet_api->getPublicPosts();
	
		print_r($timeline);
	
		$this->render();
	}
}