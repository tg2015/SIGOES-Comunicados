<?php
function crear_tablaInstitucion() {     
   	global $wpdb;
   	$charset_collate = $wpdb->get_charset_collate();
   	
   	/*CREAR TABLA INSTITUCION*/
   	$tablaInstitucion 	= $wpdb->prefix.'institucion'; 
	$tablaUsuario		= $wpdb->prefix.'users';
	$sql = "CREATE TABLE IF NOT EXISTS $tablaInstitucion (
	idInstitucion 			INT(6) UNSIGNED AUTO_INCREMENT,
	idUsuario 				BIGINT(20) UNSIGNED,
	nombreInstitucion 		VARCHAR(100) NOT NULL,
	telefonoInstitucion 	VARCHAR(9),
	descripcionInstitucion 	VARCHAR(100),
	direccionInstitucion 	VARCHAR(100),
	estadoInstitucion 		VARCHAR(20) DEFAULT 'Sin Comprobar',
	estadoPlugin 	  		VARCHAR(20) DEFAULT 'Sin Comprobar',
	urlInstitucion			VARCHAR(100),
	CONSTRAINT PRIMARY KEY (idInstitucion),
	CONSTRAINT FK_ADMINISTRA FOREIGN KEY (idUsuario) REFERENCES $tablaUsuario(ID)
	)$charset_collate;
	";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

}
register_activation_hook( INDEX, 'crear_tablaInstitucion' );

function crear_tablaContacto() { 
	global $wpdb;
   	$charset_collate = $wpdb->get_charset_collate();

	/*CREAR TABLA CONTACTO*/
	$tablaContacto = $wpdb->prefix.'contacto';
	$tablaInstitucion = $wpdb->prefix.'institucion';
	
	$sql = "CREATE TABLE IF NOT EXISTS $tablaContacto (
	idContacto 			INT(6) UNSIGNED AUTO_INCREMENT,
	idInstitucion 		INT(6) UNSIGNED,
	nombreContacto 		VARCHAR(100) NOT NULL,
	telefonoContacto 	VARCHAR(9),
	emailContacto 		VARCHAR(100),
	puestoContacto 		VARCHAR(100),
	PRIMARY KEY (idContacto),
	CONSTRAINT FK_POSEE FOREIGN KEY (idInstitucion) REFERENCES $tablaInstitucion(idInstitucion) ON DELETE CASCADE ON UPDATE CASCADE
	)$charset_collate;";
	
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql ); 
}
register_activation_hook( INDEX, 'crear_tablaContacto' );

function borrar_tablas()
{
//drop a custom db table
global $wpdb;
$tablaInstitucion = $wpdb->prefix.'institucion';
$tablaContacto 	  = $wpdb->prefix.'contacto';

$wpdb->query( "DROP TABLE IF EXISTS $tablaContacto" );
$wpdb->query( "DROP TABLE IF EXISTS $tablaInstitucion" );
}
register_uninstall_hook( INDEX, 'borrar_tablas' );