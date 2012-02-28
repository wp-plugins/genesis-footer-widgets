<?php
/*
Plugin Name: Genesis Footer Widgets
Plugin URI: http://www.ramoonus.nl/wordpress/genesis-footer-widgets/
Description: Adds 3 or 4 footer widget areas to the Genesis Theme Framework version 1.6 or higher. 
Version: 1.1.1
Author: Ramoonus
Author URI: http://www.ramoonus.nl/
*/

// Declare variables
$gfw_version = '1.1.1';

// Initialize function
function gfw_init() {
	// CSS
	wp_deregister_style('gfw-core');
	wp_enqueue_style('gfw-core', plugins_url('/css/gfw.css', __FILE__), false, $gfw_version);
	
	// Textdomain
	load_plugin_textdomain( 'gfw', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );	

	// Load Options	
	$gfw_option = get_option('gfw');
	
	// CSS part 2
	if ($gfw_option = 3) { 
		wp_deregister_style('gfw3');
		wp_enqueue_style('gfw3', plugins_url('/css/gfw3.css', __FILE__), false, $gfw_version);
	}
	elseif ($gfw_option = 4) {  
		wp_deregister_style('gfw4');
		wp_enqueue_style('gfw4', plugins_url('/css/gfw4.css', __FILE__), false, $gfw_version);
	}
	
}
add_action('init', 'gfw_init');
	
	
function gfw_admin_style(){
        wp_enqueue_style( 'gfw-admin', plugins_url('/gfw-admin.js', __FILE__) , false, $gfw_version );
}
add_action('admin_enqueue_scripts', 'gfw_admin_style');


// Activation
function gfw_activate() {
	// Detect if genesis is loaded
	gwf_detect_genesis();
	// Install option	
	add_option('gfw', '3', '', 'yes');
	// Flush Cache
	gfw_flushcache(); 
}
register_activation_hook( __FILE__, 'gfw_activate' );

// Deactivation
function gfw_deactivate() {
	// Delete option	
	delete_option('gfw');
	// Flush Cache
	gfw_flushcache(); 
}
register_deactivation_hook( __FILE__, 'gfw_deactivate' );

// Flush Cache function
function gfw_flushcache() {
	// W3TC
	// WP SC
}

function gfw_core() {
	
	if ($gfw_option = 3) { 
		/** Add support for 3-column footer widgets **/
		add_theme_support('genesis-footer-widgets', 3 );
	}
	if ($gfw_option = 4) {  
		/** Add support for 4-column footer widgets **/
		add_theme_support('genesis-footer-widgets', 4 );
	}
	
}
add_action('after_setup_theme', 'gfw_core');


/* Detect if template is genesis */
function gwf_detect_genesis() {	
	// versions
	$latest = '1.7.1';
	$minimum = '1.6';
	
	if ( basename( get_template_directory() ) != 'genesis' ) {		
		deactivate_plugins( plugin_basename( __FILE__ ) );  // Deactivate ourself
		wp_die( 
			sprintf( __( 'You need to have installed and enabled the %1$sGenesis Framework%2$s', 'gfw'), '<a href="http://www.studiopress.com/themes/genesis" target="_new">', '</a>' ) );	
	} // end of if
} // end of function

// Menu Item
function gfw_menu() {
		add_submenu_page('genesis', 'Genesis - Footer Widgets', 'Footer Widgets', 'manage_options', 'gfw-options', 'gfw_admin_page' );
}
add_action('admin_menu', 'gfw_menu');

// Menu Page
function gfw_admin_page() {
	$gfw_option = get_option('gfw');
	
	{  ?>

<div class="wrap" class="gfw-admin">
  <h2>Genesis Footer Widgets</h2>
  <form method="post" action="options.php">
    <?php wp_nonce_field('update-options') ?>
    <p><strong>Amount of widgets (either 3 or 4):</strong><br />
      <input type="text" name="gfw" size="1" value="<?php echo get_option('gfw'); ?>" />
    </p>
    <p>
      <input type="submit" name="Submit" value="Store Options" />
    </p>
    <input type="hidden" name="action" value="update" />
    <input type="hidden" name="page_options" value="gfw" />
  </form>
  
<h3>Help, I don`t see the widgets</h3>
<p>Visit the <a href="widgets.php">widgets</a> page.</p>
</div>
<?php  }	// end of echo
}			// end of function







?>