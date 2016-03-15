<?php
/*
*Nombre del módulo: Admin
*Objetivo: Registro de Estilos de SIGOES y Encabezados
*Dirección física: /SIGOES-Comunicados/includes/Admin.php
*/

/*Titulo para login SIGOES*/
function TituloSigoes() {
    return 'SIGOES';
}
add_filter( 'login_headertitle', 'TituloSigoes' );

/*URL Titulo para login SIGOES*/
function URLtituloSigoes() {
    return admin_url();
}
add_filter( 'login_headerurl', 'URLtituloSigoes' );

/*Login Form SIGOES*/
add_action( 'login_enqueue_scripts', 'Logo_SIGOES' );
function Logo_SIGOES() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo plugins_url(); ?>/SIGOES-Comunicados/includes/img/logo-sigoes.png);
            !important; background-size: 393px 89px !important; height: 89px !important; width: 343px !important;
            padding-bottom: 10px;
            background-position:relative;
        }

        .login label {
            font-size: 16px;
            color: #555555;
        }
        
        .login body{
            background-color: gray;
        }
        
        .login .button-primary {
        width: 120px;
        float:right;
        background-color:#17a8e3 !important;
        background: -webkit-linear-gradient(#17a8e3, #17a8e3);
        background: -o-linear-gradient(#17a8e3, #17a8e3);
        background: linear-gradient(#17a8e3, #17a8e3);
        background-image: -ms-linear-gradient(top, #17a8e3 0%, #17a8e3 100%);
        color: #ffffff;
        -webkit-border-radius: 4px;
        border: 1px solid #0d9ed9;
        }

        p#backtoblog {
        display: none;
        }
    </style>
<?php }

/*Paginas de Menu Administracion*/
add_action('admin_menu', 'admin_pages');
 
	function admin_pages() {
            remove_menu_page('edit.php'); // Entradas
            //remove_menu_page('upload.php'); // Multimedia
            remove_menu_page('link-manager.php'); // Enlaces
            remove_menu_page('edit.php?post_type=page'); // Páginas
            remove_menu_page('edit-comments.php'); // Comentarios
            //remove_menu_page('themes.php'); // Apariencia
            //remove_menu_page('plugins.php'); // Plugins
            //remove_menu_page('users.php'); // Usuarios
            //remove_menu_page('tools.php'); // Herramientas
            //remove_menu_page('options-general.php'); // Ajustes
	}

/*Pie de Administracion*/
add_filter('admin_footer_text', 'admin_footer');
function admin_footer() {  
    echo '<b>Derechos de Información 2015. Presidencia de la República de El Salvador</b>';  
}

/*Encabezado de Administracion*/
add_action( 'in_admin_header', 'Encabezado' );
function Encabezado()
{
	echo '<div class="wrap">
          <div class="encabezado">
            <img id="logo"    src="'.plugins_url().'/SIGOES-Comunicados/includes/img/gob.jpg">
            <img id="escudo"  src="'.plugins_url().'/SIGOES-Comunicados/includes/img/presidencia.jpg">
            <div class="titulo-sistema"><br/><p>Sistema Informático para la Gestión de Gobierno Electrónico en la Innovación de Canales de Comunicación entre Casa Presidencial y Población Salvadoreña (SIGOES)</p><br/></div>                    
          </div>
          </div>
          ';
}

/*Registro de EstilosAdmin*/
add_action( 'in_admin_header', 'registrar_EstilosAdmin' );
function registrar_EstilosAdmin()
{       
    wp_register_style( 'EstilosAdmin', plugins_url('SIGOES-Comunicados/includes/css/EstilosAdmin.css'));
    wp_enqueue_style( 'EstilosAdmin' );
}