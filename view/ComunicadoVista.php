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
          '<p>' . __('Editar Proyecto: Elija las opciones que presenta el SIGOES.', 'your_text_domain') . '</p>' ;
      }elseif (in_array( $pagenow, array( 'post-new.php' ))&& $screen->id=='proyecto') {
          //Ayuda Para Nuevo Proyecto.
          $contextual_help =
          '<p>' . __('Nuevo Proyecto: Opcion de publicar un proyecto.', 'your_text_domain') . '</p>'.
          '<ul>' . __('Guardar Borrador: guarda el proyecto como borrador sin publicarlo.', 'your_text_domain') . '</ul>'.
          '<li>' . __('Guardar Borrador: guarda el proyecto como borrador sin publicarlo.', 'your_text_domain') . '</li>'
           ;        
      }
      return $contextual_help;
    break;
    case 'edit-proyecto':
      if ( in_array( $pagenow, array( 'edit.php' ) ) && $screen->id=='edit-proyecto')
        {
          //Ayuda Para Lista Proyecto.
        $contextual_help =
          '<p>' . __('Lista Proyecto: Consultar todos los tipos de proyectos.', 'your_text_domain') . '</p>' ;
      }
      return $contextual_help;
    break;
///////////////////////////////////////////////////////////////////////////////////
 case 'evento':
       //Ayuda Para Editar un Proyecto
      if ( in_array( $pagenow, array( 'post.php' ))&& $screen->id=='evento'  )
      {
        $contextual_help =
          '<p>' . __('Editar evento: Elija las opciones que presenta el SIGOES.', 'your_text_domain') . '</p>' ;
      }elseif (in_array( $pagenow, array( 'post-new.php' ))&& $screen->id=='evento') {
          //Ayuda Para Nuevo Proyecto.
          $contextual_help =
          '<p>' . __('Nuevo evento: Opcion de publicar un evento.', 'your_text_domain') . '</p>' ;        
      }
      return $contextual_help;
    break;
    case 'edit-evento':
      if ( in_array( $pagenow, array( 'edit.php' ) ) && $screen->id=='edit-evento')
        {
          //Ayuda Para Lista Proyecto.
        $contextual_help =
          '<p>' . __('Lista evento: Consultar todos los tipos de eventos.', 'your_text_domain') . '</p>' ;
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