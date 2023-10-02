<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('activate_directory')) {
	function activate_directory($folder)
	{
		// Getting CI class instance.
		$CI = get_instance();
		// Getting router directory to active.
		$directory = $CI->router->fetch_directory();
		return ($directory == $folder) ? 'active' : '';
	}
}

if (!function_exists('activate_module')) {
	function activate_module($module)
	{
		// Getting CI class instance.
		$CI = get_instance();
		// Getting router module to active.
		$module_ = $CI->router->fetch_module();
		return ($module_ == $module) ? 'active' : '';
	}
}

if (!function_exists('activate_menu')) {
	function activate_menu($controller)
	{
		// Getting CI class instance.
		$CI = get_instance();
		// Getting router class to active.
		$class = $CI->router->fetch_class();
		return ($class == $controller) ? 'active' : '';
	}
}
function submenu($tbl)
{
	$CI = &get_instance();
	$CI->db->select('*');
	$CI->db->from($tbl);
	$query = $CI->db->get();
	return $query->result();
}

if (!function_exists('show_menu')) {
	function show_menu($rules)
	{
		// Getting CI class instance.
		$CI = get_instance();
		//check available rule
		$show_menu = check_menu($rules);
		// Getting router class to active.
		return ($show_menu == '1') ? 'block' : 'none';
	}

	function check_menu($rules){
	    // Getting CI class instance.
        $CI = get_instance();
		$privilege = $CI->session->userdata('privilege');
		if($privilege == 1){
			return '1';
		}
		else{
			//check available rules
			$query = $CI->db->get_where('menu_akses',array('privilege'=>$privilege, 'url'=>$rules));
			if($query->num_rows() > 0){
				return '1';
			}
			else{
				return '0';
			}
		}
	}
}
