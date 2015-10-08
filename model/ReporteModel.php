<?php
class ReporteModel
{

public function get_reporte_pantalla( $estado_1, $catego_1, $autor_1, $nick_1,$fecha_ini,$fecha_fin )
{
global $wpdb;
$comilla = '"';
$coma = "'";

if( $fecha_ini == NULL && $fecha_fin == NULL){
    $filtro_fecha = " "; 
}else{ if( $fecha_ini=="%" && $fecha_fin=="%" ) {
       $filtro_fecha = " "; 
    }else{ $filtro_fecha = "AND
   post_date between '".$fecha_ini." 00:00:00' and '".$fecha_fin." 23:59:59'";}}            

// Consulta Pantalla
$sql_results = $wpdb->get_results(
        " SELECT DISTINCT
        (@num:=@num+1) AS ID,
        Post.post_title, 
        Post.post_type,  
        (CASE Post.post_status 
             WHEN 'publish'    THEN 'Publicado'
             WHEN 'pending'    THEN 'Pendiente de revision'
             WHEN 'draft'      THEN 'Borrador' 
             WHEN 'cancelado'  THEN 'Cancelado'  END) AS post_status,
 (SELECT DISTINCT  SUBSTRING_INDEX(SUBSTRING_INDEX( meta_value, '".$comilla."', 2), '".$comilla."', -1) 
        FROM  wp_usermeta  
        WHERE user_id = post_author  AND 
             (meta_key = 'wp_capabilities' )  ) AS Rol_Autor,
(SELECT meta_value FROM wp_usermeta WHERE user_id = post_author AND meta_key = 'nickname') alias,
CONCAT(
(SELECT meta_value FROM wp_usermeta WHERE user_id = post_author AND meta_key = 'first_name') , ' ',
(SELECT meta_value FROM wp_usermeta WHERE user_id = post_author AND meta_key = 'last_name') ) nombre,        
        Post.post_date AS Fecha_Creacion,
        Post.post_date_gmt AS Fecha_Modificacion
        FROM  wp_posts AS Post, wp_usermeta AS User,
        (SELECT @num:=0) d
        WHERE 
        (user_id = post_author) AND
        (post_status  like '".$estado_1."'  ) AND
        (post_type    like '".$catego_1."'  ) AND 
        (meta_value   like '%".$autor_1."%' ) AND
        (meta_value   like '".$nick_1."')     AND
        (post_status != 'trash')              AND
        (post_status != 'auto-draft')         AND
        (post_status != 'inherit')            AND  
        (post_type != 'attachment')           AND
        (post_type != 'page')                 AND
        (post_type != 'post')                 AND
        (post_type != 'revision')  ".$filtro_fecha." 
        #ORDER BY post_date DESC 
        ");

return $sql_results;
}


public function get_reporte_csv( $estado_1,$catego_1,$autor_1,$nick_1,$fecha_ini,$fecha_fin )
{
global $wpdb;
$comilla = '"';
$coma = "'";

if( $fecha_ini == NULL && $fecha_fin == NULL){
    $filtro_fecha = " "; 
}else{ if( $fecha_ini=="%" && $fecha_fin=="%" ) {
       $filtro_fecha = " "; 
    }else{ $filtro_fecha = "AND
   post_date between '".$fecha_ini." 00:00:00' and '".$fecha_fin." 23:59:59'";}}            
   
// consulta archivo csv
$array_results = $wpdb->get_results(
        "SELECT DISTINCT
        (@num:=@num+1) AS ID,
        Post.post_title, 
        Post.post_type,  
        (CASE Post.post_status 
             WHEN 'publish'    THEN 'Publicado'
             WHEN 'pending'    THEN 'Pendiente de revision'
             WHEN 'draft'      THEN 'Borrador' 
             WHEN 'cancelado'  THEN 'Cancelado'  END) AS post_status,
 (SELECT DISTINCT  SUBSTRING_INDEX(SUBSTRING_INDEX( meta_value, '".$comilla."', 2), '".$comilla."', -1) 
        FROM  wp_usermeta  
        WHERE user_id = post_author  AND 
             (meta_key = 'wp_capabilities' )  ) AS Rol_Autor,
(SELECT meta_value FROM wp_usermeta WHERE user_id = post_author AND meta_key = 'nickname') alias,
CONCAT(
(SELECT meta_value FROM wp_usermeta WHERE user_id = post_author AND meta_key = 'first_name') , ' ',
(SELECT meta_value FROM wp_usermeta WHERE user_id = post_author AND meta_key = 'last_name') ) nombre,        
        Post.post_date AS Fecha_Creacion,
        Post.post_date_gmt AS Fecha_Modificacion
        FROM  wp_posts AS Post, wp_usermeta AS User,
        (SELECT @num:=0) d
        WHERE 
        (user_id = post_author) AND
        (post_status  like '".$estado_1."'  ) AND
        (post_type    like '".$catego_1."'  ) AND 
        (meta_value   like '%".$autor_1."%' ) AND
        (meta_value   like '".$nick_1."')     AND
        (post_status != 'trash')              AND
        (post_status != 'auto-draft')         AND
        (post_status != 'inherit')            AND  
        (post_type != 'attachment')           AND
        (post_type != 'page')                 AND
        (post_type != 'post')                 AND
        (post_type != 'revision')  ".$filtro_fecha." ", ARRAY_A);

return $array_results;
}


// Consultas para llenar las opciones del select
public function get_post_status( )
{
    global $wpdb;

$estados_array = $wpdb->get_results("SELECT DISTINCT CASE post_status 
                                     WHEN 'publish'    THEN 'Publicado'
                                     WHEN 'pending'    THEN 'Pendiente de revision'
                                     WHEN 'draft'      THEN 'Borrador' 
                                     WHEN 'cancelado'  THEN 'Cancelado'  END AS post_status
                                     FROM  wp_posts
                                     WHERE (post_status != 'trash') AND 
                                     (post_status != 'auto-draft') AND (post_status != 'inherit')",ARRAY_A);

return $estados_array;
}

public function get_post_type( )
{
    global $wpdb;

$categorias_array = $wpdb->get_results("SELECT DISTINCT post_type FROM  wp_posts 
                                        WHERE (post_type != 'attachment') AND (post_type != 'page') AND
                                              (post_type != 'post')       AND (post_type != 'revision')",ARRAY_A);    
return $categorias_array;
}

public function get_rol_user( )
{
    global $wpdb;
    $comilla = '"';
$rol_array =  $wpdb->get_results("SELECT DISTINCT  SUBSTRING_INDEX(SUBSTRING_INDEX( meta_value, '".$comilla."', 2), '".$comilla."', -1) 
                                    FROM  wp_usermeta , wp_posts 
                                    WHERE user_id = post_author 
                                    AND meta_key = 'wp_capabilities' ",ARRAY_A);
return $rol_array;
}

public function get_nickname_user( )
{
    global $wpdb;

$nick_array = $wpdb->get_results("SELECT DISTINCT
                                                meta_value 
                                    FROM  wp_posts AS Post, wp_usermeta AS User
                                    WHERE user_id = post_author AND meta_key = 'nickname'",ARRAY_A);    
return $nick_array;
}

}
?>