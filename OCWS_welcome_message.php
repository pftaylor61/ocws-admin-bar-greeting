<?php
/*
Plugin Name: OCWS Admin Bar Greeting
Plugin URI: http://oldcastleweb.com/pws/plugins
Description: This plugin enables the admin bar welcome message, which says "howdy" by default, to be changed to something more appropriate. the plugin has been produced by <a href="http://www.oldcastleweb.com" target="_blank">Old Castle Web Solutions</a>.<br /><br />The plugin class file contains some experimental code, currently commented out. Explanations of this code are given in the file concerned.
Version: 1.6
Author: Paul Taylor
Author URI: http://oldcastleweb.com/pws/about
License: GPL2
Text Domain: ocws-admin-bar-greeting
GitHub Plugin URI: https://github.com/pftaylor61/ocws-admin-bar-greeting
GitHub Branch:     master
*/
/*  Copyright 2012  Paul Taylor  (email : info@oldcastleweb.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
	require_once( 'class/OCWS_welcome_message.class.php' );
	
	global $OCWS_wmsg;
	

if(class_exists("OCWS_welcome_message")){
	$OCWS_wmsg = new OCWS_welcome_message();
}

// Add settings link on plugin page
function OCWS_welcome_message_settings_link($links) { 
  $settings_link = '<a href="options-general.php?page=admin-bar-welcome">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}
 
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'OCWS_welcome_message_settings_link' );


?>
