			<!DOCTYPE HTML>
			<!--
				Theory by TEMPLATED
				templated.co @templatedco
				Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
			-->
			<html>
				<head>
					<title><?php bloginfo('name'); ?></title>
					<meta charset="utf-8" />
					<meta name="viewport" content="width=device-width, initial-scale=1" />
					<?php wp_head(); ?>
				</head>
				<body <?php body_class(); ?>>

					<!-- Header -->
						<header id="header">
							<div class="inner">
								<a href="<?php the_permalink(); ?>" class="logo">Theory</a>
									<?php
									$theory_nav = wp_nav_menu(array(
											'theme_location'  => 'primary',
											'menu_id'         =>  'nav',
									));
									echo $theory_nav;
								 ?>
								<a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
							</div>
						</header>
