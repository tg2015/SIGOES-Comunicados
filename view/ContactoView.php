<?php
/*
*Nombre del módulo: ContactoView
*Objetivo: Mostrar los contactos de cada institucion
*Dirección física: /SIGOES-Comunicados/view/ContactoView.php
*/
require_once(ABSPATH.'wp-admin/includes/class-wp-list-table.php');
class ContactoView extends WP_List_Table
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
	//$id=$_GET['id'];
    $idInstitucion=$_POST['idInstitucion'];
    require_once(SIGOES_PLUGIN_DIR.'/controller/InstitucionController.php');
    $institucionController = new InstitucionController();
    $resultados=$institucionController->get_contactos($idInstitucion);
    $institucion=$institucionController->get_institucion($idInstitucion);
    foreach($institucion as $row)
    {
        $nombre=$row->nombreInstitucion;
        $descripcion=$row->descripcionInstitucion;
        $telefono=$row->telefonoInstitucion;
        $url=$row->urlInstitucion;
        $direccion=$row->direccionInstitucion;
    }
    echo '<form method="post" action="admin.php?page=AgregarContacto"><h1>Contactos de '.$nombre.'&nbsp;&nbsp;<input class="add-new-h2" type="submit" class="button" value="Agregar Nuevo" name="Agregar Nuevo"><input type="hidden" value="'.$idInstitucion.'" name="idInstitucion"></form></h1>
    <br/>
    <input id="regresar"    type="button"   class="button-primary"          value="<< Regresar"    onclick=location.href="admin.php?page=Instituciones">
    ';
    //<h2>Contactos de '.$nombre.'&nbsp;&nbsp;<input id="agregar" class="add-new-h2" type="button" value="Agregar Nuevo" name="Agregar Nuevo" onclick=location.href="admin.php?page=AgregarContacto&idInstitucion='.$id.'"></h2>
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
                'idContacto' => __('Id'),
                'nombreContacto' => __('Nombre'),
                'telefonoContacto' => __('Telefono'),
                'emailContacto' => __('Email'),
                'puestoContacto' => __('Puesto'),
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
                'idContacto' => array('idContacto', true)/*,
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
                //$row->Editar="<a href=admin.php?page=AgregarContacto&id=".$row->idContacto.">Editar</a>";
                $row->Editar='<form action="admin.php?page=AgregarContacto" method="post"><input class="button" type="submit" value="Editar" name="Editar"><input type="hidden" value="'.$row->idContacto.'" name="idContacto"></form>';
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