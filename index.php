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
define('SIGOES_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('INDEX', __FILE__);
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
/*Espacio para los Includes de Rafel Romero*/
//require_once(SIGOES_PLUGIN_DIR.'/includes/GenerarReportes.php');
//require_once(SIGOES_PLUGIN_DIR.'/view/ReporteView.php');
require_once(SIGOES_PLUGIN_DIR.'/controller/ReporteController.php');

/*Espacio para los Includes de Gabriel Lopez*/
require_once(SIGOES_PLUGIN_DIR.'/includes/ValidacionInternaComunicado.php');

/*Espacio para los Includes de Christian Ayala*/
require_once(SIGOES_PLUGIN_DIR.'/controller/InstitucionController.php');
require_once(SIGOES_PLUGIN_DIR.'/includes/CrearTablas.php');
require_once(SIGOES_PLUGIN_DIR.'/includes/Admin.php');