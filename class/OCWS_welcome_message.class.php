<?php
if (!class_exists("OCWS_welcome_message")) {
	class OCWS_welcome_message {
		function OCWS_welcome_message() { // constructor
		

				/* Runs when plugin is activated */
				register_activation_hook(__FILE__,'welcome_message_install'); 

				/* Runs on plugin deactivation*/
				register_deactivation_hook( __FILE__, 'welcome_message_remove' );

				function welcome_message_install() {
				/* Creates new database field */
				add_option("welcome_message_data", 'Default', '', 'yes');
				}

				function welcome_message_remove() {
				/* Deletes the database field */
				delete_option('welcome_message_data');
				}
				
				// the function below was obtained from a tutorial on the Wordpress.org site. I then amended it to read from an options page.
				function replace_howdy( $wp_admin_bar ) {
					$my_account=$wp_admin_bar->get_node('my-account');
					$welcome_message = trim(get_option('welcome_message_data'));
					if (trim($welcome_message) == "") {
						$welcome_message = "Welcome";
					}
					$newtitle = str_replace( 'Howdy,', $welcome_message, $my_account->title );            
					$wp_admin_bar->add_node( array(
						'id' => 'my-account',
						'title' => $newtitle,
					) );
				}
				
				if ( is_admin() ){

				/* Call the html code */
				add_action('admin_menu', 'welcome_message_admin_menu');
				
				// add_action('admin_menu', 'ocws_plugin_menu');
				/*
				function ocws_plugin_menu() {
					add_plugins_page('OCWS Plugins', 'OCWS Plugins', 'read', 'ocws_plugin_config', 'welcome_message_admin_menu');
				} */

					function welcome_message_admin_menu() {
						global $ocws_tlm;
						$ocws_tlm = "options-general.php";
						// $ocws_tlm = "ocws_plugin_config";
						// I have used this variable, $ocws_tlm, so that at a later stage I can substitute it for a top-level admin page name
						add_submenu_page($ocws_tlm,'Admin Bar Greeting', 'OCWS Admin Greeting', 'administrator', 'admin-bar-welcome', 'admin_welcome_html_page');
					} // end welcome_message_admin_menu
				} // end 'if' section
				
				

				
				// This function produces a string of the path, removing the subdirectory that class files have been placed in, in order to compensate for the organizational advantage I get by putting these functions in a subfolder
				function OCWS_plugin_path() {
					global $ocws_pip;
					$ocws_pip = str_replace( '/class', '', plugins_url( plugin_basename( dirname( __FILE__ ) ) ) );
					return $ocws_pip;
				} // end OCWS_plugin_path
				
				// This function creates the Admin Options Page for the plugin.			
				function admin_welcome_html_page() {
				// This function creates the admin page
					// need 'if': This tests to see whether new data has been saved.
					    if( isset($_POST[ 'hidpageposted' ]) && $_POST[ 'hidpageposted' ] == 'Y' ) {
							echo "<div class=\"updated\"><p><strong>Settings saved.</strong></p></div>\n";
						}
					// end need 'if'
					echo "<div id=\"ocws_admin_page\" class=\"wrap\">\n";
					
					echo "<div style=\"background: transparent url(".OCWS_plugin_path()."/images/castlelogo32x39.png) no-repeat;\" id=\"icon-ocws\" class=\"icon32\"><br /></div>\n";
					?>
						<h2>Admin Bar Greeting</h2>
						<h3>An <a href="http://oldcastleweb.com" target="_blank">Old Castle Web Services</a> plugin</h3>
						<p>
							The right hand side of the Admin bar welcomes you with the greeting 'Howdy' by default. I find that greeting very irritating. This plugin changes that greeting to 'Welcome' by default, but you can change it to anything else that you like, by using the small form below.
						</p>
						<hr style="width:60%" /><br />
						<form method="post" action="options.php">
							<?php wp_nonce_field('update-options'); ?>

							<table style="width:510">
							<tr valign="top">
							<th style="width:92" scope="row">Enter Text</th>
							<td style="width:406">
							<input name="welcome_message_data" type="text" id="welcome_message_data"
							value="<?php echo get_option('welcome_message_data'); ?>" />
							(eg. Welcome)</td>
							</tr>
							</table>

							<input type="hidden" name="hidpageposted" value="Y" />
							<input type="hidden" name="action" value="update" />
							<input type="hidden" name="page_options" value="welcome_message_data" />

							<p class="submit">
							<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
							</p>

						</form>
					<?php
					echo "</div><!-- end of ocws_admin_page div -->\n";
				
				} // end admin_welcome_html_page
				
				// After all this organization and coding, the bit that actually does the work only takes one line!!!
				add_filter( 'admin_bar_menu', 'replace_howdy',25 );
				



		} // end constructor
	
	} // end class OCWS_welcome_message

} // end if


?>