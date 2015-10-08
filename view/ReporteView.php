<?php 

if(isset($_POST['Estado_Post'])){ 
                $estado_1 = $_POST['Estado_Post'];
                switch ($estado_1) {
                     case 'Publicado':
                         $estado_ ='publish';
                         break;
                     case 'Pendiente de revision':
                         $estado_ ='pending'; 
                         break;
                     case 'Borrador':
                         $estado_ ='draft'; 
                         break;
                     case 'Cancelado':
                         $estado_ ='Cancelado'; 
                         break;
                     default:
                         $estado_ = $estado_1;
                         break;
                 } 
                 

            }else{$estado_1 = '%';
                  $estado_ = '%';}

            if(isset($_POST['cat'])){ 
                    $catego_1 = $_POST['cat']; 
                    }else{$catego_1 = '%';}

            if(isset($_POST['Autor_post'])){ 
                    $autor_1 = $_POST['Autor_post'];
                    }else{$autor_1 = '%';}

            if(isset($_POST['Nick_user'])){ 
                    $nick_1 = $_POST['Nick_user'];
                    }else{$nick_1 = '%';}               

            if(isset($_POST['fecha_ini'])){ 
                    $fecha_ini = $_POST['fecha_ini'];
                    }else{$fecha_ini = '%';}

            if(isset($_POST['fecha_fin'])){ 
                    $fecha_ini = $_POST['fecha_fin'];
                    }else{$fecha_fin = '%';}


