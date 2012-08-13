<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OAuth2_Provider_Appnet extends OAuth2_Provider {
	
	public $name = 'appnet';
	
	// https://api.github.com

	public function url_authorize()
	{
		return 'https://alpha.app.net/oauth/authenticate';
	}

	public function url_access_token()
	{
		return 'https://alpha.app.net/oauth/access_token';
	}

	public function get_user_info(OAuth2_Token_Access $token)
	{
		$url = 'https://alpha-api.app.net/stream/0/posts?'.http_build_query(array(
			'access_token' => $token->access_token,
		));

		$user = json_decode(file_get_contents($url));

		// Create a response from the request
		return array(
			'uid' => $user->id,
			'nickname' => $user->login,
			'name' => $user->name,
			'email' => $user->email
		);
	}

}