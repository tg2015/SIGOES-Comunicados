<?php
/*
Plugin Name: SIGOES-Comunicados
Plugin URI: http://modulos.egob.sv
Description: Plugin para la implementacion de modulos de proyectos, eventos coyunturales y transmision de streaming
Version: 1.0
Author: Equipo de desarrollo SIGOES
Author URI: http://modulos.egob.sv
Text Domain: SIGOES-Comunicados
 */


//Ruta relatica del Plugin SIGOES-Comunicados
//define('SIGOES_PLUGIN_DIR',WP_CONTENT_URL.'/plugins/');
define('SIGOES_PLUGIN_DIR', plugin_dir_path(__FILE__));
require_once(SIGOES_PLUGIN_DIR.'/controller/ProyectoController.php');
require_once(SIGOES_PLUGIN_DIR.'/controller/EventoController.php');
require_once(SIGOES_PLUGIN_DIR.'/controller/StreamingController.php');
///Para Imagen en Feed
require_once(SIGOES_PLUGIN_DIR.'/includes/ImagenEnFeed.php');
require_once(SIGOES_PLUGIN_DIR.'/includes/SoloUnaCategoria.php');
//Configurar estado Comunicados
require_once(SIGOES_PLUGIN_DIR.'/includes/EstadoComunicado.php');


?>