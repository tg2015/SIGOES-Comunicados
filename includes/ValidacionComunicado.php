<?php
add_action( 'admin_enqueue_scripts', 'my_enqueue' );
function my_enqueue($hook) {
    if( /*'index.php' != $hook ||*/'post-new.php' != $hook /*||'post.php' != $hook || 'edit.php' != $hook*/) {
	// Only applies to dashboard panel
	return;
    }
        
	wp_enqueue_script( 'ajax-script', plugins_url( '/js/ValidacionComunicado.js', __FILE__ ), array('jquery') );

	// in JavaScript, object properties are accessed as ajax_object.ajax_url, ajax_object.we_value
	wp_localize_script( 'ajax-script', 'ajax_object',
          array( 'ajax_url' => admin_url( 'admin-ajax.php' ),'titulo'=>'','we_value' => 0) );
}

// Same handler function...
add_action( 'wp_ajax_my_action', 'my_action_callback' );
function my_action_callback() {
	global $wpdb;
	
    $titulo = $_POST['titulo'];
    $titulo2=$titulo;
	//$titulo += ' PHP';
        echo $titulo;    

$whatever = intval( $_POST['whatever'] );
	$whatever += 100;
        echo $whatever;


	wp_die();
}