<div class="orbit" data-orbit data-use-m-u-i="true">
  <ul class="orbit-container">
    <?php $args = array(
      'posts_per_page' => 5,
      'tag' => 'slider'
    ); ?>
    <?php $i = 0; ?>
    <?php $slider = new WP_Query($args); while($slider->have_posts()): $slider->the_post(); ?>
      <li class="<?php echo $i == 0 ? 'is-active' : '' ?> orbit-slide">
        <a href="<?php the_permalink(); ?>">
          <?php the_post_thumbnail('slider'); ?>
          <div>
              <h3 class="orbit-caption text-center"><?php the_title(); ?></h3>
          </div>
        </a>
      </li>
  <?php $i++; endwhile; wp_reset_postdata();  ?>
  </ul>
  <nav class="orbit-bullets">
      <?php $entradas = $slider->post_count; ?>
      <?php for($i=0; $i<$entradas; $i++) { ?>
        <button class="<?php echo $i == 0 ? 'is-active' : '' ?>" data-slide="<?php echo $i; ?>"></button>
      <?php } ?>
  </nav>
</div>
