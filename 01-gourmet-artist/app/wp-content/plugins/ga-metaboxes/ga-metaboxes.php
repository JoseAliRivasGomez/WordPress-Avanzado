<?php
/*
Plugin Name: Gourmet Artist MetaBoxes
Plugin URI:
Description: Agrega MetaBoxes al sitio Gourmet Artist
Version: 1.0
Author: Juan Pablo De la torre Valdez
Author URI:
License: GLP2
Licence URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

function ga_agregar_metaboxes(){
  add_meta_box( 'ga-metaboxes', 'Nuestro Metabox', 'ga_diseno_metaboxes', 'recetas', 'normal', 'high', null );
}
add_action( 'add_meta_boxes', 'ga_agregar_metaboxes' );


function ga_guardar_metaboxes($post_id, $post, $update) {
  if(!isset($_POST['meta-box-nonce']) || !wp_verify_nonce( $_POST['meta-box-nonce'], basename(__FILE__) ))
  return $post_id;

  if(!current_user_can('edit_post', $post_id))
  return $post_id;

  if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
  return $post_id;

  $input_metabox = "";
  $textarea_metabox = "";
  $dropdown_metabox = "";

  if(isset($_POST['input-metabox'])) {
    $input_metabox = $_POST['input-metabox'];
  }
  update_post_meta($post_id, 'input-metabox', $input_metabox );

  if(isset($_POST['textarea-metabox'])) {
    $textarea_metabox = $_POST['textarea-metabox'];
  }
  update_post_meta($post_id, 'textarea-metabox', $textarea_metabox );

  if(isset($_POST['dropdown-metabox'])) {
    $dropdown_metabox = $_POST['dropdown-metabox'];
  }
  update_post_meta($post_id, 'dropdown-metabox', $dropdown_metabox );


}
add_action('save_post', 'ga_guardar_metaboxes', 10, 3);


function ga_diseno_metaboxes($post) {
  wp_nonce_field(basename(__FILE__), "meta-box-nonce");

  ?>

  <div>
      <label for="input-metabox">Calorias:</label>
      <input name="input-metabox" type="text" value="<?php echo get_post_meta($post->ID,'input-metabox', true ) ?>">
      <br/>

      <label for="textarea-metabox">Subtitulo de la Receta:</label>
      <textarea name="textarea-metabox">
        <?php echo get_post_meta($post->ID,'textarea-metabox', true ) ?>
      </textarea>
      <br/>

      <label for="dropdown-metabox">Calificación: </label>
      <select name="dropdown-metabox">
          <?php
              $opciones = array(1,2,3,4,5);
              foreach($opciones as $llave => $valor) { ?>
                <?php if($seleccionado = get_post_meta($post->ID,'dropdown-metabox', true )) { ?>
                  <option selected><?php echo $seleccionado; ?></option>
              <?php  } else { ?>
                  <option><?php echo $valor; ?></option>
                <?php } ?>

            <?php  }
          ?>
      </select>
  </div>
  <?php
}
