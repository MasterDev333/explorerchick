<?php
global $post;
$modules = get_field( 'modules' );
if ( have_rows( 'modules' ) ) :
	while ( have_rows( 'modules' ) ) :
		the_row();
		?>
		<?php
		if ( 'hero' == get_row_layout() ) :
			$image = get_sub_field( 'image' );
			$video = get_sub_field( 'video' );
			$type  = get_sub_field( 'type' );
			if ( 'default' == $type ) :
				$heading_tag = 'h3';
			else :
				$heading_tag = 'h1';
			endif;
			$slider = get_sub_field( 'slider' );
			?>
			<!-- Hero Type: [<?php echo esc_html( $type ); ?>] -->
			<section class="banner banner--<?php echo esc_attr( $type ); ?>">
				<?php if ( 'slider' == $type ) : ?>
					<?php if ( $slider ) : ?>
					<div class="swiper">
						<div class="swiper-wrapper">
							<?php foreach ( $slider as $slide ) : ?>
							<div class="swiper-slide">
								<img class="img-cover" src="<?php echo esc_url( $slide['url'] ); ?>" alt="<?php echo esc_attr( $slide['alt'] ); ?>">
							</div>
							<?php endforeach; ?>
						</div>
						<?php if ( count( $slider ) > 1 ) : ?>
							<div class="swiper-button-prev"></div>
							<div class="swiper-button-next"></div>
						<?php endif; ?>
					</div>
					<?php endif; ?>
				<?php else : ?>
					<?php
					get_template_part(
						'template-parts/content-modules',
						'media',
						array(
							'video' => $video,
							'image' => $image,
							'class' => 'banner-bg img-cover',
						)
					);
					?>
					<div class="banner-content">
						<div class="container-sm">
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'heading',
									't'  => $heading_tag,
									'tc' => 'banner-heading a-up',
								)
							);
							?>
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'sub_heading',
									't'  => 'h6',
									'tc' => 'banner-subheading a-up a-delay-1',
								)
							);
							?>
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'content',
									't'  => 'div',
									'tc' => 'banner-copy a-up a-delay-1',
								)
							);
							?>
							<?php
							get_template_part_args(
								'template-parts/content-modules-cta',
								array(
									'v' => 'cta',
									'c' => 'btn btn-yellow a-up a-delay-2',
								)
							);
							?>
						</div>
					</div>
				<?php endif; ?>
			</section>
		<?php elseif ( 'search_form' == get_row_layout() ) : ?>
			<!-- Search -->
			<section class="search">
				<div class="container-sm">
					<div class="search-form">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'heading',
								't'  => 'h6',
								'tc' => 'search-form__title a-up',
							)
						);
						?>
						<form action="#" class="search-form__form a-up a-delay-1">
							<div class="form-fields">
								<div class="form-field">
									<label for="departing">Departing</label>
									<input type="date" id="departing" class="form-control" name="departing">
								</div>
								<div class="form-field">
									<label for="returning">Returning</label>
									<input type="date" id="returning" class="form-control" name="returning">
								</div>
								<div class="form-field">
									<label for="destinations">Destinations</label>
									<select name="destinations" id="destinations" class="form-control" multiple="multiple">
										<option value="Destination 1">Destination 1</option>
										<option value="Destination 2">Destination 2</option>
										<option value="Destination 3">Destination 3</option>
									</select>
								</div>
								<div class="form-field">
									<label for="activities">Activities</label>
									<select name="activities" id="activities" class="form-control" multiple="multiple">
										<option value="Activity 1">Activity 1</option>
										<option value="Activity 2">Activity 2</option>
										<option value="Activity 3">Activity 3</option>
									</select>
								</div>
							</div>
							<button type="submit" class="btn btn-yellow search-form__submit">Search Trips</button>
						</form>
					</div>
				</div>
			</section>
			<?php
		elseif ( 'content_image' == get_row_layout() ) :
			$direction = get_sub_field( 'direction' );
			?>
			<!-- Content Image: [<?php echo esc_html( $direction ); ?>] -->
			<section class="content-image content-image--top">
				<div class="container">
					<div class="content-image__content">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'sub_heading',
								't'  => 'h6',
								'tc' => 'section-subheading a-up',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'heading',
								't'  => 'h3',
								'tc' => 'h3-alt section-heading a-up a-delay-1',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'content',
								't'  => 'div',
								'tc' => 'section-copy a-up a-delay-2',
							)
						);
						?>
					</div>
					<?php
					get_template_part_args(
						'template-parts/content-modules-image',
						array(
							'v'   => 'image',
							'v2x' => false,
							'is'  => false,
							'c'   => 'a-up',
							'w'   => 'div',
							'wc'  => 'content-image__image',
						)
					);
					?>
				</div>
			</section>
			<?php
		elseif ( 'content_slider' == get_row_layout() ) :
			$image = get_sub_field( 'image' );
			?>
			<!-- Content Slider -->
			<section class="content-slider">
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
					<?php if ( have_rows( 'slider' ) ) : ?>
					<div class="swiper a-up a-delay-1">
						<div class="swiper-wrapper">
							<?php
							while ( have_rows( 'slider' ) ) :
								the_row();
								$image = get_sub_field( 'image' );
								$cta   = get_sub_field( 'cta' );
								?>
								<div class="swiper-slide">
									<div class="content-slide">
										<?php if ( $cta ) : ?>
											<a href="<?php echo esc_url( $cta['url'] ); ?>" class="content-slide__img" target="<?php echo $cta['target'] ? $cta['target'] : '_self'; ?>">
										<?php else : ?>
											<div class="content-slide__img">
										<?php endif; ?>
											<?php
											get_template_part_args(
												'template-parts/content-modules-image',
												array(
													'v'   => 'image',
													'v2x' => false,
													'is'  => false,
													'c'   => 'img-cover',
												)
											);
											?>
										<?php if ( $cta ) : ?>
											</a>
										<?php else : ?>
											</div>
										<?php endif; ?>
										<?php
										get_template_part_args(
											'template-parts/content-modules-text',
											array(
												'v'  => 'content',
												't'  => 'div',
												'tc' => 'content-slide__content',
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
								</div>
							<?php endwhile; ?>
						</div>
						<?php if ( count( get_sub_field( 'slider' ) ) > 1 ) : ?>
						<div class="swiper-button-prev"></div>
						<div class="swiper-button-next"></div>
						<?php endif; ?>
					</div>
					<?php endif; ?>
				</div>
			</section>
			<?php
		elseif ( 'cpt_slider' == get_row_layout() ) :
			?>
			<!-- CPT Slider -->
			<section class="cpt-slider">
				<div class="container">
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'heading',
							't'  => 'h3',
							'tc' => 'section-heading a-up',
						)
					);
					?>
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'content',
							't'  => 'div',
							'tc' => 'section-copy a-up a-delay-1',
						)
					);
					?>
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
					<?php
					get_template_part_args(
						'template-parts/content-modules-cta',
						array(
							'v'  => 'cta',
							'c'  => 'btn btn-pink a-up a-delay-3',
							'w'  => 'div',
							'wc' => 'cpt-slider__cta',
						)
					);
					?>
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
							<?php if ( count( $posts ) > 1 ) : ?>
							<div class="swiper-button-next"></div>
							<?php endif; ?>
						</div>
					</div>
				</section>
				<?php
			endif;
			wp_reset_postdata();
			?>
		<?php elseif ( 'reasons' == get_row_layout() ) : ?>
			<?php if ( have_rows( 'reason' ) ) : ?>
			<section class="reasons">
				<div class="container">
					<?php
					while ( have_rows( 'reason' ) ) :
						the_row();
						$heading = get_sub_field( 'heading' );
						?>
						<div class="reason a-up" id="step<?php echo esc_attr( get_row_index() ); ?>">
							<?php
							get_template_part_args(
								'template-parts/content-modules-image',
								array(
									'v'   => 'image',
									'is'  => false,
									'v2x' => false,
									'w'   => 'div',
									'wc'  => 'reason-img',
								)
							);
							?>
							<div class="reason-content">
								<?php if ( $heading ) : ?>
								<h3 class="reason-heading">
									<span class="reason-number"><?php echo esc_html( get_row_index() ); ?></span>
									<?php echo esc_html( $heading ); ?>
								</h3>
								<?php endif; ?>
								<?php
								get_template_part_args(
									'template-parts/content-modules-text',
									array(
										'v'  => 'content',
										't'  => 'div',
										'tc' => 'reason-desc',
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
						</div>
					<?php endwhile; ?>
				</div>
			</section>
			<?php endif; ?>
			<?php
		elseif ( 'video' == get_row_layout() ) :
			$video = get_sub_field( 'video' );
			?>
			<section class="featured-video">
				<div class="container-sm">
					<div class="featured-video__inner a-up">
						<?php if ( $video ) : ?>
						<video class="img-cover" controls preload="metadata" src="<?php echo esc_url( $video ); ?>" poster="">
							<source src="<?php echo esc_url( $video ); ?>" type="video/mp4">
						</video>
						<?php endif; ?>
						<div class="featured-video__info">
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'heading',
									't'  => 'p',
									'tc' => 'featured-video__title',
								)
							);
							?>
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'content',
									't'  => 'p',
									'tc' => 'featured-video__desc',
								)
							);
							?>
						</div>
					</div>
				</div>
			</section>
		<?php elseif ( 'why_choose' == get_row_layout() ) : ?>
			<section class="why-choose">
				<div class="container-sm">
					<div class="card-box a-up">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'reason_heading',
								't'  => 'h1',
								'tc' => 'card-box__heading',
								'w'  => 'div',
								'wc' => 'card-box__header',
							)
						);
						?>
						<?php
						foreach ( $modules as $module ) :
							if ( 'reasons' == $module['acf_fc_layout'] ) :
								?>
							<div class="card-box__content">
								<div class="steps">
									<label for=""><?php echo esc_html__( 'Reasons' ); ?></label>
									<ul>
										<?php foreach ( $module['reason'] as $key => $reason ) : ?>
										<li><a href="#step<?php echo esc_attr( $key + 1 ); ?>"<?php echo $key == 0 ? ' class="active"' : ''; ?>><?php echo esc_html( $key + 1 ); ?></a></li>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>
								<?php
							endif;
						endforeach;
						?>
					</div>
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'heading',
							't'  => 'h2',
							'tc' => 'section-heading a-up a-delay-1',
						)
					);
					?>
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'content',
							't'  => 'div',
							'tc' => 'section-content a-up a-delay-2',
						)
					);
					?>
				</div>
			</section>
		<?php elseif ( 'google_review' == get_row_layout() ) : ?>
			<section class="reviews">
				<div class="container">
					<div class="section-top a-up">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'google_review_heading',
								't'  => 'h2',
								'tc' => 'section-heading',
								'o'  => 'o',
							)
						);
						?>
						<div class="section-decor">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/stars.png' ); ?>" alt="">
						</div>
					</div>
					<div class="reviews">
					</div>
				</div>
			</section>
		<?php elseif ( 'form' == get_row_layout() ) : ?>
			<section class="subscribe" id="subscribe">
				<div class="container">
					<div class="subscribe-inner">
						<?php
						get_template_part_args(
							'template-parts/content-modules-image',
							array(
								'v'   => 'image',
								'v2x' => false,
								'is'  => false,
								'c'   => 'img-cover',
								'w'   => 'div',
								'wc'  => 'subscribe-image a-right',
							)
						);
						?>
						<div class="subscribe-content a-left">
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'heading',
									't'  => 'h3',
									'tc' => 'subscribe-heading text-uppercase',
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
							<?php
							get_template_part_args(
								'template-parts/content-modules-shortcode',
								array(
									'v'  => 'code',
									't'  => 'div',
									'tc' => 'subscribe-form',
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
		<?php elseif ( 'social_media' == get_row_layout() ) : ?>
			<section class="social-feed">
				<div class="container">
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'social_media_heading',
							't'  => 'h2',
							'tc' => 'section-heading a-up',
							'o'  => 'o',
						)
					);
					?>
				</div>
			</section>
		<?php elseif ( 'as_seen_in' == get_row_layout() ) : ?>
			<section class="partners">
				<div class="container">
					<div class="section-top a-up">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'as_seen_in_heading',
								't'  => 'h2',
								'tc' => 'section-heading',
								'o'  => 'o',
							)
						);
						?>
						<div class="section-decor">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/megaphone.png' ); ?>" alt="">
						</div>
					</div>
					<?php if ( have_rows( 'as_seen_in_logos', 'options' ) ) : ?>
					<div class="partners-logos a-up a-delay-1">
						<?php
						while ( have_rows( 'as_seen_in_logos', 'options' ) ) :
							the_row();
							$url = get_sub_field( 'url' ) ? get_sub_field( 'url' ) : '#';
							?>
							<a href="<?php echo esc_url( $url ); ?>">
								<?php
								get_template_part_args(
									'template-parts/content-modules-image',
									array(
										'v'   => 'image',
										'v2x' => false,
										'is'  => false,
									)
								);
								?>
							</a>
						<?php endwhile; ?>
					</div>
					<?php endif; ?>
				</div>
			</section>
		<?php else : ?>
		<?php endif; ?>
		<?php
	endwhile;
endif;
