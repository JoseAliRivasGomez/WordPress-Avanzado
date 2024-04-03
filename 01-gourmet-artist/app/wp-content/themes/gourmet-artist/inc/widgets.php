<?php

/**
 * Adds ultimosPost widget.
 */
class ultimosPost extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'ultimost_post', // Base ID
			__( 'Gourmet Artist Ultimos Post', 'text_domain' ), // Name
			array( 'description' => __( 'Muestra los ultimos post del blog', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}

    $query = array(
        'post_type' => 'post',
        'order' => 'DESC',
        'cat' => 4,
        'order_by' => 'date',
        'posts_per_page' => 5
    );

    echo '<ul class="no-bullet">';
    $blog = new WP_Query($query); while($blog->have_posts()): $blog->the_post();
    ?>
    <li class="row">
        <div class="small-6 medium-4 columns">
            <?php the_post_thumbnail('entrada'); ?>
        </div>

        <div class="small-6 medium-8  columns">
            <h3 class="ultimos-post">
              <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
              </a>
            </h3>
        </div>
    </li>



    <?php
    endwhile; wp_reset_postdata();
    echo '</ul>';

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'text_domain' );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

} // class ultimosPost


// register ultimosPost widget
function register_foo_widget() {
    register_widget( 'ultimosPost' );
}
add_action( 'widgets_init', 'register_foo_widget' );
