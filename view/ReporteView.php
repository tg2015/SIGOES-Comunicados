<?php

if(isset($_POST['Estado_Post'])){ 
                $post_status = $_POST['Estado_Post'];
                switch ($post_status) {
                     case 'Publicado':
                         $estado ='publish';
                         break;
                     case 'Pendiente de revision':
                         $estado ='pending'; 
                         break;
                     case 'Borrador':
                         $estado ='draft'; 
                         break;
                     case 'Cancelado':
                         $estado ='Cancelado'; 
                         break;
                     default:
                         $estado = $post_status;
                         break;
                 } 
                 

            }else{$post_status = '%';
                  $estado = '%';}

            if(isset($_POST['Reportecat'])){ 
                    $cat = $_POST['Reportecat']; 
                    }else{$cat = '%';}

            if(isset($_POST['Autor_post'])){ 
                    $autor = $_POST['Autor_post'];
                    }else{$autor = '%';}

            if(isset($_POST['Nick_user'])){ 
                    $nick = $_POST['Nick_user'];
                    }else{$nick = '%';}               

            if(isset($_POST['fecha_ini'])){ 
                    $fecha_ini = $_POST['fecha_ini'];
                    }else{$fecha_ini = '%';}

            if(isset($_POST['fecha_fin'])){ 
                    $fecha_ini = $_POST['fecha_fin'];
                    }else{$fecha_fin = '%';}

            if(isset($_POST['titulo'])){ 
                    $fecha_ini = $_POST['titulo'];
                    }else{$filtro_titulo = '%';}



