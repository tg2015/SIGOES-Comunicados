<?php
function crear_tablas_Institucion() {     
   	
   	$table_name = "institucion"; 
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
	idInstitucion 			INT(6) UNSIGNED AUTO_INCREMENT,
	nombreInstitucion 		VARCHAR(100) NOT NULL,
	telefonoInstitucion 	VARCHAR(9),
	descripcionInstitucion 	VARCHAR(300),
	direccionInstitucion 	VARCHAR(100),
	estadoInstitucion 		VARCHAR(20) DEFAULT 'Sin Comprobar',
	estadoPlugin 	  		VARCHAR(20) DEFAULT 'Sin Comprobar',
	urlInstitucion			VARCHAR(100),
	CONSTRAINT PRIMARY KEY (idInstitucion)	
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	$table_name = "contacto";

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
	idContacto 			INT(6) UNSIGNED AUTO_INCREMENT,
	idInstitucion 		INT(6) UNSIGNED,
	nombreContacto 		VARCHAR(100) NOT NULL,
	telefonoContacto 	VARCHAR(9),
	emailContacto 		VARCHAR(100),
	puestoContacto 		VARCHAR(100),
	PRIMARY KEY (idContacto),
	CONSTRAINT FK_INSTITUCION FOREIGN KEY (idInstitucion) REFERENCES institucion(idInstitucion) ON DELETE CASCADE ON UPDATE CASCADE
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql ); 

}
register_activation_hook( __FILE__, 'crear_tablas_Institucion' );
	
function borrar_tablas_Institucion()
{
//if uninstall not called from WordPress exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) 
    {exit();}

//drop a custom db table
global $wpdb;
$wpdb->query( "DROP TABLE IF EXISTS contacto" );
$wpdb->query( "DROP TABLE IF EXISTS detalleConexion" );
$wpdb->query( "DROP TABLE IF EXISTS institucion" );
}
register_uninstall_hook(__FILE__, 'borrar_tablas_Institucion' );

/*
	//$option_name = 'plugin_option_name';
	//delete_option( $option_name );

	// For site options in multisite
	//delete_site_option( $option_name ); 

	CREATE TABLE institucion (
	idInstitucion 			INT(6) UNSIGNED AUTO_INCREMENT,
	nombreInstitucion 		VARCHAR(100) NOT NULL,
	telefonoInstitucion 	VARCHAR(9),
	descripcionInstitucion 	VARCHAR(100),
	direccionInstitucion 	VARCHAR(100),
	estadoInstitucion 		VARCHAR(20) DEFAULT 'Sin Comprobar',
	estadoPlugin 	  		VARCHAR(20) DEFAULT 'Sin Comprobar',
	urlInstitucion			VARCHAR(100),
	CONSTRAINT PRIMARY KEY (idInstitucion)
	);

	CREATE TABLE contacto (
	idContacto 			INT(6) UNSIGNED AUTO_INCREMENT,
	idInstitucion 		INT(6) UNSIGNED,
	nombreContacto 		VARCHAR(100) NOT NULL,
	telefonoContacto 	VARCHAR(9),
	emailContacto 		VARCHAR(100),
	puestoContacto 		VARCHAR(100),
	PRIMARY KEY (idContacto),
	CONSTRAINT FK_POSEE FOREIGN KEY (idInstitucion) REFERENCES institucion(idInstitucion) ON DELETE CASCADE ON UPDATE CASCADE
	);

	CREATE TABLE detalleConexion (
	idDetalleConexion 	INT(6) UNSIGNED AUTO_INCREMENT,
	idInstitucion 		INT(6) UNSIGNED,
	urlInstitucion		VARCHAR(100),
	ipConexion			VARCHAR(100),
	estadoConexion 		VARCHAR(20) DEFAULT 'Sin Comprobar',
	estadoPlugin 	  	VARCHAR(20) DEFAULT 'Sin Comprobar',
	PRIMARY KEY (idDetalleConexion),
	CONSTRAINT FK_CONECTA FOREIGN KEY (idInstitucion) REFERENCES institucion(idInstitucion) ON DELETE CASCADE ON UPDATE CASCADE
	);	

*/
?>