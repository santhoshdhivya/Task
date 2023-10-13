<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
|  Google API Configuration
| -------------------------------------------------------------------
|  client_id         string   Your Google API Client ID.
|  client_secret     string   Your Google API Client secret.
|  redirect_uri      string   URL to redirect back to after login.
|  application_name  string   Your Google application name.
|  api_key           string   Developer key.
|  scopes            string   Specify scopes
*/
$config['google']['client_id']        = '892944293627-rvgsatikbfuqlsmmoqgi75gcfuaj4c9i.apps.googleusercontent.com';
$config['google']['client_secret']    = 'v43eiN5iGvLGu6XY_-tr5nnz';
$config['google']['redirect_uri']     = base_url().'google_login';
$config['google']['application_name'] = 'Vidiem';
$config['google']['api_key']          = 'AIzaSyBf3BT-STY7pboJVdOM48P1Am5qCU71iU0';
$config['google']['scopes']           = array();