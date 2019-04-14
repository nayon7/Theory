<?php

/*

Template Name: Generic Template

*/


 ?>

<?php get_header(); ?>

<section id="three" class="wrapper">
  <div class="inner">
    <header class="align-center">
      <h2><?php the_title(); ?></h2>
      <p>Aliquam erat volutpat nam dui </p>
    </header>
    <?php the_content(); ?>
    <div class="flex flex-2">
      <?php
      global $post;
      $args = array( 'posts_per_page' => 2, 'post_type'=> 'postsection', 'orderby' => 'menu_order', 'order' => 'ASC' );
      $myposts = get_posts( $args );
      foreach( $myposts as $post ) : setup_postdata($post); ?>
      <?php
         $btn_text= get_post_meta($post->ID, 'btn_text', true);
         $btn_link= get_post_meta($post->ID, 'btn_link', true);
      ?>
      <article>
        <div class="image fit">
          <?php the_post_thumbnail('large','style=max-width:100%;height:auto;'); ?>
        </div>
        <header>
          <h3><?php the_title(); ?></h3>
        </header>
        <?php the_content(); ?>
        <footer>
          <a class="button special" href="<?php echo $btn_link; ?>"><?php echo $btn_text; ?></a>
        </footer>
      </article>
      <?php endforeach; wp_reset_query(); ?>
    </div>
  </div>
</section>



<?php get_footer(); ?>
