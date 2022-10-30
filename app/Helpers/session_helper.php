<?php 
/**
 * Session Helper
 *
 * A simple session class helper for Codeigniter
 *
 * @package     Codeigniter Session Helper
 * @author      Dwayne Charrington
 * @copyright   Copyright (c) 2014, Dwayne Charrington
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 * @link        http://ilikekillnerds.com
 * @since       Version 1.0
 * @filesource
 */


if (!function_exists('session_valid'))
{
	function session_valid()
	{
		//echo 'session'.get_userdata('user_id');
		//print_r(all_userdata());
		if(get_userdata('user_id')== null)
			return false;
		else
			return true;
	}
}

if (!function_exists('get_userdata'))
{
    function get_userdata($key)
    {
        
        
        return $session->get($key);
    }
}

if (!function_exists('all_userdata'))
{
    function all_userdata()
    {
        
        
        return $session->get();
    }
}

if (!function_exists('set_userdata'))
{
    function set_userdata($key, $value)
    {
        
        
        return $session->set($key, $value);
    }
}

if (!function_exists('unset_userdata'))
{
    function unset_userdata($data)
    {
        
        
        return $session->remove($data);
    }
}

if (!function_exists('session_destroy'))
{
    function session_destroy()
    {
        
        
        return $session->destroy();
    }
}