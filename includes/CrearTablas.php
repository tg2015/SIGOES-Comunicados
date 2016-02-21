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
	telefonoInstitucion 	VARCHAR(9) NOT NULL,
	descripcionInstitucion 	VARCHAR(100),
	direccionInstitucion 	VARCHAR(100) NOT NULL,
	estadoInstitucion 		VARCHAR(20) DEFAULT 'Sin Comprobar',
	estadoPlugin 	  		VARCHAR(20) DEFAULT 'Sin Comprobar',
	urlInstitucion			VARCHAR(100) NOT NULL,
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
	telefonoContacto 	VARCHAR(9) NOT NULL,
	emailContacto 		VARCHAR(100) NOT NULL,
	puestoContacto 		VARCHAR(100),
	PRIMARY KEY (idContacto),
	CONSTRAINT FK_POSEE FOREIGN KEY (idInstitucion) REFERENCES $tablaInstitucion(idInstitucion) ON DELETE CASCADE ON UPDATE CASCADE
	)$charset_collate;";
	
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql ); 
}
register_activation_hook( INDEX, 'crear_tablaContacto' );


// SETEO DE ROLES
function ingresar_roles() {     
   	global $wpdb;
   	$charset_collate = $wpdb->get_charset_collate();
$roles1='a:7:{s:13:"administrator";a:2:{s:4:"name";s:13:"Administrator";s:12:"capabilities";a:61:{s:13:"switch_themes";b:1;s:11:"edit_themes";b:1;s:16:"activate_plugins";b:1;s:12:"edit_plugins";b:1;s:10:"edit_users";b:1;s:10:"edit_files";b:1;s:14:"manage_options";b:1;s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:6:"import";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:8:"level_10";b:1;s:7:"level_9";b:1;s:7:"level_8";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;s:12:"delete_users";b:1;s:12:"create_users";b:1;s:17:"unfiltered_upload";b:1;s:14:"edit_dashboard";b:1;s:14:"update_plugins";b:1;s:14:"delete_plugins";b:1;s:15:"install_plugins";b:1;s:13:"update_themes";b:1;s:14:"install_themes";b:1;s:11:"update_core";b:1;s:10:"list_users";b:1;s:12:"remove_users";b:1;s:13:"promote_users";b:1;s:18:"edit_theme_options";b:1;s:13:"delete_themes";b:1;s:6:"export";b:1;}}s:14:"Gestor_Eventos";a:2:{s:4:"name";s:14:"Gestor_Eventos";s:12:"capabilities";a:10:{s:12:"upload_files";i:1;s:10:"edit_posts";i:1;s:20:"edit_published_posts";i:1;s:13:"publish_posts";i:1;s:4:"read";i:1;s:7:"level_2";i:1;s:7:"level_1";i:1;s:7:"level_0";i:1;s:12:"delete_posts";i:1;s:22:"delete_published_posts";i:1;}}s:16:"Gestor_Streaming";a:2:{s:4:"name";s:16:"Gestor_Streaming";s:12:"capabilities";a:11:{s:12:"upload_files";i:1;s:10:"edit_posts";i:1;s:20:"edit_published_posts";i:1;s:13:"publish_posts";i:1;s:4:"read";i:1;s:7:"level_2";i:1;s:7:"level_1";i:1;s:7:"level_0";i:1;s:12:"delete_posts";i:1;s:22:"delete_published_posts";i:1;s:15:"unfiltered_html";i:1;}}s:12:"Gestor_Otros";a:2:{s:4:"name";s:12:"Gestor_Otros";s:12:"capabilities";a:10:{s:12:"upload_files";i:1;s:10:"edit_posts";i:1;s:20:"edit_published_posts";i:1;s:13:"publish_posts";i:1;s:4:"read";i:1;s:7:"level_2";i:1;s:7:"level_1";i:1;s:7:"level_0";i:1;s:12:"delete_posts";i:1;s:22:"delete_published_posts";i:1;}}s:14:"Gerente_SIGOES";a:2:{s:4:"name";s:14:"Gerente_SIGOES";s:12:"capabilities";a:35:{s:17:"moderate_comments";i:1;s:17:"manage_categories";i:1;s:12:"manage_links";i:1;s:12:"upload_files";i:1;s:15:"unfiltered_html";i:1;s:10:"edit_posts";i:1;s:17:"edit_others_posts";i:1;s:20:"edit_published_posts";i:1;s:13:"publish_posts";i:1;s:10:"edit_pages";i:1;s:4:"read";i:1;s:7:"level_7";i:1;s:7:"level_6";i:1;s:7:"level_5";i:1;s:7:"level_4";i:1;s:7:"level_3";i:1;s:7:"level_2";i:1;s:7:"level_1";i:1;s:7:"level_0";i:1;s:17:"edit_others_pages";i:1;s:20:"edit_published_pages";i:1;s:13:"publish_pages";i:1;s:12:"delete_pages";i:1;s:19:"delete_others_pages";i:1;s:22:"delete_published_pages";i:1;s:12:"delete_posts";i:1;s:19:"delete_others_posts";i:1;s:22:"delete_published_posts";i:1;s:20:"delete_private_posts";i:1;s:18:"edit_private_posts";i:1;s:18:"read_private_posts";i:1;s:20:"delete_private_pages";i:1;s:18:"edit_private_pages";i:1;s:18:"read_private_pages";i:1;s:14:"manage_options";i:1;}}s:21:"Gestor_Comunicaciones";a:2:{s:4:"name";s:21:"Gestor_Comunicaciones";s:12:"capabilities";a:35:{s:17:"moderate_comments";i:1;s:17:"manage_categories";i:1;s:12:"manage_links";i:1;s:12:"upload_files";i:1;s:15:"unfiltered_html";i:1;s:10:"edit_posts";i:1;s:17:"edit_others_posts";i:1;s:20:"edit_published_posts";i:1;s:13:"publish_posts";i:1;s:10:"edit_pages";i:1;s:4:"read";i:1;s:7:"level_7";i:1;s:7:"level_6";i:1;s:7:"level_5";i:1;s:7:"level_4";i:1;s:7:"level_3";i:1;s:7:"level_2";i:1;s:7:"level_1";i:1;s:7:"level_0";i:1;s:17:"edit_others_pages";i:1;s:20:"edit_published_pages";i:1;s:13:"publish_pages";i:1;s:12:"delete_pages";i:1;s:19:"delete_others_pages";i:1;s:22:"delete_published_pages";i:1;s:12:"delete_posts";i:1;s:19:"delete_others_posts";i:1;s:22:"delete_published_posts";i:1;s:20:"delete_private_posts";i:1;s:18:"edit_private_posts";i:1;s:18:"read_private_posts";i:1;s:20:"delete_private_pages";i:1;s:18:"edit_private_pages";i:1;s:18:"read_private_pages";i:1;s:14:"manage_options";i:1;}}s:16:"Gestor_Proyectos";a:2:{s:4:"name";s:16:"Gestor_Proyectos";s:12:"capabilities";a:10:{s:12:"upload_files";i:1;s:10:"edit_posts";i:1;s:20:"edit_published_posts";i:1;s:13:"publish_posts";i:1;s:4:"read";i:1;s:7:"level_2";i:1;s:7:"level_1";i:1;s:7:"level_0";i:1;s:12:"delete_posts";i:1;s:22:"delete_published_posts";i:1;}}}';
 
$table_name = $wpdb->prefix . 'options';

$data = array(
    'option_value' => $roles1
);
$where = array( 'option_id' => 90 );
$format = array( '%s' );
$where_format = array( '%d' );

$wpdb->update( $table_name, $data, $where, $format,$where_format );

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

}
register_activation_hook( INDEX, 'ingresar_roles' );


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