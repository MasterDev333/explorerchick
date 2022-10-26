<?php global $post; ?>
<article <?php post_class( 'post' ); ?> id="post-<?php the_ID(); ?>">
	<?php
	$images = get_field( 'gallery' );
	if ( $images ) :
		?>
		<section class="banner banner--slider">
			<div class="swiper">
				<div class="swiper-wrapper">
					<?php foreach ( $images as $image ) : ?>
					<div class="swiper-slide">
						<img class="img-cover" src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>">
					</div>
					<?php endforeach; ?>
				</div>
				<div class="swiper-button-prev"></div>
				<div class="swiper-button-next"></div>
			</div>
		</section>
	<?php endif; ?>
	<section class="trip-info">
		<div class="container-sm">
			<div class="card-box a-up">
				<div class="card-box__header">
					<?php
					breadcrumb_trail(
						array(
							'separator'  => '>',
							'show_home'  => false,
							'single_tax' => 'trip_category',
						)
					);
					?>
					<h1 class="card-box__heading"><?php echo esc_html( get_the_title() ); ?></h1>
					<?php
					get_template_part_args(
						'template-parts/content-modules-cta',
						array(
							'v'  => 'book_cta',
							'c'  => 'btn-book-now',
							'o'  => 'f',
							'w'  => 'div',
							'wc' => 'text-center',
						)
					);
					?>
				</div>
				<div class="card-box__content">
					<h6>AT A GLANCE</h6>
					<div class="trip-info__items">
						<div class="trip-info__item">
							<span><i class="fa-solid fa-map-location-dot"></i>
								Uganda</span>
						</div>
						<div class="trip-info__item">
							<span><i class="fa-solid fa-user-group"></i>
								11 Explorers</span>
						</div>
						<div class="trip-info__item trip-info__item--full">
							<span><i class="fa-solid fa-bed"></i>
								Luxury Safari Lodges, Guest Houses</span>
						</div>
						<div class="trip-info__item trip-info__item--full">
							<span><i class="fa-solid fa-boot"></i>
								Gorilla and Chimp Trekking, Safari, Hiking. National Parks, Cultural</span>
						</div>
						<div class="trip-info__item">
							<span><i class="fa-solid fa-clock"></i>
								10 Days</span>
						</div>
						<div class="trip-info__item">
							<span><i class="fa-solid fa-mountain-sun"></i>
								Moderate</span>
							<div class="tooltip">
								<i class="fa-solid fa-circle-info"></i>
								<div class="tooltip-content">
									Lorem, ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit et quaerat incidunt fuga praesentium. Repudiandae voluptate iusto temporibus fugiat repellat dolore maxime ducimus voluptates dolorem, laborum consequuntur laudantium sed delectus?
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php get_template_part( 'template-parts/sidebar', 'content' ); ?>
	<?php
	if ( have_rows( 'content_modules' ) ) :
		while ( have_rows( 'content_modules' ) ) :
			the_row();
			?>
			<?php if ( 'reserve' == get_row_layout() ) : ?>
				<section class="reserve-cta">
					<div class="container">
						<div class="reserve-cta__inner">
							<div class="reserve-cta__left">
								<?php
								get_template_part_args(
									'template-parts/content-modules-text',
									array(
										'v'  => 'heading',
										't'  => 'h3',
										'tc' => 'h3-alt',
									)
								);
								?>
								<?php
								get_template_part_args(
									'template-parts/content-modules-text',
									array(
										'v' => 'sub_heading',
										't' => 'p',
									)
								);
								?>
								<?php
								get_template_part_args(
									'template-parts/content-modules-text',
									array(
										'v'  => 'price',
										't'  => 'h2',
										'tc' => 'price',
									)
								);
								?>
								<?php
								get_template_part_args(
									'template-parts/content-modules-cta',
									array(
										'v' => 'cta',
										'c' => 'btn btn-yellow',
									)
								);
								?>
							</div>
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'content',
									't'  => 'div',
									'tc' => 'reserve-cta__right',
								)
							);
							?>
						</div>
					</div>
				</section>
				<?php
			elseif ( 'three_columns_content' == get_row_layout() ) :
				$image = get_sub_field( 'image' );
				?>
				<section class="book-confidence">
					<div class="container">
						<div class="section-top a-up">
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'heading',
									't'  => 'h2',
									'tc' => 'section-heading',
								)
							);
							?>
							<?php if ( $image ) : ?>
							<div class="section-decor" style="background-image: url(<?php echo esc_url( $image ); ?>);"></div>
							<?php endif; ?>
						</div>
						<?php if ( have_rows( 'columns' ) ) : ?>
						<div class="row">
							<?php
							while ( have_rows( 'columns' ) ) :
								the_row();
								?>
							<div class="col a-up a-delay-<?php echo esc_attr( get_row_index() ); ?>">
								<?php
								get_template_part_args(
									'template-parts/content-modules-text',
									array(
										'v'  => 'content',
										't'  => 'div',
										'tc' => 'col-content',
									)
								);
								?>
								<?php
								get_template_part_args(
									'template-parts/content-modules-cta',
									array(
										'v' => 'cta',
										'c' => 'btn btn-pink',
									)
								);
								?>
							</div>
							<?php endwhile; ?>
						</div>
						<?php endif; ?>
					</div>
				</section>
				<?php
			elseif ( 'featured_blog' == get_row_layout() ) :
				$posts = get_sub_field( 'posts' );
				if ( $posts ) :
					?>
				<section class="featured-blog a-up">
					<div class="container">
						<div class="swiper featured-blog__slider">
							<div class="swiper-wrapper">
								<?php
								foreach ( $posts as $post ) :
									setup_postdata( $post );
									?>
									<div class="swiper-slide">
										<?php get_template_part( 'template-parts/featured', 'post' ); ?>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</section>
					<?php
				endif;
				wp_reset_postdata();
				?>
			<?php elseif ( 'cpt_slider' == get_row_layout() ) : ?>
				<section class="cpt-slider">
					<div class="container">
						<div class="section-top a-up">
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'heading',
									't'  => 'h2',
									'tc' => 'section-heading',
								)
							);
							?>
							<div class="section-decor" style="background-image: url(<?php echo get_template_directory_uri() . '/assets/img/map.png'; ?>);"></div>
						</div>
						<?php
						$posts = get_sub_field( 'posts' );
						if ( $posts ) :
							?>
						<div class="swiper a-up a-delay-2">
							<div class="swiper-wrapper">
								<?php
								foreach ( $posts as $post ) :
									setup_postdata( $post );
									get_template_part( 'template-parts/loop', get_post_type() );
								endforeach;
								?>
							</div>
							<?php if ( count( $posts ) > 1 ) : ?>
							<div class="swiper-button-prev"></div>
							<div class="swiper-button-next"></div>
							<?php endif; ?>
						</div>
							<?php
						endif;
						wp_reset_postdata();
						?>
					</div>
				</section>
			<?php elseif ( 'subscribe' == get_row_layout() ) : ?>
				<section class="subscribe" id="trip-packet" style="display: none;">
					<div class="subscribe-inner">
						<?php
						get_template_part_args(
							'template-parts/content-modules-image',
							array(
								'v'   => 'image',
								'is'  => false,
								'v2x' => false,
								'c'   => 'img-cover',
								'w'   => 'div',
								'wc'  => 'subscribe-image'
							)
						);
						?>
						<div class="subscribe-content">
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'heading',
									't'  => 'h3',
									'tc' => 'h3-alt subscribe-heading text-uppercase',
								)
							);
							?>
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v' => 'content',
									't' => 'p',
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
										<button type="submit" class="btn btn-yellow">Download Packet</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</section>
			<?php endif; ?>
			<?php
	endwhile;
	endif;
	?>
</article><!-- /post -->
