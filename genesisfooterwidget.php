<?php
/*
Plugin Name: Genesis Footer Widgets
Plugin URI: http://www.ramoonus.nl/wordpress/genesis-footer-widgets/
Description: This plugin adds 3 footer widgets to Genesis 1.6 and higher. 
Version: 1.0.1
Author: Ramoonus
Author URI: http://www.ramoonus.nl/
*/
function genesisfooterwidgetsplugin() {
	/** Add support for 3-column footer widgets **/

	
	// great job, you`ve got support for 3 unstyled widgets, better do some styling
	/* CSS */ 
	wp_deregister_style('genesis-footer-widgets-style'); // deregister
	wp_register_style('genesis-footer-widgets-style', plugins_url('/css/gfw.css', __FILE__), false, '1.0.0'); // re register
	wp_enqueue_style('genesis-footer-widgets-style'); // load
			
	// powered by http://dev.studiopress.com/add-widgeted-footer.htm 
}
add_action('init', 'genesisfooterwidgetsplugin');
// init the widgets themself
add_theme_support('genesis-footer-widgets', 3 );
?>