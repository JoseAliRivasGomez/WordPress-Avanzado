<?php
/*
    Plugin Name: GA Enviar tu receta
    Plugin URI:
    Description: Añade funcionalidad de enviar post desde el front end
    Version: 1.0
    Author: Juan Pablo De la torre Valdez
    Author URI:
    License: GLP2
    Licence URI: https://www.gnu.org/licenses/gpl-2.0.html
*/


/** Formulario y campos para enviar receta **/
function ga_campos_formulario() {
    $cmb = new_cmb2_box(array(
        'id'           => 'ga_enviar_receta', 
        'object_types' => array('page'), 
        'hookup'       => false, // Si se va a guardar el post como borrador en la página principal
        'save_fields'  => false, // Sino va a guardar los campos durante el hookup
    ));
    $cmb->add_field(array(
        'name' => 'Datos Generales de la Receta',
        'type' => 'title',
        'id'   => 'titulo_receta_encabezado'
    ));
    $cmb->add_field( array(
        'name' => 'Nombre Receta',
        'id'   => 'titulo_receta',
        'type' => 'text'
    ));
    $cmb->add_field(array(
        'name' => 'Subtitulo',
        'id'   => 'subtitulo',
        'type' => 'text'  
     ));
     $cmb->add_field(array(
         'name' => 'Receta',
         'id'   => 'contenido_receta',
         'type' => 'wysiwyg',
         'options' => array(
            'textarea_rows' => 12,
            'media_buttons' => false 
         ),  
      ));
      $cmb->add_field(array(
          'name' => 'Calorias',
          'id'   => 'calorias',
          'type' => 'text'  
      ));
      
      $cmb->add_field(array(
          'name' => 'Imagen del Platillo',
          'id'   => 'imagen_destacada',
          'type' => 'text',
          'attributes' => array(
              'type' => 'file'
          ),
       ));
       $cmb->add_field(array(
           'name' => 'Información Extra',
           'id'   => 'otra_informacion',
           'type' => 'title',
       ));
       $cmb->add_field(array(
           'name' => 'Precio',
           'id'   => 'precio-receta',
           'type' => 'taxonomy_select',
           'taxonomy' => 'precio_receta'  
       ));
       $cmb->add_field(array(
           'name' => 'Tipo',
           'id'   => 'tipo-comida',
           'type' => 'taxonomy_select',
           'taxonomy' => 'tipo-comida',
       ));
       $cmb->add_field(array(
           'name' => 'Hora',
           'id'   => 'horario-menu',
           'type' => 'taxonomy_select',
           'taxonomy' => 'horario-menu',
       ));
       $cmb->add_field(array(
           'name' => 'Etiquetas',
           'id'   => 'etiquetas',
           'type' => 'text',
           'description' => 'Agrega las etiquetas separadas por coma',
           'taxonomy' => 'estado',
       ));
       $cmb->add_field(array(
           'name' => 'Tu Información',
           'id'   => 'informacion_autor',
           'type' => 'title'  
       ));
       
       $cmb->add_field(array(
           'name' => 'Tu Nombre',
           'desc' => 'Coloca tu nombre para atribuirte esta receta',
           'id'   => 'autor_receta',
           'type' => 'text'  
       ));
       $cmb->add_field(array(
           'name' => 'Tu Email',
           'desc' => 'Coloca tu email para contactarte en caso de ser necesario',
           'id'   => 'autor_email_receta',
           'type' => 'text_email'  
       ));
}
add_action('cmb2_init', 'ga_campos_formulario');

/** Obtiene la instancia del formulario **/
function ga_formulario_instancia() {
    // ID del metabox
    $metabox_id = 'ga_enviar_receta';
    
    // No aplica el object_id ya que se va a generar automaticamente al crearlo.
    $object_id = 'fake-object-id';
    
    return cmb2_get_metabox($metabox_id, $object_id);
}

