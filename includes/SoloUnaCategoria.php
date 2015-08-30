<?php

//Eliminar Edicion de la Categoria en Quick Edit y eliminar agregar mas categorias
function customAdminCSS() 
{
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
    /*UPDATED Eliminaba la Opcion de Agregar Imgen Destacada
    echo '<style type="text/css">
    .categorydiv {//o
    display: none !important;
    visibility: hidden;
    }
    </style>';
*/



}// Fin customAdminCSS
add_action('admin_head', 'customAdminCSS');



/* Pruebas*/

?>