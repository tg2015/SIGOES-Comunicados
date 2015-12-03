<?php
/*
*Nombre del módulo: InstitucionView
*Objetivo: Mostrar las instituciones que se encuentran implementando el plugin-sigoes
*Dirección física: /SIGOES-Comunicados/view/InstitucionView.php
*/
require_once(ABSPATH.'wp-admin/includes/class-wp-list-table.php');

class InstitucionView extends WP_List_Table
{

private $order;
private $orderby;
private $posts_per_page = 10;

    public function __Construct()   
    {
    parent :: __Construct(array(
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
    $nombre="";
    if(isset($_POST['titulo']))
    {$nombre = $_POST['titulo'];}

    require_once(SIGOES_PLUGIN_DIR.'/controller/InstitucionController.php');
    $institucionController = new InstitucionController();
    
    if(isset($_POST['Comprobar']))
    {
        $resultados=$institucionController->comprobar_estado_instituciones($nombre);
    }
    else
    {
        $resultados=$institucionController->get_instituciones($nombre);
    }
    
    echo '<h1>Instituciones&nbsp;&nbsp;<input id="agregar" class="add-new-h2" type="button" value="Agregar Nuevo" name="Agregar Nuevo" onclick=location.href="admin.php?page=AgregarInstitucion"></h1>
    <br/>
    <table width="100%">
    <tr>
    <td>
    <form method="post" action="admin.php?page=ReporteInstituciones" target="_blank">
    <input id="Exportar" type="submit" class="button-primary" value="Exportar" name="Exportar">
    <input name="formato" type="radio" value="pdf" checked>PDF
    &nbsp;&nbsp;&nbsp;&nbsp;
     <select name="tipoReporte">
        <option value="inaccesible">Sitios Web Inaccesibles</option>
        <option value="parametros">Parametros de Conexion</option>
        <option value="instituciones">Instituciones</option>
    </select>
    <label>Tipo de Reporte</label>
    </form>
    </td>
    
    <form action="#" method="post">
    <td>
    <div class="table-nav-top">   
        <label class="screen-reader-text" for="post-search-input">Buscar por Nombre:</label>
        <input id="post-search-input" type="search" value="'.$nombre.'" name="titulo" onkeypress="return soloLetras(event)">
        <input id="search-submit" class="button-primary" type="submit" value="Buscar por Nombre" name="Buscar">
    <input id="comprobar"     class="button" type="submit" value="Comprobar" name="Comprobar" onclick="ShowProgressAnimation();">
    </div>
    </td>    
    </form>

    <form action="#" method="post">
    <td><input id="reestablecer" class="button" type="submit" value="Reestablecer" name="Reestablecer"></td>
    </form>
    
    </tr>
    </table>
    <div id="loading-div-background">
        <div id="loading-div" class="ui-corner-all">
            <img style="height:60%;width:55%;margin:10px;"src="'.plugins_url().'/SIGOES-Comunicados/includes/img/cargando.gif" alt="Comprobando.."/><br>Comprobando. Porfavor Espere...
        </div>
    </div>
    ';
    //echo '<input name="formato" type="radio" value="xls">XLS';
    return $resultados;
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
                'idInstitucion' => __('Id'),
                'nombreInstitucion' => __('Nombre'),
                'descripcionInstitucion' => __('Descripcion'),
                'telefonoInstitucion' => __('Telefono'),
                'urlInstitucion' => __('Url'),
                'direccionInstitucion' => __('Direccion'),
                'estadoInstitucion' => __('Estado'),
                'estadoPlugin' => __('Plugin'),
                'Contacto' => __('Contacto'),
                'Editar' => __('Editar')              
            );
            return $columns;
        }

        /**
         * @see WP_List_Table::get_sortable_columns()
         */
        public function get_sortable_columns()
        {
            $sortable = array(
                'idInstitucion' => array('idInstitucion', true)/*,
                'nombreInstitucion' => array('nombreInstitucion', false),
                'descripcionInstitucion' => array('descripcionInstitucion', false),
                'telefonoInstitucion' => array('telefonoInstitucion', false)*/
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
            $rows = $this->get_sql_results();
            $mi_sql_result = $rows;
            empty($rows) AND $rows = array();

            # >>>> Pagination
            $per_page = $this->posts_per_page;
            $current_page = $this->get_pagenum();
            $total_items = count($rows);
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
            $rows_array = array_intersect_key($rows, $range);
            # <<<< Pagination
            foreach ($rows_array as $key => $row) {
                $row->Editar='<form method="post" action="admin.php?page=AgregarInstitucion"><input type="submit" class="button" value="Editar" name="Editar">
                <input type="hidden" value="'.$row->idInstitucion.'" name="idInstitucion"></form>';
                $row->Contacto='<form method="post" action="admin.php?page=Contactos"><input type="submit" class="button-primary" value="Ver Contacto" name="Ver Contacto">
                <input type="hidden" value="'.$row->idInstitucion.'" name="idInstitucion"></form>';
                
                $row->urlInstitucion="<a href=".$row->urlInstitucion."/feed target=blank >".$row->urlInstitucion."/feed</a>";
                if($row->estadoInstitucion=='Inaccesible')
                    {
                    $row->estadoInstitucion='<span style="color:#e32;">'.$row->estadoInstitucion.'</span>';
                    }
             }

            $this->items = $rows_array;


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

            echo '<div class="tablenav '.$which.' widefat fixed">';
            $this->extra_tablenav($which);
            $this->pagination($which);
            echo '<br class="clear" /></div>';
            
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
?>