/** Crear shortcode, utiliza [ga_enviar_receta_shortcode] */
function ga_formulario_enviar_receta_shortcode() {
    // Obtener el ID del formulario para imprimir el formulario  en el HTML
    $cmb = ga_formulario_instancia();
    
    $output = '';
    
    // Obtener algún error
    if ( ( $error = $cmb->prop( 'submission_error' ) ) && is_wp_error( $error ) ) {
		// If there was an error with the submission, add it to our ouput.
		$output .= '<h3>' . sprintf( __( 'Hubo un error: %s', 'ga_artist' ), '<strong>'. $error->get_error_message() .'</strong>' ) . '</h3>';
	}
    
    // si la receta se envia correctamente, notificar al usuario
    if ( isset( $_GET['post_submitted'] ) && ( $post = get_post( absint( $_GET['post_submitted'] ) ) ) ) {

		// Get submitter's name
		$nombre = get_post_meta( $post->ID, 'autor_receta', 1 );
		$nombre = $nombre ? ' '. $nombre : '';

		// Imprimir un aviso.
		$output .= '<h3>' . sprintf( __( 'Gracias%s, Tu receta ha sido agregada, una vez que pase la revisión será publicada', 'ga_artist' ), esc_html( $nombre ) ) . '</h3>';
	}
    
    // Imprimir el formulario
    $output .= cmb2_get_metabox_form( $cmb, 'fake-oject-id', array( 'save_button' => __( 'Enviar Receta', 'ga_artist' ) ) );
    
    return $output;
}
add_shortcode('ga_enviar_receta_shortcode', 'ga_formulario_enviar_receta_shortcode');

function ga_insertar_receta() {
    // En caso de que no se envie un formulario, no ejecutar nada
    if(empty($_POST) || !isset( $_POST['submit-cmb'], $_POST['object_id']) ) {
        return false;
    }
    
    // Obtener una instancia del formulario
    $cmb = ga_formulario_instancia();
    
    $post_data = array();
    
    // Revisar nonce de seguridad
    if( !isset($_POST[ $cmb->nonce()] ) || !wp_verify_nonce($_POST[ $cmb->nonce()], $cmb->nonce() ) ) {
        return $cmb->prop('submission_error', new WP_Error('security_fail', 'Fallo en la seguridad.') );
    }
    
    // Revisar que haya un titulo de receta
    
    if(empty($_POST['titulo_receta'])) {
        return $cmb->prop('submission_error', new WP_Error('post_data_missing', 'Se requiere un titulo para el post'));
    }
    
    /* Sanitizar datos */
    $valores_sanitizados = $cmb->get_sanitized_values($_POST);

    
    // Agregar titulo a $post_data
    $post_data['post_title'] = $valores_sanitizados['titulo_receta'];
    unset($valores_sanitizados['titulo_receta']);
    
    // Agregar Contenido a $post_data
    $post_data['post_content'] = $valores_sanitizados['contenido_receta'];
    unset($valores_sanitizados['contenido_receta']);
    
    $etiquetas = explode(',', $valores_sanitizados['etiquetas']);
    
    
    // Agregar Taxonomias al $post_data
    $post_data['tax_input'] = array(
            'precio_receta' => $valores_sanitizados['precio-receta'],
            'tipo-comida'   => $valores_sanitizados['tipo-comida'],
            'horario-menu'   => $valores_sanitizados['horario-menu'],
            'estado'        => $etiquetas
    );
    // Llenar los metaboxes
    $post_data['meta_input'] =  array(
            'input-metabox' => $valores_sanitizados['calorias'],
            'textarea-metabox' => $valores_sanitizados['subtitulo'],
    );
    
    
    // Post type donde se va a insertar
    $post_data['post_type'] = 'recetas';
    
    // Insertar el post en la BD
    $nuevo_post = wp_insert_post($post_data, true);
    
    if(is_wp_error($nuevo_post)) {
        return $cmb->prop('submission_error', $nuevo_post);
    }
    // Guardamos los campos de CMB
    $cmb->save_fields($nuevo_post, 'post', $valores_sanitizados);
    
    // Intenta agregar una imagen destacada
    $img_id = ga_enviar_imagen_destacada($nuevo_post, $post_data);
    
    // Si no hay errores sube la imagen
    if($img_id && !is_wp_error($img_id)) {
        set_post_thumbnail($nuevo_post, $img_id);
    }
    
    // Redireccionamos para prevenir que no haya duplicados
    wp_redirect(esc_url_raw(add_query_arg('post_submitted', $nuevo_post)));
    exit;
    
}
add_action('cmb2_after_init', 'ga_insertar_receta');


function ga_enviar_imagen_destacada($post_id, $attachment_post_data = array()) {
    if(
            empty($_FILES) 
            || !isset($_FILES['imagen_destacada'])
            || isset($_FILES['imagen_destacada']['error']) && 0 !== $_FILES['imagen_destacada']['error']
    ) {
        return;
    }
    
    // Filtrar los valores de la imagen destacada
    $archivo = array_filter($_FILES['imagen_destacada']);
    
    // Asegurarnos de que se subió un archivo
    if(empty($archivo) ) {
        return;
    }
    // Agregar el Uploaded de WordPress
    if(!function_exists('media_handle_upload')) {
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');
    }
    // Subir el archivo y añadirlo como imagen destacada
    return media_handle_upload('imagen_destacada', $post_id, $attachment_post_data);
}