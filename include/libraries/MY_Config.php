<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Config extends CI_Config {

	// {{{ Matchbox

	function module_load($module = FALSE, $file = '', $use_sections = FALSE, $fail_gracefully = FALSE)
	{
		return $this->load($file, $use_sections, $fail_gracefully, $module);
	}

	// }}}

	function load($file = '', $use_sections = FALSE, $fail_gracefully = FALSE, $module = FALSE)
	{
		$file = ($file == '') ? 'config' : str_replace(EXT, '', $file);

		if (in_array($file, $this->is_loaded, TRUE))
		{
			return TRUE;
		}

		// {{{ Matchbox

		$CI =& get_instance();

		if ( ! $mb_file = $CI->load->_mb_load('config/'.$file, $module))
		{
			if ($fail_gracefully === TRUE)
			{
				return FALSE;
			}
			show_error('Matchbox: The configuration file '.$file.EXT.' does not exist.');
		}

		include($mb_file);

		// }}}

		if ( ! isset($config) OR ! is_array($config))
		{
			if ($fail_gracefully === TRUE)
			{
				return FALSE;
			}

			// {{{ Matchbox

			show_error('Matchbox: Your '.$file.EXT.' file does not appear to contain a valid configuration array.');

			// }}}
		}

		if ($use_sections === TRUE)
		{
			if (isset($this->config[$file]))
			{
				$this->config[$file] = array_merge($this->config[$file], $config);
			}
			else
			{
				$this->config[$file] = $config;
			}
		}
		else
		{
			$this->config = array_merge($this->config, $config);
		}

		$this->is_loaded[] = $file;
		unset($config);

		// {{{ Matchbox

		log_message('debug', 'Matchbox: Config file loaded: config/'.$file.EXT);

		// }}}

		return TRUE;
	}

}

/* End of file MY_Config.php */
/* Location: ./system/application/libraries/MY_Config.php */