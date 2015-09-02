<?php
if(
	strstr($_SERVER['REQUEST_URI'], 'wp-admin/post-new.php') ||
	strstr($_SERVER['REQUEST_URI'], 'wp-admin/post.php')/*||
	strstr($_SERVER['REQUEST_URI'], 'wp-admin/edit.php')  Mejorar Funcion ya que en edit no es conveniente*/

	)
{
ob_start('one_category_only');
}
function one_category_only($content) {
$content = str_replace('type="checkbox" ', 'type="radio" ', $content);
return $content;
}

//Eliminar Edicion de la Categoria en Quick Edit y eliminar agregar mas categorias
function customAdminCSS() {
    echo '<style type="text/css">
    .inline-edit-col .inline-edit-categories-label, .inline-edit-col .category-checklist {
    	display: none !important;
    }
    </style>';
//Elimar opcion Agregar mas cetegorias
echo '<style type="text/css">#category-add-toggle {
    display: none;
    visibility: hidden;
}
    </style>';


    ///Eliminar Mas utilizadas 
    /*UPDATED Eliminaba la Opcion de Agregar Imgen Destacada*/

    echo '<style type="text/css">
    .screen-reader-text{
    display: none;
    visibility: hidden;
}
    </style>';




}
add_action('admin_head', 'customAdminCSS');



/* Pruebas*/

?>