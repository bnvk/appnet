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

	function view_get()
    {
    	$this->load->model('data_model');

		$data	= $this->data_model->get_data($this->get('id'));    
   		 	
        if($data)
        {
            $message = array('status' => 'success', 'message' => 'Activity has been found', 'data' => $data);
        }
        else
        {
            $message = array('status' => 'error', 'message' => 'Could not find any Data');
        }

        $this->response($message, 200);
    }

    function create_authd_post()
    {    
    	$this->load->model('data_model');

		$data = array(
			'user_id'	=> $this->oauth_user_id,
			'text'		=> $this->input->post('text')
		);

		// Add Data
		if ($add_data = $this->data_model->add_data($data))
		{
        	$message = array('status' => 'success', 'message' => 'Data successfully created', 'data' => $add_data);
        }
        else
        {
	        $message = array('status' => 'error', 'message' => 'Oops unable to add data');
        }
	
        $this->response($message, 200);
    }
    
    function update_authd_get()
    {
    	$this->load->model('data_model');
    
    	$udpate_data = array(
    		'text'	=> $this->input->post('text')
    	);
    
		$update = $this->social_tools->update_data($this->get('id'), $update_data);			
    	
        if($update)
        {
            $message = array('status' => 'success', 'message' => 'Data was update');
        }
        else
        {
            $message = array('status' => 'error', 'message' => 'Could not update data');
        } 

        $this->response($message, 200);           
    }  

    function destroy_authd_get()
    { 
       	$this->load->model('data_model'); 
         
    	if ($this->data_model->delete_data($this->get('id')))
    	{   	
    		$message = array('status' => 'success', 'message' => 'Data was deleted');
    	}
    	else
    	{
    		$message = array('status' => 'error', 'message' => 'Oops Data was not deleted');        	
    	}
        
        $this->response($message, 200);
    }

}