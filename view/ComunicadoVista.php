<?php
class ComunicadoVista 
{
	
	function __construct()
	{
		# code...
	}
	public function RenderAyudaComunicado(  ) {
 // $contextual_help .= var_dump( $screen ); // use this to help determine $screen->id
  		function ProyectoAyuda($contextual_help, $screen_id, $screen){
		 global $pagenow;

  switch ($screen->id) {
    //Control de Ayuda para PROYECTOS
    case 'proyecto':
       //Ayuda Para Editar un Proyecto
      if ( in_array( $pagenow, array( 'post.php' ))&& $screen->id=='proyecto'  )
      {
         $contextual_help =
          '<p><strong>Agregar Nuevo: </strong> publicar un nuevo proyecto.</p>' .
          '<p><strong>Estado: </strong> cambiar el estado de la publicacion del proyecto.</p>' .
          '<p><strong>Publicada el: </strong> programar publicacion en la fecha y hora seleccionada.</p>' .
          '<p><strong>Actualizar: </strong> guardar los cambios realizados al proyecto.</p>' .
          '<p><strong>Asigmar imagen destacada: </strong> permite asignar una imagen para el proyecto (obligatoria).</p>' .
           '<p><strong>Contenido: </strong>Debe ingresar la direccion url a la que sera redireccionado el visitante y que contiene la informacion del proyecto.</p>' 
           ;
      
            
      }elseif (in_array( $pagenow, array( 'post-new.php' ))&& $screen->id=='proyecto') {
          //Ayuda Para Nuevo Proyecto.
          $contextual_help =
           '<p><strong>Guardar Borrador: </strong>guardar el proyecto como borrador sin publicarlo.</p>'.
           '<p><strong>Estado: </strong>cambiar el estado de la publicacion del proyecto.</p>'.
           '<p><strong>Publicar inmediatamente: </strong> programar publicacion automatica en la fecha y hora seleccionada.</p>'.
           '<p><strong>Publicar: </strong> Opcion de publicar un proyecto.</p>'.
           '<p><strong>Asigmar imagen destacada: </strong> permite asignar una imagen para el proyecto (obligatoria).</p>'.
           '<p><strong>Contenido: </strong>Debe ingredar la direccion url a la que sera redireccionado el visitante y que contiene la informacion del proyecto.</p>'
           ;        
      }
      return $contextual_help;
    break;
    case 'edit-proyecto':
      if ( in_array( $pagenow, array( 'edit.php' ) ) && $screen->id=='edit-proyecto')
        {
          //Ayuda Para Lista Proyecto.
        $contextual_help =
          '<p><strong>Agregar Nuevo: </strong> Agregar un nuevo proyecto.</p>' .
          '<p><strong>Todos: </strong> listar todos los proyectos.</p>' .
          '<p><strong>Mios: </strong> listar todos los proyectos del usuario logueado.</p>' .
          '<p><strong>Publicadas: </strong> listar todos los proyectos publicados.</p>' .
          '<p><strong>Borradores: </strong> listar todos los proyectos guardados como borrador.</p>' .
          '<p><strong>Papelera: </strong> listar todos los proyectos en la Papelera.</p>' .
          '<p><strong>Cancelados: </strong> listar todos los proyectos cancelados.</p>' .
          '<p><strong>Buscar Proyectos: </strong> listar todos los proyectos cancelados.</p>' .
          '<p><strong>Acciones en lote: </strong> permite realizar acciones para todos los proyectos seleccionados.</p>' .
          '<p><strong>Ver: </strong> Vista previa del contenido del proyecto publicado.</p>' .
          '<p><strong>Vista previa: </strong> Vista previa del contenido del proyecto.</p>' .
          '<p><strong>Restaurar: </strong> restaurar un proyecto a su estado anterior</p>' .
           '<p><strong>Borrar permanentemente: </strong>Borrar un proyecto sin posibilidad de restaurarlo.</p>' 
           ;
      }
      return $contextual_help;
    break;
///////////////////////////////////////////////////////////////////////////////////
 case 'evento':
       //Ayuda Para Editar un Proyecto
      if ( in_array( $pagenow, array( 'post.php' ))&& $screen->id=='evento'  )
      {
         $contextual_help =
          '<p><strong>Agregar Nuevo: </strong> publicar un nuevo evento.</p>' .
          '<p><strong>Estado: </strong> cambiar el estado de la publicacion del evento.</p>' .
          '<p><strong>Publicada el: </strong> programar publicacion en la fecha y hora seleccionada.</p>' .
          '<p><strong>Actualizar: </strong> guardar los cambios realizados al evento.</p>' .
          '<p><strong>Contenido: </strong>Debe ingresar la direccion url a la que sera redireccionado el visitante y que contiene la informacion del evento.</p>' 
           ;
      }elseif (in_array( $pagenow, array( 'post-new.php' ))&& $screen->id=='evento') {
          //Ayuda Para Nuevo evento.
         $contextual_help =
           '<p><strong>Guardar Borrador: </strong>guardar el evento como borrador sin publicarlo.</p>'.
           '<p><strong>Estado: </strong>cambiar el estado de la publicacion del evento.</p>'.
           '<p><strong>Publicar inmediatamente: </strong> programar publicacion automatica en la fecha y hora seleccionada.</p>'.
           '<p><strong>Publicar: </strong> Opcion de publicar un evento.</p>'.
           '<p><strong>Contenido: </strong>Debe ingredar la direccion url a la que sera redireccionado el visitante y que contiene la informacion del evento.</p>'
           ;            
      }
      return $contextual_help;
    break;
case 'edit-evento':
      if ( in_array( $pagenow, array( 'edit.php' ) ) && $screen->id=='edit-evento')
        {
          //Ayuda Para Lista evento.
        $contextual_help =
          '<p><strong>Agregar Nuevo: </strong> Agregar un nuevo evento.</p>' .
          '<p><strong>Todos: </strong> listar todos los eventos.</p>' .
          '<p><strong>Mios: </strong> listar todos los eventos del usuario logueado.</p>' .
          '<p><strong>Publicadas: </strong> listar todos los eventos publicados.</p>' .
          '<p><strong>Borradores: </strong> listar todos los eventos guardados como borrador.</p>' .
          '<p><strong>Papelera: </strong> listar todos los eventos en la Papelera.</p>' .
          '<p><strong>Cancelados: </strong> listar todos los eventos cancelados.</p>' .
          '<p><strong>Buscar eventos: </strong> listar todos los eventos cancelados.</p>' .
          '<p><strong>Acciones en lote: </strong> permite realizar acciones para todos los eventos seleccionados.</p>' .
          '<p><strong>Ver: </strong> Vista previa del contenido del evento publicado.</p>' .
          '<p><strong>Vista previa: </strong> Vista previa del contenido del evento.</p>' .
          '<p><strong>Restaurar: </strong> restaurar un evento a su estado anterior</p>' .
           '<p><strong>Borrar permanentemente: </strong>Borrar un evento sin posibilidad de restaurarlo.</p>' 
           ;
      }
      return $contextual_help;
    break;
case 'streaming':
       //Ayuda Para Editar un Streaming
      if ( in_array( $pagenow, array( 'post.php' ))&& $screen->id=='streaming'  )
      {
         $contextual_help =
          '<p><strong>Agregar Nuevo: </strong> publicar un nuevo streaming.</p>' .
          '<p><strong>Estado: </strong> cambiar el estado de la publicacion del streaming.</p>' .
          '<p><strong>Publicada el: </strong> programar publicacion en la fecha y hora seleccionada.</p>' .
          '<p><strong>Actualizar: </strong> guardar los cambios realizados al streaming.</p>' .
          '<p><strong>Contenido: </strong>Debe ingresar la direccion url a la que sera redireccionado el visitante y que contiene la informacion del streaming.</p>' 
           ;
      }elseif (in_array( $pagenow, array( 'post-new.php' ))&& $screen->id=='streaming') {
          //Ayuda Para Nuevo streaming.
         $contextual_help =
           '<p><strong>Guardar Borrador: </strong>guardar el streaming como borrador sin publicarlo.</p>'.
           '<p><strong>Estado: </strong>cambiar el estado de la publicacion del streaming.</p>'.
           '<p><strong>Publicar inmediatamente: </strong> programar publicacion automatica en la fecha y hora seleccionada.</p>'.
           '<p><strong>Publicar: </strong> Opcion de publicar un streaming.</p>'.
           '<p><strong>Contenido: </strong>Debe ingredar la direccion url a la que sera redireccionado el visitante y que contiene la informacion del streaming.</p>'
           ;            
      }
      return $contextual_help;
    break;
case 'edit-streaming':
      if ( in_array( $pagenow, array( 'edit.php' ) ) && $screen->id=='edit-streaming')
        {
          //Ayuda Para Lista streaming.
        $contextual_help =
          '<p><strong>Agregar Nuevo: </strong> Agregar un nuevo streaming.</p>' .
          '<p><strong>Todos: </strong> listar todos los streaming.</p>' .
          '<p><strong>Mios: </strong> listar todos los streaming del usuario logueado.</p>' .
          '<p><strong>Publicadas: </strong> listar todos los streaming publicados.</p>' .
          '<p><strong>Borradores: </strong> listar todos los streaming guardados como borrador.</p>' .
          '<p><strong>Papelera: </strong> listar todos los streaming en la Papelera.</p>' .
          '<p><strong>Cancelados: </strong> listar todos los streaming cancelados.</p>' .
          '<p><strong>Buscar streaming: </strong> listar todos los streaming cancelados.</p>' .
          '<p><strong>Acciones en lote: </strong> permite realizar acciones para todos los streaming seleccionados.</p>' .
          '<p><strong>Ver: </strong> Vista previa del contenido del streaming publicado.</p>' .
          '<p><strong>Vista previa: </strong> Vista previa del contenido del streaming.</p>' .
          '<p><strong>Restaurar: </strong> restaurar un streaming a su estado anterior</p>' .
           '<p><strong>Borrar permanentemente: </strong>Borrar un streaming sin posibilidad de restaurarlo.</p>' 
           ;
      }
      return $contextual_help;
    break;
case 'otros':
       //Ayuda Para Editar un Proyecto
      if ( in_array( $pagenow, array( 'post.php' ))&& $screen->id=='otros'  )
      {
         $contextual_help =
          '<p><strong>Agregar Nuevo: </strong> publicar un nuevo proyecto.</p>' .
          '<p><strong>Estado: </strong> cambiar el estado de la publicacion del proyecto.</p>' .
          '<p><strong>Publicada el: </strong> programar publicacion en la fecha y hora seleccionada.</p>' .
          '<p><strong>Actualizar: </strong> guardar los cambios realizados al proyecto.</p>' .
          '<p><strong>Asigmar imagen destacada: </strong> permite asignar una imagen para el proyecto (opcional).</p>' .
           '<p><strong>Contenido: </strong>Debe ingresar la direccion url a la que sera redireccionado el visitante y que contiene la informacion del proyecto.</p>' 
           ;
      
            
      }elseif (in_array( $pagenow, array( 'post-new.php' ))&& $screen->id=='otros') {
          //Ayuda Para Nuevo Proyecto.
          $contextual_help =
           '<p><strong>Guardar Borrador: </strong>guardar el proyecto como borrador sin publicarlo.</p>'.
           '<p><strong>Estado: </strong>cambiar el estado de la publicacion del proyecto.</p>'.
           '<p><strong>Publicar inmediatamente: </strong> programar publicacion automatica en la fecha y hora seleccionada.</p>'.
           '<p><strong>Publicar: </strong> Opcion de publicar un proyecto.</p>'.
           '<p><strong>Asigmar imagen destacada: </strong> permite asignar una imagen para el proyecto (opcional).</p>'.
           '<p><strong>Contenido: </strong>Debe ingredar la direccion url a la que sera redireccionado el visitante y que contiene la informacion del proyecto.</p>'
           ;        
      }
      return $contextual_help;
    break;
    case 'edit-otros':
      if ( in_array( $pagenow, array( 'edit.php' ) ) && $screen->id=='edit-otros')
        {
          //Ayuda Para Lista Proyecto.
        $contextual_help =
          '<p><strong>Agregar Nuevo: </strong> Agregar un nuevo proyecto.</p>' .
          '<p><strong>Todos: </strong> listar todos los proyectos.</p>' .
          '<p><strong>Mios: </strong> listar todos los proyectos del usuario logueado.</p>' .
          '<p><strong>Publicadas: </strong> listar todos los proyectos publicados.</p>' .
          '<p><strong>Borradores: </strong> listar todos los proyectos guardados como borrador.</p>' .
          '<p><strong>Papelera: </strong> listar todos los proyectos en la Papelera.</p>' .
          '<p><strong>Cancelados: </strong> listar todos los proyectos cancelados.</p>' .
          '<p><strong>Buscar Proyectos: </strong> listar todos los proyectos cancelados.</p>' .
          '<p><strong>Acciones en lote: </strong> permite realizar acciones para todos los proyectos seleccionados.</p>' .
          '<p><strong>Ver: </strong> Vista previa del contenido del proyecto publicado.</p>' .
          '<p><strong>Vista previa: </strong> Vista previa del contenido del proyecto.</p>' .
          '<p><strong>Restaurar: </strong> restaurar un proyecto a su estado anterior</p>' .
           '<p><strong>Borrar permanentemente: </strong>Borrar un proyecto sin posibilidad de restaurarlo.</p>' 
           ;
      }
      return $contextual_help;
    break;
case 'dashboard':
      if ( in_array( $pagenow, array( 'index.php' ) ) && $screen->id=='dashboard')
        {
          //Ayuda Para Lista Proyecto.
         $screen->remove_help_tabs();
          $contextual_help = "";
       $contextual_help =
           '<p><strong>Escritorio: </strong>guardar el proyecto como borrador sin publicarlo.</p>'.
           '<p><strong>Proyectos: </strong>cambiar el estado de la publicacion del proyecto.</p>'.
           '<p><strong>Eventos Coyunturales: </strong> programar publicacion automatica en la fecha y hora seleccionada.</p>'.
           '<p><strong>Streaming: </strong> Opcion de publicar un proyecto.</p>'.
           '<p><strong>Otros Proyectos: </strong> permite asignar una imagen para el proyecto (opcional).</p>'.
           '<p><strong>Parametros de Conexion: </strong>Debe ingredar la direccion url a la que sera redireccionado el visitante y que contiene la informacion del proyecto.</p>'.
           '<p><strong>Reporte SIGOES: </strong>guardar el proyecto como borrador sin publicarlo.</p>'.
           '<p><strong>Asignar Rol-Usuarios: </strong>cambiar el estado de la publicacion del proyecto.</p>'.
           '<p><strong>Bitacora: </strong> programar publicacion automatica en la fecha y hora seleccionada.</p>'.
           '<p><strong>Apariencia: </strong> Opcion de publicar un proyecto.</p>'.
           '<p><strong>Plugins: </strong> permite asignar una imagen para el proyecto (opcional).</p>'.
           '<p><strong>Usuarios: </strong>Debe ingredar la direccion url a la que sera redireccionado el visitante y que contiene la informacion del proyecto.</p>'.
           '<p><strong>Publicar: </strong> Opcion de publicar un proyecto.</p>'.
           '<p><strong>Ajustes: </strong> permite asignar una imagen para el proyecto (opcional).</p>'
           ;   
      }
      return $contextual_help;
    break;
case 'toplevel_page_Instituciones':
      if ( in_array( $pagenow, array( 'admin.php' ) ) && $screen->id=='toplevel_page_Instituciones')
        {
          //Ayuda Para Lista Proyecto.
         $screen->remove_help_tabs();
          $contextual_help = "";
        $contextual_help =
           '<p><strong>Exportar: </strong>Agregar una nueva institucion.</p>'.
           '<p><strong>Estado: </strong>exportar PDF o Excel.</p>'.
           '<p><strong>Categoria: </strong> programar publicacion automatica en la fecha y hora seleccionada.</p>'.
           '<p><strong>Rol: </strong> Opcion de publicar un proyecto.</p>'.
           '<p><strong>Fecha Inicio: </strong> permite asignar una imagen para el proyecto (opcional).</p>'.
           '<p><strong>Fecha Fin: </strong>Debe ingredar la direccion url a la que sera redireccionado el visitante y que contiene la informacion del proyecto.</p>'.
           '<p><strong>Filtrar po fecha: </strong> permite asignar una imagen para el proyecto (opcional).</p>'.
           '<p><strong>Restablecer: </strong> permite asignar una imagen para el proyecto (opcional).</p>'.
           '<p><strong>Buscar por Titulo: </strong> permite asignar una imagen para el proyecto (opcional).</p>'
           ;   
      }
      return $contextual_help;
    break;   
case 'toplevel_page_Reporte_SIGOES':
      if ( in_array( $pagenow, array( 'admin.php' ) ) && $screen->id=='toplevel_page_Reporte_SIGOES')
        {
          //Ayuda Para Lista Proyecto.
         $screen->remove_help_tabs();
          $contextual_help = "";
        $contextual_help =
           '<p><strong>Guardar Borrador: </strong>guardar el proyecto como borrador sin publicarlo.</p>'.
           '<p><strong>Estado: </strong>cambiar el estado de la publicacion del proyecto.</p>'.
           '<p><strong>Publicar inmediatamente: </strong> programar publicacion automatica en la fecha y hora seleccionada.</p>'.
           '<p><strong>Publicar: </strong> Opcion de publicar un proyecto.</p>'.
           '<p><strong>Asigmar imagen destacada: </strong> permite asignar una imagen para el proyecto (opcional).</p>'.
           '<p><strong>Contenido: </strong>Debe ingredar la direccion url a la que sera redireccionado el visitante y que contiene la informacion del proyecto.</p>'
           ;   
      }
      return $contextual_help;
    break;
case 'toplevel_page_aam':
      if ( in_array( $pagenow, array( 'admin.php' ) ) && $screen->id=='toplevel_page_aam')
        {
          //Ayuda Para Lista Proyecto.
        // $screen->remove_help_tabs();
          $contextual_help = "";
        $contextual_help =
           '<p><strong>Guardar Borrador: </strong>guardar el proyecto como borrador sin publicarlo.</p>'.
           '<p><strong>Estado: </strong>cambiar el estado de la publicacion del proyecto.</p>'.
           '<p><strong>Publicar inmediatamente: </strong> programar publicacion automatica en la fecha y hora seleccionada.</p>'.
           '<p><strong>Publicar: </strong> Opcion de publicar un proyecto.</p>'.
           '<p><strong>Asigmar imagen destacada: </strong> permite asignar una imagen para el proyecto (opcional).</p>'.
           '<p><strong>Contenido: </strong>Debe ingredar la direccion url a la que sera redireccionado el visitante y que contiene la informacion del proyecto.</p>'
           ;   
      }
      return $contextual_help;
    break; 
case 'toplevel_page_wp_stream':
      if ( in_array( $pagenow, array( 'admin.php' ) ) && $screen->id=='toplevel_page_wp_stream')
        {
          //Ayuda Para Lista Proyecto.
         $screen->remove_help_tabs();
          $contextual_help = "";
        $contextual_help =
           '<p><strong>Guardar Borrador: </strong>guardar el proyecto como borrador sin publicarlo.</p>'.
           '<p><strong>Estado: </strong>cambiar el estado de la publicacion del proyecto.</p>'.
           '<p><strong>Publicar inmediatamente: </strong> programar publicacion automatica en la fecha y hora seleccionada.</p>'.
           '<p><strong>Publicar: </strong> Opcion de publicar un proyecto.</p>'.
           '<p><strong>Asigmar imagen destacada: </strong> permite asignar una imagen para el proyecto (opcional).</p>'.
           '<p><strong>Contenido: </strong>Debe ingredar la direccion url a la que sera redireccionado el visitante y que contiene la informacion del proyecto.</p>'
           ;   

      }
      return $contextual_help;
    break;                       
///////////////////////////////////////////////////////////////////////////////////

    default:
    # code...
    break;
  }
  //Ayuda Para Editar un Evento
  /*if ( in_array( $pagenow, array( 'post.php' ) ) )
    {
    $contextual_help =
      '<p>' . __('Editar Evento.', 'your_text_domain') . '</p>' ;
    }
  elseif ( 'evento' == $screen->id ) {
    $contextual_help =
      '<p>' . __('Things to remember when adding or editing a book:', 'your_text_domain') . '</p>' .
      '<ul>' .
      '<li>' . __('Specify the correct genre such as Mystery, or Historic.', 'your_text_domain') . '</li>' .
      '<li>' . __('Specify the correct writer of the book.  Remember that the Author module refers to you, the author of this book review.', 'your_text_domain') . '</li>' .
      '</ul>' .
      '<p>' . __('If you want to schedule the book review to be published in the future:', 'your_text_domain') . '</p>' .
      '<ul>' .
      '<li>' . __('Under the Publish module, click on the Edit link next to Publish.', 'your_text_domain') . '</li>' .
      '<li>' . __('Change the date to the date to actual publish this article, then click on Ok.', 'your_text_domain') . '</li>' .
      '</ul>' .
      '<p><strong>' . __('For more information:', 'your_text_domain') . '</strong></p>' .
      '<p>' . __('<a href="http://codex.wordpress.org/Posts_Edit_SubPanel" target="_blank">Edit Posts Documentation</a>', 'your_text_domain') . '</p>' .
      '<p>' . __('<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>', 'your_text_domain') . '</p>' ;
  } elseif ( 'edit-evento' == $screen->id ) {
    $contextual_help =
      '<p>' . __('This is the help screen displaying the table of books blah blah blah.', 'your_text_domain') . '</p>' ;
  }
 return $contextual_help;*/
}//fin ProyectoAyuda
add_action('contextual_help','ProyectoAyuda', 10, 3 );

}//Fin RenderAyudaComunicado
}// Fin class ComunicadoVista 
?>