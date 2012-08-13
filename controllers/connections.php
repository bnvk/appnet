<?php
class Connections extends MY_Controller
{
	protected $consumer;
	protected $appnet;
	protected $module_site;

    function __construct()
    {
        parent::__construct();
		   
		if (config_item('appnet_enabled') != 'TRUE') redirect(base_url());
	
		// Load Library
        $this->load->library('oauth2');
		
		// Get Site
		$this->module_site = $this->social_igniter->get_site_view_row('module', 'appnet');	
	}

	function index()
	{
		redirect(base_url());
	}

    // For OAuth2
    function add()
    {
        $provider = $this->oauth2->provider('appnet', array(
            'id' 	 => config_item('appnet_client_id'),
            'secret' => config_item('appnet_client_secret'),
            'scope'	 => 'stream','email','write_post','follow','messages','export'
        ));

        if (!isset($_GET['code']))
        {
            $provider->authorize();
        }
        else
        {
            try
            {
            	// Get Access Token
	            $token = $provider->access($_GET['code']);

	            // Get User
	            $user = $provider->get_user_info($token);

                $connection_data = array(
                  'site_id'				=> $this->module_site->site_id,
                  'user_id'				=> $this->session->userdata('user_id'),
                  'module'				=> 'appnet',
                  'type'				=> 'primary',
                  'connection_user_id'	=> $user['uid'],
                  'connection_username'	=> $user['nickname'],
                  'auth_one'			=> $token->access_token
                );

                $connection = $this->social_auth->add_connection($connection_data);
                $this->social_auth->set_userdata_connections($this->session->userdata('user_id'));
                $this->session->set_flashdata('message', 'App.Net account connected');

                redirect(connections_redirect(config_item('appnet_connections_redirect')), 'refresh');
            }
            catch (OAuth2_Exception $e)
            {
                show_error('That didnt work: '.$e);
            }
        }
    }
    
} 