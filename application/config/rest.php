<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| REST Controller Settings
|--------------------------------------------------------------------------
|
| Controller-wide settings for the RESTful services.
|
*/

// Note: This is a default config file. For the latest version, check
// the official repository: https://github.com/chriskacerguis/codeigniter-restserver

/*
|--------------------------------------------------------------------------
| REST Language File
|--------------------------------------------------------------------------
|
| The language file containing error messages and other language items.
|
*/
$config['rest_language'] = 'english';

/*
|--------------------------------------------------------------------------
| REST Status Field Name
|--------------------------------------------------------------------------
|
| The field name for the status inside the response body.
|
*/
$config['rest_status_field_name'] = 'status';

/*
|--------------------------------------------------------------------------
| REST Message Field Name
|--------------------------------------------------------------------------
|
| The field name for the message inside the response body.
|
*/
$config['rest_message_field_name'] = 'error';

/*
|--------------------------------------------------------------------------
| Enable Emulate Request
|--------------------------------------------------------------------------
|
| Should we enable emulation of the request?
|
*/
$config['enable_emulate_request'] = TRUE;

/*
|--------------------------------------------------------------------------
| REST Realm
|--------------------------------------------------------------------------
|
| Name of the password protected REST API displayed on the login dialog screen.
|
*/
$config['rest_realm'] = 'rest_api';

/*
|--------------------------------------------------------------------------
| REST Login
|--------------------------------------------------------------------------
|
| Set to specify the REST API requires to be logged in.
|
*/
$config['rest_auth'] = FALSE;

/*
|--------------------------------------------------------------------------
| REST Login
|--------------------------------------------------------------------------
|
| Set to specify the REST API requires to be logged in.
|
| 'basic'            = Send username and password in the 'Authorization' header.
| 'digest'           = Use a digest based auth system.
| 'session'          = Use CodeIgniter's session library.
| 'key'              = Use a key allowing systems to connect to the API.
| 'oauth2'           = Use OAuth2's access token.
| 'token'            = Use a token allowing systems to connect to the API.
|
*/
$config['rest_valid_logins'] = ['admin' => '1234'];

/*
|--------------------------------------------------------------------------
| Global HTTP Vocab
|--------------------------------------------------------------------------
|
| Tell the server what verbs are supported by default.
|
*/
$config['global_http_methods'] = [
    'get',
    'post',
    'put',
    'delete',
    'patch',
    'options',
    'head',
];

/*
|--------------------------------------------------------------------------
| REST Enable Keys
|--------------------------------------------------------------------------
|
| When set to TRUE, the REST API will check for a key passed in the header.
|
| Default table name: 'keys'
|
*/
$config['composer_autoload'] = TRUE;

/*
|--------------------------------------------------------------------------
| REST Key Column Name
|--------------------------------------------------------------------------
|
| The column name for the REST API key in the database.
|
*/
$config['rest_key_column'] = 'key';

/*
|--------------------------------------------------------------------------
| REST Key Length
|--------------------------------------------------------------------------
|
| The length of the REST API key.
|
|
*/
$config['rest_key_length'] = 40;

/*
|--------------------------------------------------------------------------
| REST Key Name
|--------------------------------------------------------------------------
|
| The name of the header or query string parameter for the REST API key.
|
|
*/
$config['rest_key_name'] = 'X-API-KEY';

/*
|--------------------------------------------------------------------------
| REST Enable Logging
|--------------------------------------------------------------------------
|
| When set to TRUE, the REST API will log requests.
|
|
*/
$config['rest_enable_logging'] = FALSE;

/*
|--------------------------------------------------------------------------
| REST Log Table Name
|--------------------------------------------------------------------------
|
| If logging is enabled, the table name to log to.
|
*/
$config['rest_logs_table'] = 'logs';

/*
|--------------------------------------------------------------------------
| REST Enable Limits
|--------------------------------------------------------------------------
|
| When set to TRUE, the REST API will check to see if the key has been
| overused within a certain time period.
|
|
*/
$config['rest_enable_limits'] = FALSE;

/*
|--------------------------------------------------------------------------
| REST Limits Table Name
|--------------------------------------------------------------------------
|
| If limits is enabled, the table name to log to.
|
*/
$config['rest_limits_table'] = 'limits';

/*
|--------------------------------------------------------------------------
| REST Ignore HTTP Accept
|--------------------------------------------------------------------------
|
| Set to TRUE to ignore the HTTP Accept and speed up each request a little.
| Only do this if you are dealing with a client that accepts all formats.
|
*/
$config['rest_ignore_http_accept'] = FALSE;

/*
|--------------------------------------------------------------------------
| REST AJAX Only
|--------------------------------------------------------------------------
|
| Set to TRUE to only allow AJAX requests.
|
*/
$config['rest_ajax_only'] = FALSE;

/*
|--------------------------------------------------------------------------
| REST Allowed Origins
|--------------------------------------------------------------------------
|
| A list of origins that are allowed to access the REST API.
|
*/
$config['rest_allowed_origins'] = [];

/*
|--------------------------------------------------------------------------
| REST Forced Overrides
|--------------------------------------------------------------------------
|
| A list of methods that will be forced to override the same method name.
|
*/
$config['forced_overrides'] = [];

/*
|--------------------------------------------------------------------------
| REST Allowed HTTP Methods
|--------------------------------------------------------------------------
|
| A list of HTTP methods that are allowed.
|
*/
$config['allowed_http_methods'] = [
    'get',
    'delete',
    'post',
    'put',
    'options',
    'patch',
    'head',
];