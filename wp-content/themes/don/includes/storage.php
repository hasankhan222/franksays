<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage EJECT
 * @since EJECT 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get theme variable
if (!function_exists('eject_storage_get')) {
	function eject_storage_get($var_name, $default='') {
		global $EJECT_STORAGE;
		return isset($EJECT_STORAGE[$var_name]) ? $EJECT_STORAGE[$var_name] : $default;
	}
}

// Set theme variable
if (!function_exists('eject_storage_set')) {
	function eject_storage_set($var_name, $value) {
		global $EJECT_STORAGE;
		$EJECT_STORAGE[$var_name] = $value;
	}
}

// Check if theme variable is empty
if (!function_exists('eject_storage_empty')) {
	function eject_storage_empty($var_name, $key='', $key2='') {
		global $EJECT_STORAGE;
		if (!empty($key) && !empty($key2))
			return empty($EJECT_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return empty($EJECT_STORAGE[$var_name][$key]);
		else
			return empty($EJECT_STORAGE[$var_name]);
	}
}

// Check if theme variable is set
if (!function_exists('eject_storage_isset')) {
	function eject_storage_isset($var_name, $key='', $key2='') {
		global $EJECT_STORAGE;
		if (!empty($key) && !empty($key2))
			return isset($EJECT_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return isset($EJECT_STORAGE[$var_name][$key]);
		else
			return isset($EJECT_STORAGE[$var_name]);
	}
}

// Inc/Dec theme variable with specified value
if (!function_exists('eject_storage_inc')) {
	function eject_storage_inc($var_name, $value=1) {
		global $EJECT_STORAGE;
		if (empty($EJECT_STORAGE[$var_name])) $EJECT_STORAGE[$var_name] = 0;
		$EJECT_STORAGE[$var_name] += $value;
	}
}

// Concatenate theme variable with specified value
if (!function_exists('eject_storage_concat')) {
	function eject_storage_concat($var_name, $value) {
		global $EJECT_STORAGE;
		if (empty($EJECT_STORAGE[$var_name])) $EJECT_STORAGE[$var_name] = '';
		$EJECT_STORAGE[$var_name] .= $value;
	}
}

// Get array (one or two dim) element
if (!function_exists('eject_storage_get_array')) {
	function eject_storage_get_array($var_name, $key, $key2='', $default='') {
		global $EJECT_STORAGE;
		if (empty($key2))
			return !empty($var_name) && !empty($key) && isset($EJECT_STORAGE[$var_name][$key]) ? $EJECT_STORAGE[$var_name][$key] : $default;
		else
			return !empty($var_name) && !empty($key) && isset($EJECT_STORAGE[$var_name][$key][$key2]) ? $EJECT_STORAGE[$var_name][$key][$key2] : $default;
	}
}

// Set array element
if (!function_exists('eject_storage_set_array')) {
	function eject_storage_set_array($var_name, $key, $value) {
		global $EJECT_STORAGE;
		if (!isset($EJECT_STORAGE[$var_name])) $EJECT_STORAGE[$var_name] = array();
		if ($key==='')
			$EJECT_STORAGE[$var_name][] = $value;
		else
			$EJECT_STORAGE[$var_name][$key] = $value;
	}
}

// Set two-dim array element
if (!function_exists('eject_storage_set_array2')) {
	function eject_storage_set_array2($var_name, $key, $key2, $value) {
		global $EJECT_STORAGE;
		if (!isset($EJECT_STORAGE[$var_name])) $EJECT_STORAGE[$var_name] = array();
		if (!isset($EJECT_STORAGE[$var_name][$key])) $EJECT_STORAGE[$var_name][$key] = array();
		if ($key2==='')
			$EJECT_STORAGE[$var_name][$key][] = $value;
		else
			$EJECT_STORAGE[$var_name][$key][$key2] = $value;
	}
}

// Merge array elements
if (!function_exists('eject_storage_merge_array')) {
	function eject_storage_merge_array($var_name, $key, $value) {
		global $EJECT_STORAGE;
		if (!isset($EJECT_STORAGE[$var_name])) $EJECT_STORAGE[$var_name] = array();
		if ($key==='')
			$EJECT_STORAGE[$var_name] = array_merge($EJECT_STORAGE[$var_name], $value);
		else
			$EJECT_STORAGE[$var_name][$key] = array_merge($EJECT_STORAGE[$var_name][$key], $value);
	}
}

// Add array element after the key
if (!function_exists('eject_storage_set_array_after')) {
	function eject_storage_set_array_after($var_name, $after, $key, $value='') {
		global $EJECT_STORAGE;
		if (!isset($EJECT_STORAGE[$var_name])) $EJECT_STORAGE[$var_name] = array();
		if (is_array($key))
			eject_array_insert_after($EJECT_STORAGE[$var_name], $after, $key);
		else
			eject_array_insert_after($EJECT_STORAGE[$var_name], $after, array($key=>$value));
	}
}

// Add array element before the key
if (!function_exists('eject_storage_set_array_before')) {
	function eject_storage_set_array_before($var_name, $before, $key, $value='') {
		global $EJECT_STORAGE;
		if (!isset($EJECT_STORAGE[$var_name])) $EJECT_STORAGE[$var_name] = array();
		if (is_array($key))
			eject_array_insert_before($EJECT_STORAGE[$var_name], $before, $key);
		else
			eject_array_insert_before($EJECT_STORAGE[$var_name], $before, array($key=>$value));
	}
}

// Push element into array
if (!function_exists('eject_storage_push_array')) {
	function eject_storage_push_array($var_name, $key, $value) {
		global $EJECT_STORAGE;
		if (!isset($EJECT_STORAGE[$var_name])) $EJECT_STORAGE[$var_name] = array();
		if ($key==='')
			array_push($EJECT_STORAGE[$var_name], $value);
		else {
			if (!isset($EJECT_STORAGE[$var_name][$key])) $EJECT_STORAGE[$var_name][$key] = array();
			array_push($EJECT_STORAGE[$var_name][$key], $value);
		}
	}
}

// Pop element from array
if (!function_exists('eject_storage_pop_array')) {
	function eject_storage_pop_array($var_name, $key='', $defa='') {
		global $EJECT_STORAGE;
		$rez = $defa;
		if ($key==='') {
			if (isset($EJECT_STORAGE[$var_name]) && is_array($EJECT_STORAGE[$var_name]) && count($EJECT_STORAGE[$var_name]) > 0) 
				$rez = array_pop($EJECT_STORAGE[$var_name]);
		} else {
			if (isset($EJECT_STORAGE[$var_name][$key]) && is_array($EJECT_STORAGE[$var_name][$key]) && count($EJECT_STORAGE[$var_name][$key]) > 0) 
				$rez = array_pop($EJECT_STORAGE[$var_name][$key]);
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if (!function_exists('eject_storage_inc_array')) {
	function eject_storage_inc_array($var_name, $key, $value=1) {
		global $EJECT_STORAGE;
		if (!isset($EJECT_STORAGE[$var_name])) $EJECT_STORAGE[$var_name] = array();
		if (empty($EJECT_STORAGE[$var_name][$key])) $EJECT_STORAGE[$var_name][$key] = 0;
		$EJECT_STORAGE[$var_name][$key] += $value;
	}
}

// Concatenate array element with specified value
if (!function_exists('eject_storage_concat_array')) {
	function eject_storage_concat_array($var_name, $key, $value) {
		global $EJECT_STORAGE;
		if (!isset($EJECT_STORAGE[$var_name])) $EJECT_STORAGE[$var_name] = array();
		if (empty($EJECT_STORAGE[$var_name][$key])) $EJECT_STORAGE[$var_name][$key] = '';
		$EJECT_STORAGE[$var_name][$key] .= $value;
	}
}

// Call object's method
if (!function_exists('eject_storage_call_obj_method')) {
	function eject_storage_call_obj_method($var_name, $method, $param=null) {
		global $EJECT_STORAGE;
		if ($param===null)
			return !empty($var_name) && !empty($method) && isset($EJECT_STORAGE[$var_name]) ? $EJECT_STORAGE[$var_name]->$method(): '';
		else
			return !empty($var_name) && !empty($method) && isset($EJECT_STORAGE[$var_name]) ? $EJECT_STORAGE[$var_name]->$method($param): '';
	}
}

// Get object's property
if (!function_exists('eject_storage_get_obj_property')) {
	function eject_storage_get_obj_property($var_name, $prop, $default='') {
		global $EJECT_STORAGE;
		return !empty($var_name) && !empty($prop) && isset($EJECT_STORAGE[$var_name]->$prop) ? $EJECT_STORAGE[$var_name]->$prop : $default;
	}
}
?>