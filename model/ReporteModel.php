<?php
class ReporteModel
{

 protected $CRUD;
 function __Construct(){
            global $wpdb;
            $this->CRUD=$wpdb;
        }

public function get_reporte($estado, $cat, $autor, $nick, $fecha_ini, $fecha_fin, $filtro_titulo)
{

$comilla = '"';
$coma = "'";
if( $fecha_ini == NULL && $fecha_fin == NULL){
    $filtro_fecha = " ";
}else{ if( $fecha_ini=="%" && $fecha_fin=="%" ) {
       $filtro_fecha = " ";
    }
    else
    { 
    $fecha_ini=strtotime($fecha_ini.' 00:00:00');
    $fecha_fin=strtotime($fecha_fin.' 23:59:59');
    $fecha_ini_format=date('Y-m-d H:i:s', $fecha_ini);
    $fecha_fin_format=date('Y-m-d H:i:s', $fecha_fin);
    if($fecha_fin_format>$fecha_ini_format)
        {$filtro_fecha="AND post_date between '".$fecha_ini_format."' and '".$fecha_fin_format."'";}
    }
}

if(!is_null($filtro_titulo))
{
    $filtro=$filtro_titulo;
}
else
{
    $filtro="%";
} 
// PREFIJO TABLAS WP_
$prefijo = $this->CRUD->prefix;

// Consulta Pantalla
        $resultados = $this->CRUD->get_results(
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
        FROM  ".$prefijo."usermeta  
        WHERE user_id = post_author  AND 
             (meta_key = '".$prefijo."capabilities' )  ) AS Rol_Autor,
        (SELECT meta_value FROM ".$prefijo."usermeta WHERE user_id = post_author AND meta_key = 'nickname') alias,
        CONCAT(
        (SELECT meta_value FROM ".$prefijo."usermeta WHERE user_id = post_author AND meta_key = 'first_name') , ' ',
        (SELECT meta_value FROM ".$prefijo."usermeta WHERE user_id = post_author AND meta_key = 'last_name') ) nombre,
        (SELECT meta_value FROM ".$prefijo."usermeta WHERE user_id = post_author AND meta_key = 'Institucion') AS Institucion,
        date_format(Post.post_date, '%d-%m-%Y %H:%m:%s') AS Fecha_Creacion,
        date_format(Post.post_date_gmt, '%d-%m-%Y %H:%m:%s') AS Fecha_Modificacion
        FROM  ".$prefijo."posts AS Post, ".$prefijo."usermeta AS User,
        (SELECT @num:=0) d
        
        WHERE 
        (post_title LIKE '%".$filtro_titulo."%') AND
        (user_id = post_author)                  AND
        (post_status  like '".$estado."'  )      AND
        (post_type    like '".$cat."'  )         AND 
        (meta_value   like '%".$autor."%' )      AND
        (meta_value   like '".$nick."')          AND
        (post_status != 'trash')                 AND
        (post_status != 'auto-draft')            AND
        (post_status != 'inherit')               AND  
        (post_type != 'attachment')              AND
        (post_type != 'page')                    AND
        (post_type != 'post')                    AND
        (post_type != 'revision')  ".$filtro_fecha." 
        ORDER BY post_date DESC 
        ");

return $resultados;
}


public function get_reporte_csv( $estado, $cat, $autor, $nick, $fecha_ini, $fecha_fin, $filtro_titulo )
{
$comilla = '"';
$coma = "'";
if( $fecha_ini == NULL && $fecha_fin == NULL){
    $filtro_fecha = " ";
}else{ if( $fecha_ini=="%" && $fecha_fin=="%" ) {
       $filtro_fecha = " ";
    }
    else
    { 
    $fecha_ini=strtotime($fecha_ini.' 00:00:00');
    $fecha_fin=strtotime($fecha_fin.' 23:59:59');
    $fecha_ini_format=date('Y-m-d H:i:s', $fecha_ini);
    $fecha_fin_format=date('Y-m-d H:i:s', $fecha_fin);
    if($fecha_fin_format>$fecha_ini_format)
        {$filtro_fecha="AND post_date between '".$fecha_ini_format."' and '".$fecha_fin_format."'";}
    }
} 

if(!is_null($filtro_titulo))
{
    $filtro=$filtro_titulo;
}
else
{
    $filtro="%";
}
// PREFIJO TABLAS WP_
$prefijo = $this->CRUD->prefix;


        $resultados = $this->CRUD->get_results(
        " SELECT DISTINCT
        (@num:=@num+1) AS ID,
        #count(*) AS ID,
        Post.post_title, 
        Post.post_type,  
        (CASE Post.post_status 
             WHEN 'publish'    THEN 'Publicado'
             WHEN 'pending'    THEN 'Pendiente de revision'
             WHEN 'draft'      THEN 'Borrador' 
             WHEN 'cancelado'  THEN 'Cancelado'  END) AS post_status,
        (SELECT DISTINCT  SUBSTRING_INDEX(SUBSTRING_INDEX( meta_value, '".$comilla."', 2), '".$comilla."', -1) 
        FROM  ".$prefijo."usermeta  
        WHERE user_id = post_author  AND 
             (meta_key = '".$prefijo."capabilities' )  ) AS Rol_Autor,
        (SELECT meta_value FROM ".$prefijo."usermeta WHERE user_id = post_author AND meta_key = 'nickname') alias,
        CONCAT(
        (SELECT meta_value FROM ".$prefijo."usermeta WHERE user_id = post_author AND meta_key = 'first_name') , ' ',
        (SELECT meta_value FROM ".$prefijo."usermeta WHERE user_id = post_author AND meta_key = 'last_name') ) nombre,        
        date_format(Post.post_date, '%d-%m-%Y %H:%m:%s') AS Fecha_Creacion,
        date_format(Post.post_date_gmt, '%d-%m-%Y %H:%m:%s') AS Fecha_Modificacion
        FROM  ".$prefijo."posts AS Post, ".$prefijo."usermeta AS User,
        (SELECT @num:=0) d
        
        WHERE 
        (post_title LIKE '%".$filtro_titulo."%') AND
        (user_id = post_author)                  AND
        (post_status  like '".$estado."'  )      AND
        (post_type    like '".$cat."'  )         AND 
        (meta_value   like '%".$autor."%' )      AND
        (meta_value   like '".$nick."')          AND
        (post_status != 'trash')                 AND
        (post_status != 'auto-draft')            AND
        (post_status != 'inherit')               AND  
        (post_type != 'attachment')              AND
        (post_type != 'page')                    AND
        (post_type != 'post')                    AND
        (post_type != 'revision')  ".$filtro_fecha." 
        ORDER BY post_date DESC 
        ", ARRAY_A);

return $resultados;
}


// Consultas para llenar las opciones del select
public function get_post_status( )
{

// PREFIJO TABLAS WP_
$prefijo = $this->CRUD->prefix;

$estados = $this->CRUD->get_results("SELECT DISTINCT CASE post_status 
                                     WHEN 'publish'    THEN 'Publicado'
                                     WHEN 'pending'    THEN 'Pendiente de revision'
                                     WHEN 'draft'      THEN 'Borrador' 
                                     WHEN 'cancelado'  THEN 'Cancelado'  END AS post_status
                                     FROM  ".$prefijo."posts
                                     WHERE (post_status != 'trash') AND 
                                     (post_status != 'auto-draft') AND (post_status != 'inherit')",ARRAY_A);

return $estados;
}

public function get_post_type( )
{
// PREFIJO TABLAS WP_
$prefijo = $this->CRUD->prefix;

$categorias = $this->CRUD->get_results("SELECT DISTINCT post_type FROM  ".$prefijo."posts 
                                        WHERE (post_type != 'attachment') AND (post_type != 'page') AND
                                              (post_type != 'post')       AND (post_type != 'revision')",ARRAY_A);    
return $categorias;
}

public function get_rol_user( )
{
// PREFIJO TABLAS WP_
$prefijo = $this->CRUD->prefix;

$comilla = '"';
$roles =  $this->CRUD->get_results("SELECT DISTINCT  SUBSTRING_INDEX(SUBSTRING_INDEX( meta_value, '".$comilla."', 2), '".$comilla."', -1) 
                                    FROM  ".$prefijo."usermeta , ".$prefijo."posts 
                                    WHERE user_id = post_author 
                                    AND meta_key = '".$prefijo."capabilities' ",ARRAY_A);
return $roles;
}

public function get_nickname_user( )
{
// PREFIJO TABLAS WP_
$prefijo = $this->CRUD->prefix;    

$nicks = $this->CRUD->get_results("SELECT DISTINCT meta_value 
                                    FROM  ".$prefijo."posts AS Post, ".$prefijo."usermeta AS User
                                    WHERE user_id = post_author AND meta_key = 'nickname'",ARRAY_A);    
return $nicks;
}

}
?>