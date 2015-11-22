<?php
add_filter('post_updated_messages', 'set_messages' );
function set_messages($messages) {

global $post, $post_ID;

$post_type = get_post_type( $post_ID );

$obj = get_post_type_object($post_type);
$singular = $obj->labels->singular_name;

$messages[$post_type] = array(
0 => '', // Unused. Messages start at index 1.
1 => sprintf( __($singular.' actualizado. <a href="%s">Ver '.strtolower($singular).'</a>'), esc_url( get_permalink($post_ID) ) ),
2 => __('Campo personalizado actualizado.'),
3 => __('Campo personalizado borrado.'),
4 => __($singular.' updated.'),
5 => isset($_GET['revision']) ? sprintf( __($singular.' revision restaurada de %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
6 => sprintf( __($singular.' publicado. <a href="%s">Ver '.strtolower($singular).'</a>'), esc_url( get_permalink($post_ID) ) ),
7 => __('Page saved.'),
8 => sprintf( __($singular.' enviado. <a target="_blank" href="%s">Vista previa del '.strtolower($singular).'</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
9 => sprintf( __($singular.' programado para: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Vista previa del '.strtolower($singular).'</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
10 => sprintf( __($singular.' actualizado como borrador . <a target="_blank" href="%s">Vista previa '.strtolower($singular).'</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
);
return $messages;

}

function remove_menus () {
    global $menu;
    $restricted = array(__('Dashboard'));
    //$restricted = array(__('Dashboard'), __('Posts'), __('Media'), __('Links'), __('Pages'), __('Appearance'), __('Tools'), __('Users'), __('Settings'), __('Comments'), __('Plugins'));
    end($menu);
    while(prev($menu)){
        $value = explode(' ',$menu[key($menu)][0]);
        if(in_array($value[0]!= NULL?$value[0]:'',$restricted)){unset($menu[key($menu)]);}
    }
}
add_action('admin_menu','remove_menus');