//if (!class_exists('WP_List_Table')) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );

    class ReporteView extends WP_List_Table
    {

        private $order;
        private $orderby;
        private $posts_per_page = 10;

        public function __construct()   
        {
            parent :: __construct(array(
            'singular' => "ftraveler",
            'plural' => "ftraveler",
            'ajax' => true ));
            $this->set_order();
            $this->set_orderby();
            $this->prepare_items();
            $this->display();

        }

private function get_sql_results()  
        {
            if(isset($_POST['Estado_Post'])){ 
                $post_status = $_POST['Estado_Post'];
                switch ($post_status) {
                     case 'Publicado':
                         $estado ='publish';
                         break;
                     case 'Pendiente de revision':
                         $estado ='pending'; 
                         break;
                     case 'Borrador':
                         $estado ='draft'; 
                         break;
                     case 'Cancelado':
                         $estado ='Cancelado'; 
                         break;
                     default:
                         $estado = $post_status;
                         break;
                 } 
                 

            }else{$post_status = '%';
                  $estado = '%';}

            if(isset($_POST['Reportecat'])){ 
                    $cat = $_POST['Reportecat']; 
                    }else{$cat = '%';}

            if(isset($_POST['Autor_post'])){ 
                    $autor = $_POST['Autor_post'];
                    }else{$autor = '%';}

            if(isset($_POST['Nick_user'])){ 
                    $nick = $_POST['Nick_user'];
                    }else{$nick = '%';}   

            if(isset($_POST['fecha_ini'])){ 
                    $fecha_ini = $_POST['fecha_ini'];
                    }else{$fecha_ini = '%';}

            if(isset($_POST['fecha_fin'])){ 
                    $fecha_fin = $_POST['fecha_fin'];
                    }else{$fecha_fin = '%';}

            if(isset($_POST['titulo'])){ 
                    $filtro_titulo = $_POST['titulo'];
                    }else{$filtro_titulo = '%';}

   require_once(SIGOES_PLUGIN_DIR.'/controller/ReporteController.php');
   $reporteController = new ReporteController();
   // Consultas para llenar las opciones del select
   $estados     = $reporteController->get_sql_post_status();
   $categorias  = $reporteController->get_sql_post_type();
   $roles       = $reporteController->get_sql_rol_user();
   $nicks       = $reporteController->get_sql_nickname_user();   

    //Obtiene la consulta presentada en pantalla
    $sql_results = $reporteController->get_sql_result_pantalla($estado,$cat,$autor,$nick,$fecha_ini,$fecha_fin,$filtro_titulo);

    // Obtiene consulta para crear archivo csv
    //$array_results = $reporteController->get_sql_result_csv($estado,$cat,$autor,$nick,$fecha_ini,$fecha_fin); 
    
    ///////////////// EXPORTAR ARCHIVOS PDF Y CSV    
    $fechaInExportar = $fecha_ini;
    $fechaFinExportar = $fecha_fin;

    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : 'pdf'; 
    
    if(isset($_POST['Exportar']))
    {
    $arrayExportar = $array_results;
    $estadoExportar = $_POST['ExportarEstado']; // Estado
    $categoExportar = $_POST['ExportarCat']; // Categoria
    $rolExportar = $_POST['ExportarAutor'];       // Rol
    $nickExportar = $_POST['ExportarNick'];     // Nick 

    
    
    }// fin if exportar

if(isset($_POST['filtra_fecha'])){
    if (isset($_POST['fecha_ini']) && !isset($_POST['fecha_fin'])){
        //alert : debe fijar las 2 fechas!
    }
}

?>


<!--  Vista HTML -->        

<div class="tablenav top widefat fixed">
        <div class="alignleft actions bulkactions">
            <label class="screen-reader-text" for="bulk-action-selector-top">Filtrar por Estado</label>
            <form action="admin.php?page=ReporteComunicados" method="post" target="_blank">
            <p>
            <input id="export" class="button button-primary" type="submit" value="Exportar" name="Exportar">
            <input name="formato" type="radio" value="pdf" checked>PDF
            <input name="formato" type="radio" value="xls">XLS
            </p>
            <input type="hidden" value="<?php echo $estado; ?>" name="ExportarEstado" />
            <input type="hidden" value="<?php echo $cat; ?>" name="ExportarCat" />
            <input type="hidden" value="<?php echo $autor; ?>" name="ExportarAutor" />
            <input type="hidden" value="<?php echo $nick; ?>" name="ExportarNick" />
            <input type="hidden" value="<?php echo $fecha_ini; ?>" name="ExportarFechaIni" />
            <input type="hidden" value="<?php echo $fecha_fin; ?>" name="ExportarFechaFin" />
            </form>
            <form action="" method="post">      
            <TABLE class="widefat" >    
                <TR>
                <!--Filtro Estado de Publicacion-->  
                <TD>
                <h3>Estado</h3>     
                <select id="Estado_Post"  name = "Estado_Post" onchange = "javascript: submit()" >
                    <option selected="selected" value= "%">Todos los Estados</option>
                    <?php
                    foreach ($estados as $key => $value) {
                    $estadoFiltro=$value['post_status'];
                    if(isset($_POST['Estado_Post']))
                    {
                      if($estadoFiltro==$_POST['Estado_Post']) 
                      {
                        echo '<option value= "'.$estadoFiltro.'" selected>';
                             echo $estadoFiltro;
                            echo '</option>';
                      }
                       else
                       {
                        echo '<option value= "'.$estadoFiltro.'">';
                             echo $estadoFiltro;
                            echo '</option>';
                       }
                    }
                    else
                    {
                      echo '<option value= "'.$estadoFiltro.'">';
                             echo $estadoFiltro;
                            echo '</option>';  
                    }

                    
                    }
                ?>
                </select>
                 </TD>
                 <!--Filtro Categorias de Publicacion-->  
                <TD>
                <label class="screen-reader-text" for="Reportecat">Filtrar por categoría</label>
                <h3>Categoria</h3>
                <select id="Reportecat" class="postform" name="Reportecat" onchange = "javascript: submit()">
                    <option value="%">Todas las categorías</option>
                    <?php
                    
                    foreach ( $categorias as $key =>$value) 
                    {
                        $catFiltro=$value['post_type'];
                        if(isset($_POST['Reportecat']))
                        {
                            if($catFiltro==$_POST['Reportecat'])
                            {
                            echo '<option value= "'.$catFiltro.'" selected>';
                             echo $catFiltro;
                            echo '</option>';
                            }
                            else
                            {
                            echo '<option value= "'.$catFiltro.'">';
                             echo $catFiltro;
                            echo '</option>';  
                            }
                        }
                        else
                        {
                            echo '<option value= "'.$catFiltro.'">';
                             echo $catFiltro;
                            echo '</option>'; 
                        }
                    }
                    ?>
                   
                </select>
                </TD>
                <TD>
                <!--Filtro Rol de Usuario-->  
                <label class="screen-reader-text" for="cat">Filtrar por Rol</label>
                    <h3>Rol</h3>
                    <select id="Autor_post" class="postform" name="Autor_post" onchange = "javascript: submit()">
                        <option value="%">Todos los Roles</option>
                    <?php
                        
                    foreach ( $roles as $key =>$value) 
                    {
                       $rolFiltro=array_pop($value);
                       if(isset($_POST['Autor_post']))
                        {
                            if($rolFiltro==$_POST['Autor_post'])
                            {
                            echo '<option value= "'.$rolFiltro.'" selected>';
                            echo $rolFiltro;
                            echo '</option>';
                            }
                            else
                            {
                            echo '<option value= "'.$rolFiltro.'">';
                            echo $rolFiltro;
                            echo '</option>';   
                            }
                        }
                        else
                        {
                            echo '<option value= "'.$rolFiltro.'">';
                            echo $rolFiltro;
                            echo '</option>';
                        }
                    
                    }
                    ?>
                   
                    </select>
                </TD>
                <!--Filtro Usuario de SIGOES-->  
               <!-- <TD>
                <label class="screen-reader-text" for="cat">Filtrar por Nickname</label>
                    <h3>Usuario</h3>
                    <select id="Nick_user" class="postform" name="Nick_user" onchange = "javascript: submit()">
                        <option value="%">Todos los Usuarios</option> 
                    <?php
                        
                    foreach ( $nicks as $key =>$value) 
                    {
                        $nickFiltro = $value['meta_value'];
                        if(isset($_POST['Nick_user']))
                        {
                            if($nickFiltro==$_POST['Nick_user'])
                                {
                                 echo '<option value= "'.$nickFiltro.'" selected>';
                                 echo $nickFiltro;
                                 echo '</option>';
                                }
                            else
                                {
                                 echo '<option value= "'.$nickFiltro.'">';
                                 echo $nickFiltro;
                                 echo '</option>';   
                                }
                        }
                        else
                        {
                          echo '<option value= "'.$nickFiltro.'">';
                          echo $nickFiltro;
                          echo '</option>';  
                        }

                    }
                    ?>
                   
                    </select>
                    </TD>
                    -->
                    <TD>
                    <label class="screen-reader-text" for="filter-by-date"> Filtrar por fecha</label>
                    <h3>Fecha inicio</h3>
                      <script>
                        jQuery(document).ready(function() {
                        jQuery( '#fecha_ini' ).datepicker({dateFormat: 'dd-mm-yy',
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
                                                        var lockDate1 = new Date(jQuery('#fecha_ini').datepicker('getDate'));
                                                                //lockDate.setDate(lockDate.getDate() + 1);
                                                                jQuery('input#fecha_fin').datepicker('option', 'minDate', lockDate1);
                                                                }
                                                                });



                        
                        jQuery( '#fecha_fin' ).datepicker({dateFormat: 'dd-mm-yy',
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
                    $fecha_ini = $_POST['fecha_ini'];
                    echo '<input type="date" id="fecha_ini" name = "fecha_ini" value = "'.$fecha_ini.'" class = "date" size=10 min="01-01-2005 00:00:00">';
                   }else{
                    echo '<input type="date" id="fecha_ini" name = "fecha_ini" class = "date" size=10 min="01-01-2005 00:00:00">';
                   }
                ?>           
                </TD>
                <TD>
                    <h3>Fecha fin</h3>
                <?php
                   if(isset($_POST['fecha_fin'])){
                    $fecha_fin = $_POST['fecha_fin'];
                    echo '<input type="date" id="fecha_fin" name = "fecha_fin" value = "'.$fecha_fin.'" class = "date" size=10 min="01-01-2005 00:00:00">';
                   }else{
                    echo '<input type="date" id="fecha_fin" name = "fecha_fin" class = "date" size=10 min="01-01-2005 00:00:00"> ';
                   }
                ?>   
                </TD>
                
                <TD>
                <br/>
                <input type="submit" class="button" value="Fitrar por fecha" name="filtra_fecha" id="post-query-submit">
                </TD>
                <TD>
                <br/>
                <input type="button" class="button" value="Reestablecer" onclick="window.location.href='admin.php?page=Reporte_SIGOES'" action=$_SERVER['PHP_SELF']>
                </TD>
                <TD>

                  <br/>
                  <label class="screen-reader-text" for="post-search-input">Buscar por Titulo:</label>
                  <input id="post-search-input" type="search" value="" name="titulo">
                  <input id="search-submit" class="button" type="submit" value="Buscar por Titulo">
                  
                </TD> 
        </form>
        
       
                <TD>
                </TD>
                </TR>
            </TABLE>    
        
        
        </div>
       
        </div> 


<?php
        
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
                'Fecha_Creacion' => __('Fecha/hora Creado'),
                'Fecha_Modificacion' =>__('Fecha/hora Modificado')                
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
                //'Rol_Autor' => array('Rol_Autor', true),  
                'ID_Usuario' => array('alias', true),
                'Nombre' => array('nombre', true), 
                //'Fecha_Creacion' => array('Fecha_Creacion', true),                
                //'Fecha_Modificacion' => array('Fecha_Modificacion', true)
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
            //$per_page = $this->posts_per_page; //  numero de post por pagina
            $per_page = 50;
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
            $No = 0;
            foreach ($posts_array as $key => $post) {
                // calculo de numero de post por fila
                $No = $No + 1;
                $posts[$key]->ID = $No;
                
                $no_title = __('Sin titulo');
                if($posts[$key]->post_title == NULL)
                {$posts[$key]->post_title = "<em>{$no_title}</em>";}
                
                $FC = $posts[$key]->Fecha_Creacion;
                $FC_br1 = substr( $FC, -8);
                $FC_br2 = substr( $FC, 0, 10);
                $posts[$key]->Fecha_Creacion = "".$FC_br2."<br />".$FC_br1;

                $FM = $posts[$key]->Fecha_Modificacion;
                $FM_br1 = substr( $FM, -8);
                $FM_br2 = substr( $FM, 0, 10);
                $posts[$key]->Fecha_Modificacion = "".$FM_br2."<br />".$FM_br1;
                
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
            <div class="tablenav <?php echo esc_attr($which); ?> widefat fixed">
                
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

    //}

}

?>