<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:			Social Igniter : App.Net : API Controller
* Author: 		Localhost
* 		  		hi@brennannovak.com
* 
* Project:		http://social-igniter.com
* 
* Description: This file is for the App.Net API Controller class
*/
class Api extends Oauth_Controller
{
    function __construct()
    {
        parent::__construct();
	}

    /* Install App */
	function install_get()
	{
		// Load
		$this->load->library('installer');
		$this->load->config('install');

		// Settings & Create Folders
		$settings = $this->installer->install_settings('appnet', config_item('appnet_settings'));

		// Site
		$site = $this->installer->install_sites(config_item('appnet_sites'));		

		if ($settings == TRUE)
		{
            $message = array('status' => 'success', 'message' => 'Yay, the App.Net App was installed');
        }
        else
        {
            $message = array('status' => 'error', 'message' => 'Dang App.Net App could not be installed');
        }		
		
		$this->response($message, 200);
	} 

	function social_post_authd_post()
	{	
        if ($connection = $this->social_auth->check_connection_user($this->oauth_user_id, 'appnet', 'primary'))
		{
			$appnet_config = array(
				'access_token'	=> $connection->auth_one
			);

        	$this->load->library('appnet_api', $appnet_config);

			$response = $this->appnet_api->createPost($this->input->post('content'));

			$message = array('status' => 'success', 'message' => 'Posted to App.net successfully', 'data' => $response);
        }
        else
        {
			$message = array('status' => 'error', 'message' => 'You do not have an App.net account connected');	        
        }
	
	    $this->response($message, 200);
	}

}