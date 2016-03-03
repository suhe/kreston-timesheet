<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['base_url']	= (isset($_SERVER['HTTPS']) ? 'https://' : 'http://').$_SERVER['HTTP_HOST']."/";
$config['index_page'] = "";
$config['uri_protocol']	= "QUERY_STRING";
$config['url_suffix'] = "";
$config['language']	= "english";
$config['charset'] = "UTF-8";
$config['enable_hooks'] = FALSE;
$config['subclass_prefix'] = 'MY_';
$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';
$config['enable_query_strings'] = FALSE;
$config['controller_trigger'] 	= 'c';
$config['function_trigger'] 	= 'm';
$config['directory_trigger'] 	= 'd'; // experimental not currently in use
$config['log_threshold'] = 0;
$config['log_path'] = '';
$config['log_date_format'] = 'Y-m-d H:i:s';
$config['cache_path'] = '';
$config['encryption_key'] = "";
$config['sess_cookie_name']		= 'ci_session';
$config['sess_expiration']		= 7200;
$config['sess_encrypt_cookie']	= FALSE;
$config['sess_use_database']	= FALSE;
$config['sess_table_name']		= 'ci_sessions';
$config['sess_match_ip']		= FALSE;
$config['sess_match_useragent']	= TRUE;
$config['sess_time_to_update'] 	= 300;
$config['cookie_prefix']	= "";
$config['cookie_domain']	= "";
$config['cookie_path']		= "/";
$config['global_xss_filtering'] = TRUE;
$config['compress_output'] = FALSE;
$config['time_reference'] = 'local';
$config['timezone'] = 'Asia/Jakarta';
$config['rewrite_short_tags'] = FALSE;
$config['proxy_ips'] = '';


/* End of file config.php */
/* Location: ./system/application/config/config.php */