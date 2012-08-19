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
	public $connection;
	public $module_site;

    function __construct()
    {
        parent::__construct();

		$this->load->config('appnet');

		$this->data['page_title'] = 'App.Net';
		
		// Connection
		if ($this->connection = $this->social_auth->check_connection_user($this->session->userdata('user_id'), 'appnet', 'primary'))
		{
			$this->load->library('appnet_api', array('access_token' => $this->connection->auth_one));
		}
		else
		{
			redirect('settings/connections');	
		}
		
		$this->module_site = $this->social_igniter->get_site_view_row('module', 'appnet');		
		
	}
	
	function timeline()
	{
		$this->data['sub_title'] = 'Timeline';
		
		$timeline		= $this->appnet_api->getPublicPosts();
		$timeline_view	= '';

		// Build Feed				 			
		if (!empty($timeline))
		{
			foreach ($timeline as $item)
			{
				// Item
				$this->data['item_id']				= $item['id'];
				$this->data['item_type']			= 'update';

				// Contributor
				$this->data['item_user_id']			= $item['user']['id'];
				$this->data['item_avatar']			= $item['user']['avatar_image']['url'];
				$this->data['item_contributor']		= $item['user']['name'];
				$this->data['item_profile']			= $this->module_site->url.$item['user']['username'];

				if ($item['text'])
				{
					$item_text = $item['text'];
				}
				else
				{
					$item_text = 'Could not find text';
				}

				// Activity
				$this->data['item_content']			= item_linkify($item_text);
				$this->data['item_content_id']		= $item['id'];
				$this->data['item_date']			= timezone_datetime_to_elapsed($item['created_at']);
				
				if ($item['source']['link'])
				{
					$source_link = $item['source']['link'];
					$source_name = $item['source']['name'];
				}
				else
				{
					$source_link = $this->module_site->url;
					$source_name = $this->module_site->title;					
				}
				
				$this->data['item_source']			= ' via <a href="'.$source_link.'">'.$source_name.'</a>';

		 		// Actions
			 	$this->data['item_comment']			= base_url().'comment/item/'.$item['id'];
			 	$this->data['item_comment_avatar']	= $this->data['logged_image'];
			 	
			 	$this->data['item_can_modify']		= FALSE; //$this->social_auth->has_access_to_modify('activity', $tweet, $this->session->userdata('user_id'), $this->session->userdata('user_level_id'));
				$this->data['item_edit']			= ''; //base_url().'home/'.$tweet->module.'/manage/'.$tweet->content_id;
				$this->data['item_delete']			= ''; //base_url().'api/activity/destroy/id/'.$tweet->activity_id;

				// View
				$timeline_view .= $this->load->view(config_item('dashboard_theme').'/partials/item_timeline.php', $this->data, true);
	 		}
	 	}
	 	else
	 	{
	 		$timeline_view = '<li><p>No tweets to show from anyone</p></li>';
 		}
 		
		$this->data['timeline_view'] 	= $timeline_view;
	
		$this->render();
	}
}