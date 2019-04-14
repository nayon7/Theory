

<?php get_header(); ?>


		<!-- Banner -->
      <section id="banner">
        <?php

      global $post;
      $args = array( 'posts_per_page' => 1, 'post_type'=> 'banner', 'orderby' => 'menu_order', 'order' => 'ASC' );
      $myposts = get_posts( $args );
      foreach( $myposts as $post ) : setup_postdata($post); ?>

				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>

        <?php endforeach; wp_reset_query(); ?>
			</section>

		<!-- One -->
			<section id="one" class="wrapper">
				<div class="inner">
					<div class="flex flex-3">
						<?php
						global $post;
						$args = array( 'posts_per_page' => 3, 'post_type'=> 'service', 'orderby' => 'menu_order', 'order' => 'ASC' );
						$myposts = get_posts( $args );
						foreach( $myposts as $post ) : setup_postdata($post); ?>
						<?php
							 $btn_text= get_post_meta($post->ID, 'btn_text', true);
							 $btn_link= get_post_meta($post->ID, 'btn_link', true);
						?>
								<article>
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

		<!-- Two -->
			<section id="two" class="wrapper style1 special">
				<div class="inner">
					<header>
						<h2>Ipsum Feugiat</h2>
						<p>Semper suscipit posuere apede</p>
					</header>
					<div class="flex flex-4">
						<?php
						global $post;
						$args = array( 'posts_per_page' =>4, 'post_type'=> 'testimonial', 'orderby' => 'menu_order', 'order' => 'ASC' );
						$myposts = get_posts( $args );
						foreach( $myposts as $post ) : setup_postdata($post); ?>

						<div class="box person">
							<div class="image round">
								<?php the_post_thumbnail('large','style=max-width:100%;height:auto;'); ?>
							</div>
							<h3><?php the_title(); ?></h3>
							<?php the_content(); ?>
						</div>
					  <?php endforeach; wp_reset_query(); ?>
					</div>
				</div>
			</section>

		<!-- Three -->
			<section id="three" class="wrapper special">
				<div class="inner">
					<header class="align-center">
						<h2>Nunc Dignissim</h2>
						<p>Aliquam erat volutpat nam dui </p>
					</header>
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