if (!class_exists('WP_List_Table')) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );

    class FT_WP_Table extends WP_List_Table
    {

        private $order;
        private $orderby;
        private $posts_per_page = 25;

        public function __construct()   
        {
            parent :: __construct(array(
                'singular' => "ftraveler",
                'plural' => "ftraveler",
                'ajax' => true ));


//ob_start();
            $this->set_order();
            $this->set_orderby();
            $this->prepare_items();
            $this->display();

        }

            
         /// realiza la consulta y escribe en archivo CSV
private function get_sql_results()  
        {
            global $wpdb;

            if(isset($_POST['Estado_Post'])){ 
                $estado_1 = $_POST['Estado_Post'];
                switch ($estado_1) {
                     case 'Publicado':
                         $estado_ ='publish';
                         break;
                     case 'Pendiente de revision':
                         $estado_ ='pending'; 
                         break;
                     case 'Borrador':
                         $estado_ ='draft'; 
                         break;
                     case 'Cancelado':
                         $estado_ ='Cancelado'; 
                         break;
                     default:
                         $estado_ = $estado_1;
                         break;
                 } 
                 

            }else{$estado_1 = '%';
                  $estado_ = '%';}

            if(isset($_POST['cat'])){ 
                    $catego_1 = $_POST['cat']; 
                    }else{$catego_1 = '%';}

            if(isset($_POST['Autor_post'])){ 
                    $autor_1 = $_POST['Autor_post'];
                    }else{$autor_1 = '%';}

            if(isset($_POST['Nick_user'])){ 
                    $nick_1 = $_POST['Nick_user'];
                    }else{$nick_1 = '%';}   

            if(isset($_POST['fecha_ini'])){ 
                    $fecha_ini = $_POST['fecha_ini'];
                    }else{$fecha_ini = '%';}

            if(isset($_POST['fecha_fin'])){ 
                    $fecha_fin = $_POST['fecha_fin'];
                    }else{$fecha_fin = '%';}



require_once(SIGOES_PLUGIN_DIR.'/controller/ReporteController.php');
   $model_consulta = new ReporteController();
   // Consultas para llenar las opciones del select
   $estados_array    = $model_consulta->get_sql_post_status();
   $categorias_array = $model_consulta->get_sql_post_type();
   $rol_array        = $model_consulta->get_sql_rol_user();
   $nick_array       = $model_consulta->get_sql_nickname_user();   

    //Obtiene la consulta presentada en pantalla
    $sql_results = $model_consulta->get_sql_result_pantalla($estado_,$catego_1,$autor_1,$nick_1,$fecha_ini,$fecha_fin);
    // Obtiene consulta para crear archivo csv
    $array_results = $model_consulta->get_sql_result_csv($estado_,$catego_1,$autor_1,$nick_1,$fecha_ini,$fecha_fin); 



if(isset($_POST['filtra_fecha'])){
    if (isset($_POST['fecha_ini']) && !isset($_POST['fecha_fin'])){
        //alert : debe fijar las 2 fechas!
    }
}

    require(SIGOES_PLUGIN_DIR.'/controller/ReportePDF.php');
    if(isset($_POST['Export_action'])){ 
     
    $pdf_new = new Reporte_PDF();
    $pdf_new->get_elementos($estado_,$catego_1,$autor_1,$nick_1,$fecha_ini,$fecha_fin,$sql_results);
    //get_elementos($estado_,$catego_1,$autor_1,$nick_1,$fecha_ini,$fecha_fin,$sql_results);
    
    }

?>


<!--  Vista HTML -->        
<p class="search-box">
<label class="screen-reader-text" for="post-search-input">Buscar por Titulo:</label>
<input id="post-search-input" type="search" value="" name="titulo">
<input id="search-submit" class="button" type="submit" value="Buscar por Titulo">
</p>
<div class="tablenav top">
        <div class="alignleft actions bulkactions">
            <label class="screen-reader-text" for="bulk-action-selector-top">Filtrar por Estado</label>
            <form action="#" method="post">
            <TABLE>    
                <TR>
                  
                 <TD>
                 <h3>Estado</h3>     
                <select id="Estado_Post"  name = "Estado_Post" onchange = "javascript: submit()" >
                    <option selected="selected" value= "%">Todos los Estados</option>
                    <?php
                    $item1 = array();
                    $item_sttus = array();
                    foreach ($estados_array as $key => $value) {
                    $estado=$value['post_status'];
                    if(isset($_POST['Estado_Post']))
                    {
                      if($estado==$_POST['Estado_Post']) 
                      {
                        echo '<option value= "'.$estado.'" selected>';
                             echo $estado;
                            echo '</option>';
                      }
                       else
                       {
                        echo '<option value= "'.$estado.'">';
                             echo $estado;
                            echo '</option>';
                       }
                    }
                    else
                    {
                      echo '<option value= "'.$estado.'">';
                             echo $estado;
                            echo '</option>';  
                    }

                    
                    }
                    ?>
                </select>
                 </TD>
                 <TD>
            <label class="screen-reader-text" for="cat">Filtrar por categoría</label>
                <h3>Categoria</h3>
                <select id="cat" class="postform" name="cat" onchange = "javascript: submit()">
                    <option value="%">Todas las categorías</option>
                    <?php
                    $item2 = array();
                    foreach ( $categorias_array as $key =>$item2) 
                    {
                        $cat=$item2['post_type'];
                        if(isset($_POST['cat']))
                        {
                            if($cat==$_POST['cat'])
                            {
                            echo '<option value= "'.$cat.'" selected>';
                             echo $cat;
                            echo '</option>';
                            }
                            else
                            {
                            echo '<option value= "'.$cat.'">';
                             echo $cat;
                            echo '</option>';  
                            }
                        }
                        else
                        {
                            echo '<option value= "'.$cat.'">';
                             echo $cat;
                            echo '</option>'; 
                        }
                    }
                    ?>
                   
                </select>
                 </TD>
                 <TD>
            <label class="screen-reader-text" for="cat">Filtrar por Rol</label>
                    <h3>Rol</h3>
                    <select id="Autor_post" class="postform" name="Autor_post" onchange = "javascript: submit()">
                        <option value="%">Todos los Roles</option>
                        <?php
                        
                    $item3 = array();
                    foreach ( $rol_array as $key =>$item3) 
                    {
                       $rol=array_pop($item3);
                       if(isset($_POST['Autor_post']))
                        {
                            if($rol==$_POST['Autor_post'])
                            {
                            echo '<option value= "'.$rol.'" selected>';
                            echo $rol;
                            echo '</option>';
                            }
                            else
                            {
                            echo '<option value= "'.$rol.'">';
                            echo $rol;
                            echo '</option>';   
                            }
                        }
                        else
                        {
                            echo '<option value= "'.$rol.'">';
                            echo $rol;
                            echo '</option>';
                        }
                    
                    }
                    ?>
                   
                    </select>
                </TD>
                <TD>
            <label class="screen-reader-text" for="cat">Filtrar por Nickname</label>
                    <h3>Usuario</h3>
                    <select id="Nick_user" class="postform" name="Nick_user" onchange = "javascript: submit()">
                        <option value="%">Todos los Usuarios</option> 
                        <?php
                        
                        $item4 = array();
                    foreach ( $nick_array as $key =>$item4) 
                    {
                        $nick = $item4['meta_value'];
                        if(isset($_POST['Nick_user']))
                        {
                            if($nick==$_POST['Nick_user'])
                                {
                                 echo '<option value= "'.$nick.'" selected>';
                                 echo $nick;
                                 echo '</option>';
                                }
                            else
                                {
                                 echo '<option value= "'.$nick.'">';
                                 echo $nick;
                                 echo '</option>';   
                                }
                        }
                        else
                        {
                          echo '<option value= "'.$nick.'">';
                          echo $nick;
                          echo '</option>';  
                        }

                        ?>       
                    
                    <?php
                    }
                    ?>
                   
                    </select>
                    </TD>
                    <TD>
                <label class="screen-reader-text" for="filter-by-date"> Filtrar por fecha</label>
                <h3>Fecha inicio</h3>

                <link rel="stylesheet" href=<?php echo SIGOES_PLUGIN_DIR.'/js/Calendario/jquery-ui.css'?>>
                <script src=<?php echo SIGOES_PLUGIN_DIR.'/js/Calendario/jquery-1.9.1.js'?>></script>
                <script src=<?php echo SIGOES_PLUGIN_DIR.'/js/Calendario/jquery-ui.js' ?>></script> 

                <script>
                        $(function() {
                        $( '#fecha_ini' ).datepicker({dateFormat: 'yy-mm-dd',
                                                      timeFormat: 'HH:mm:ss', 
                                                                    firstDay: 1,
                                                                changeYear: true,
                                                                changeMonth: true,
                                                                
                                                                dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
                                                                dayNamesShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
                                                monthNames: 
                                                                ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
                                                                "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                                                monthNamesShort: 
                                                                ["Ene", "Feb", "Mar", "Abr", "May", "Jun",
                                                                "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"], 

                                                                onSelect: function(dateText, inst) {
                                                        var lockDate1 = new Date($('#fecha_ini').datepicker('getDate'));
                                                                //lockDate.setDate(lockDate.getDate() + 1);
                                                                $('input#fecha_fin').datepicker('option', 'minDate', lockDate1);
                                                                }
                                                                });



                        
                        $( '#fecha_fin' ).datepicker({dateFormat: 'yy-mm-dd', 
                                                                    firstDay: 1,
                                                                    changeMonth: true,
                                                                    changeYear: true,
                                                                dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
                                                                dayNamesShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
                                                monthNames: 
                                                                ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
                                                                "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                                                monthNamesShort: 
                                                                ["Ene", "Feb", "Mar", "Abr", "May", "Jun",
                                                                "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
                                                                changeYear: true,
                                                                changeMonth: true,});
                        
                        });

                </script>
                <?php 
                   if(isset($_POST['fecha_ini'])){
                    $Fecha1 = $_POST['fecha_ini'];
                    echo '<input type="text" id="fecha_ini" name = "fecha_ini" value = "'.$Fecha1.'" class = "date">';
                   }else{
                    echo '<input type="text" id="fecha_ini" name = "fecha_ini" class = "date"> ';
                   }
                 ?>           
                <!--<input type="text" id="fecha_ini" name = "fecha_ini" value = $_POST['fecha_ini']>  -->
                <!--<input type="text" id="fecha_ini" name = "fecha_ini" > -->
                
                </TD>
                <TD>
                    <h3>Fecha fin</h3>
                <?php 
                   if(isset($_POST['fecha_fin'])){
                    $Fecha2 = $_POST['fecha_fin'];
                    echo '<input type="text" id="fecha_fin" name = "fecha_fin" value = "'.$Fecha2.'" class = "date">';
                   }else{
                    echo '<input type="text" id="fecha_fin" name = "fecha_fin" class = "date"> ';
                   }
                 ?>   
                <!--<input type="text" id="fecha_fin" name = "fecha_fin" value = $_POST['fecha_fin']>
                <input type="text" id="fecha_fin" name = "fecha_fin">-->
                </TD>
                <TD>
                <input type="submit" class="button" value="Fitrar por fecha" name="filtra_fecha" id="post-query-submit">
                  <!--<input id="post-query-submit" class="button" type="submit" value="Filtrar" name="filter_action"> -->
                
                </TD>
                <TD>
                <input type="button" class="button" value="Reestablecer" onclick="window.location.href='admin.php?page=Reporte_SIOGOES'" action=$_SERVER['PHP_SELF']>
                </TD>
                <TD>
                <input id="export" class="button button-primary" type="submit" value="Exportar" name="Export_action">
                </TD>
                </TR>
            </TABLE>    
        </form>
        
        </div>
        <div class="alignleft actions"> 
             
             <!--<input id="post-query-export" class="button" type="submit" value="Exportar" name="Export_action">  -->
             
             <?php echo ' Estado: '. $estado_1;?>
             <?php echo ' Cat: '.$catego_1;?>
             <?php echo ' Rol_Autor: '.$autor_1;?>   
             <?php echo ' Nick: '.$nick_1;?> 
             <?php echo ' $fecha_ini: '.$fecha_ini;?> 
             <?php echo ' $fecha_fin: '.$fecha_fin;?> 
             <!--<p><a href="pdf.php">Ver tabla en PDF</a></p>-->

        </div>
        </div> 


<?php
        $fp= fopen('php://output', 'w+');
        $fp = fopen( SIGOES_PLUGIN_DIR.'controller/fichero.csv' , "w+" ); 
        
        
        $columnas = ["Post ID","Titulo","Categoria","Estado","Rol_Autor","Nombre_Autor","Apellido_Autor","Fecha_ini","Fecha_fin"];
        fputcsv($fp, $columnas, ",");
        foreach ($array_results as $valor) { // escribe tabla en archivo csv
            
            fputcsv($fp, $valor, ",");
        }
       
        rewind( $fp );    
      
        fclose($fp);

    
        return $sql_results;
        }

        public function set_order()
        {
            $order = 'DESC';
            if (isset($_GET['order']) AND $_GET['order'])
                    $order = $_GET['order'];
            $this->order = esc_sql($order);
        }

        public function set_orderby()
        {
            $orderby = 'create_date';
            if (isset($_GET['orderby']) AND $_GET['orderby'])
                    $orderby = $_GET['orderby'];
            $this->orderby = esc_sql($orderby);
        }

        /**
         * @see WP_List_Table::ajax_user_can()
         */
        public function ajax_user_can()
        {
            return current_user_can('edit_posts');
        }

        /**
         * @see WP_List_Table::no_items()
         */
        public function no_items()
        {
            _e('No se encontraron Registros');
        }

        /**
         * @see WP_List_Table::get_views()
         */
        public function get_views()
        {
            return array();
        }


        /**
         * @see WP_List_Table::get_columns()
         */
        public function get_columns()
        {
            $columns = array(  
                'ID' => __('No'),
                'post_title' => __('Titulo'),
                'post_type' => __('Categoria'),
                'post_status' => __('Estado'),
                'Rol_Autor' =>__('Rol_Autor'),
                'alias' => __('ID_Usuario'),  
                'nombre' => __('Nombre'), 
                'Fecha_Creacion' => __('Fecha_Creado'),
                'Fecha_Modificacion' =>__('Fecha_Modificacdo')                
            );
            return $columns;
        }

        /**
         * @see WP_List_Table::get_sortable_columns()
         */
        public function get_sortable_columns()
        {
            $sortable = array(
                'No' => array('No', true),
                'Titulo' => array('post_title', true),
                'Categoria' => array('post_type', true),
                'Estado' => array('post_status', true),
                'Rol_Autor' => array('Rol_Autor', true),  
                'ID_Usuario' => array('alias', true),
                'Nombre' => array('nombre', true), 
                'Fecha_Creado' => array('Fecha_Creacion', true),                
                'Fecha_modificado' => array('Fecha_modificacion', true)
            );
            return $sortable;
        }

        /**
         * Prepare data for display
         * @see WP_List_Table::prepare_items()
         */
        public function prepare_items()
        {
            $columns = $this->get_columns();
            $hidden = array();
            $sortable = $this->get_sortable_columns();
            $this->_column_headers = array(
                $columns,
                $hidden,
                $sortable
            );

            // SQL results
            $posts = $this->get_sql_results();
            $mi_sql_result = $posts;
            empty($posts) AND $posts = array();

            # >>>> Pagination
            $per_page = $this->posts_per_page;
            $current_page = $this->get_pagenum();
            $total_items = count($posts);
            $this->set_pagination_args(array(
                'total_items' => $total_items,
                'per_page' => $per_page,
                'total_pages' => ceil($total_items / $per_page)
            ));
            $last_post = $current_page * $per_page;
            $first_post = $last_post - $per_page + 1;
            $last_post > $total_items AND $last_post = $total_items;

            // Setup the range of keys/indizes that contain 
            // the posts on the currently displayed page(d).
            // Flip keys with values as the range outputs the range in the values.
            $range = array_flip(range($first_post - 1, $last_post - 1, 1));

            // Filter out the posts we're not displaying on the current page.
            $posts_array = array_intersect_key($posts, $range);
            # <<<< Pagination
            // Prepare the data
            $permalink = __('Edit:');
            foreach ($posts_array as $key => $post) {
                $link = get_edit_post_link($post->ID);
                $no_title = __('Sin titulo');
                $title = !$post->post_title ? "<em>{$no_title}</em>" : $post->post_title;
                $posts[$key]->post_title = "<a title='{$permalink} {$title}' href='{$link}'>{$title}</a>";
             }

            $this->items = $posts_array;


        }

        /**
         * A single column
         */
        public function column_default($item, $column_name)
        {
            return $item->$column_name;
        }

        /**
         * Override of table nav to avoid breaking with bulk actions & according nonce field
         */
        public function display_tablenav($which)
        {

            ?>
            <div class="tablenav <?php echo esc_attr($which); ?>">
                <!-- 
                <div class="alignleft actions">
                <?php # $this->bulk_actions( $which );    ?>
                </div>
                -->
                <?php
                $this->extra_tablenav($which);
                $this->pagination($which);

                ?>
                <br class="clear" />
            </div>
            <?php
        }

        /**
         * Disables the views for 'side' context as there's not enough free space in the UI
         * Only displays them on screen/browser refresh. Else we'd have to do this via an AJAX DB update.
         * 
         * @see WP_List_Table::extra_tablenav()
         */
        public function extra_tablenav($which)
        {
            global $wp_meta_boxes;
            $views = $this->get_views();
            if (empty($views)) return;

            $this->views();
        }

    }

}

?>