<?php
/*
Plugin Name: SIGOES-Comunicados
Plugin URI: http://modulos.egob.sv
Description: Plugin para la implementacion de modulos de proyectos, eventos coyunturales y transmision de streaming
Version: 3.0
Author: Equipo de desarrollo SIGOES
Author URI: http://modulos.egob.sv
Text Domain: SIGOES-Comunicados
 */


//Ruta relatica del Plugin SIGOES-Comunicados
//define('SIGOES_PLUGIN_DIR',WP_CONTENT_URL.'/plugins/');
define('SIGOES_PLUGIN_DIR', plugin_dir_path(__FILE__));
require_once(SIGOES_PLUGIN_DIR.'/includes/SoloUnaCategoria.php');
require_once(SIGOES_PLUGIN_DIR.'/controller/ProyectoController.php');
require_once(SIGOES_PLUGIN_DIR.'/controller/EventoController.php');
require_once(SIGOES_PLUGIN_DIR.'/controller/StreamingController.php');
require_once(SIGOES_PLUGIN_DIR.'/controller/OtrosController.php');
///Para Imagen en Feed
require_once(SIGOES_PLUGIN_DIR.'/includes/ImagenEnFeed.php');

//Configurar estado Comunicados
require_once(SIGOES_PLUGIN_DIR.'/includes/EstadoComunicado.php');
//Configurar imagen
require_once(SIGOES_PLUGIN_DIR.'/includes/ImagenRequerida.php');
//Ordenar Comunicados
//require_once(SIGOES_PLUGIN_DIR.'/includes/OrdenarComunicado.php');
/*Espacio para los Includes de Rafel Romero*/
//require_once(SIGOES_PLUGIN_DIR.'/controller/NombreArchivo.php');


/*Espacio para los Includes de Gabriel Lopez*/
//require_once(SIGOES_PLUGIN_DIR.'/controller/NombreArchivo.php');

/**
 *OJO NO AGREGAR CARACTERES (esto incluye caracteres especiales )DESPUES DE ETIQUETA ?>
**/
?>