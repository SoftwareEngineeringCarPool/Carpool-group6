<?php
/*
Plugin Name: db form
Plugin URI: http://www.valentinalisch.de/dev_wp/db-form/
Description: Simple plugIn to submit entries to a database.
Version: 0.2.1
Author: valentin alisch
Author URI: http://www.valentinalisch.de
*/
require_once('php/admin.php');
require_once('php/shortcodes.php');

function va_db_form_add_extensions(){
	?>
    <link rel="stylesheet" type="text/css" href="<?php echo get_option('va_db_form_style'); ?>" />
    <script type="text/javascript" src="<?php echo plugins_url( 'js/check.js' , __FILE__ ); ?>"></script>
    <script type="text/javascript" src="<?php echo plugins_url( 'js/functions.js' , __FILE__ ); ?>"></script>
	<?php
}
add_action('wp_head', 'va_db_form_add_extensions');

function va_db_add_extensions_admin(){
	?>
    <link rel="stylesheet" type="text/css" href="<?php echo plugins_url( 'style/admin/admin.css' , __FILE__ ); ?>" />
    <script type="text/javascript" src="<?php echo plugins_url( 'js/admin.js' , __FILE__ ); ?>"></script>
    <?php	
}
add_action('admin_head', 'va_db_add_extensions_admin');

?>