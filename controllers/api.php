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
			// Load Library
			$req = 'https://alpha-api.app.net/stream/0/posts';

			// Post Update
			$params = array(
				'text'			=> $this->input->post('content'), 
				'reply_to'		=> '',
				'annotations'	=> '',
				'links'			=> ''
			);

			$ch = curl_init($req);
			curl_setopt($ch, CURLOPT_POST, true);
			$access_token = $connection->auth_one;
			
			curl_setopt($ch,CURLOPT_HTTPHEADER,array('Authorization: Bearer '.$access_token));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$qs = http_build_query($params);

			curl_setopt($ch, CURLOPT_POSTFIELDS, $qs);
			$response = curl_exec($ch); 
			
			curl_close($ch);
			$response = json_decode($response, true);


			$message = array('status' => 'success', 'message' => 'Posted to App.net successfully', 'data' => $response);
		}
		else
		{
			$message = array('status' => 'error', 'message' => 'Oops, could not post to App.net');
		}
	
	    $this->response($message, 200);
	}

}