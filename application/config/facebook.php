<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	//facebook api information goes here


	$config['api_id']       = '233297734151372';
	$config['api_secret']   = '713743ab17fcbd93fabdbbe4e8b00ec1';
	$config['redirect_url'] = base_url().'home/facebook_login';  //change this if you are not using my fb controller
	$config['logout_url']   = 'http://localhost/tony_stark/new/fb/';          //User will be redirected here when he logs out.
	$config['permissions']  = array('email','public_profile');
