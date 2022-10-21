<article <?php post_class( 'post' ); ?> id="post-<?php the_ID(); ?>">
	<section class="single-post__info">
		<div class="container-sm">
			<div class="card-box card-box--static a-up">
				<div class="card-box__header">
					<?php
					breadcrumb_trail(
						array(
							'separator' => '>',
						)
					);
					?>
					<h1 class="card-box__heading"><?php echo esc_html( get_the_title() ); ?></h1>
				</div>
			</div>
		</div>
	</section>
	<?php get_template_part( 'template-parts/sidebar', 'content' ); ?>
	<section class="cpt-slider cpt-slider--post">
		<div class="container">
			<div class="section-top a-up">
				<h2 class="section-heading"><?php echo esc_html__( 'Related Articles' ); ?></h2>
				<div class="section-decor" style="background-image: url(<?php echo esc_url( get_template_directory_uri() . '/assets/img/book.png' ); ?>);"></div>
			</div>
			<?php
			$args  = array(
				'post_type'      => get_post_type(),
				'category__in'   => wp_get_post_categories( get_the_ID() ),
				'post__not_in'   => array( get_the_ID() ),
				'posts_per_page' => 3,
				'orderby'        => 'date',
			);
			$query = new WP_Query( $args );
			if ( $query->have_posts() ) :
				?>
			<div class="swiper a-up a-delay-2">
				<div class="swiper-wrapper">
					<?php
					while ( $query->have_posts() ) :
						$query->the_post();
						get_template_part( 'template-parts/loop', get_post_type() );
					endwhile;
					?>
				</div>
				<div class="swiper-button-prev"></div>
				<div class="swiper-button-next"></div>
			</div>
				<?php
			endif;
			wp_reset_postdata();
			?>
		</div>
	</section>
	<section class="subscribe" id="subscribe">
		<div class="container">
			<div class="subscribe-inner">
				<?php
				get_template_part_args(
					'template-parts/content-modules-image',
					array(
						'v'   => 'guide_form_image',
						'v2x' => false,
						'is'  => false,
						'c'   => 'img-cover',
						'w'   => 'div',
						'wc'  => 'subscribe-image a-right',
						'o'   => 'o',
					)
				);
				?>
				<div class="subscribe-content a-left">
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'guide_form_heading',
							't'  => 'h3',
							'tc' => 'subscribe-heading text-uppercase',
							'o'  => 'o',
						)
					);
					?>
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v' => 'guide_form_content',
							't' => 'div',
							'o' => 'o',
						)
					);
					?>
					<form action="#" class="subscribe-form">
						<div class="form-row">
							<div class="form-col full-width">
								<input type="email" class="form-control" id="subscribe-email"
									placeholder="Email Address">
							</div>
							<div class="form-col">
								<input type="text" class="form-control" id="subscribe-first-name"
									placeholder="First Name">
							</div>
							<div class="form-col">
								<input type="text" class="form-control" id="subscribe-last-name"
									placeholder="Last Name">
							</div>
							<div class="form-col">
								<button type="submit" class="btn btn-yellow">Let's Do This</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</article><!-- /post -->
