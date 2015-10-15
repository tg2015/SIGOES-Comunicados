<?php
function crear_tablas_Institucion() {     
   	$table_name = $wpdb->prefix . "institucion"; 
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
		idInstitucion int(9) NOT NULL AUTO_INCREMENT,
		nombreInstitucion varchar(100) NOT NULL,
		ubicacion varchar(100),
		telefonoInstitucion varchar(100),
		descripcionInstitucion varchar(300),
		UNIQUE KEY id (idInstitucion)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}
register_activation_hook( __FILE__, 'crear_tablas_Institucion' );

	/*$table_name = $wpdb->prefix . "DetalleInstitucion"; 
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		idDetalleInstitucion int NOT NULL AUTO_INCREMENT,
		nombreContacto varchar(100) NOT NULL,
		telefonoContacto varchar(100) NOT NULL,
		mailContacto varchar(100) NOT NULL,
		puestoContacto varchar(100) NOT NULL,
		UNIQUE KEY id (idDetalleInstitucion)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );


	$table_name = $wpdb->prefix . "DetalleConexion"; 
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		idDetalleConexion int NOT NULL AUTO_INCREMENT,
		nombreContacto text NOT NULL,
		telefonoContacto text NOT NULL,
		mailContacto text NOT NULL,
		puestoContacto text NOT NULL,
		UNIQUE KEY id (idDetalleInstitucion)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );*/

	/*
	CREATE TABLE Institucion (
idInstitucion INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
nombreInstitucion VARCHAR(100) NOT NULL,
descripcionInstitucion VARCHAR(100) NOT NULL,
telefonoInstitucion VARCHAR(50)
)
	 */



function borrar_tablas_Institucion()
{
//if uninstall not called from WordPress exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) 
    {exit();}

//$option_name = 'plugin_option_name';
//delete_option( $option_name );

// For site options in multisite
//delete_site_option( $option_name );  

//drop a custom db table
global $wpdb;
$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}Institucion" );
$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}DetalleInstitucion" );
$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}Institucion" );
}
register_uninstall_hook(__FILE__, 'borrar_tablas_Institucion' );
?>