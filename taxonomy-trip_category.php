<?php
/**
 * Trip Categories Template
 */
get_header();
global $post;
$term = get_queried_object();
?>
<?php
$gallery = get_field( 'banner', $term );
if ( $gallery ) :
	?>
<section class="banner banner--slider">
	<div class="swiper">
		<div class="swiper-wrapper">
			<?php foreach ( $gallery as $image ) : ?>
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
<section class="trip-grid">
	<div class="container-sm">
		<div class="card-box a-up">
			<div class="card-box__header">
				<?php
				breadcrumb_trail(
					array(
						'separator' => '>',
					)
				);
				?>
				<h1 class="card-box__heading"><?php echo esc_html( $term->name ); ?></h1>
			</div>
			<div class="card-box__content">
				<form action="" class="trip-categories">
					<label for="">Filter By</label>
					<div class="trip-category__wrapper">
						<i class="fa-solid fa-calendar-days"></i>
						<select name="month" id="month" class="jcf-select trip-category month">
							<option disabled selected>Month</option>
							<option value="Jan">January (1)</option>
							<option value="Feb">Feburary (5)</option>
							<option value="Mar">March (7)</option>
							<option value="Apr">April (9)</option>
							<option value="May">May (6)</option>
							<option value="Jun">June (8)</option>
							<option value="Jul">July (10)</option>
							<option value="Aug">August (10)</option>
							<option value="Sep">September (8)</option>
							<option value="Oct">October (10)</option>
							<option value="Nov">November (6)</option>
							<option value="Dec">December (3)</option>
						</select>
					</div>
					<div class="trip-category__wrapper">
						<i class="fa-solid fa-map-location-dot"></i>
						<select name="destination" id="destination" class="jcf-select trip-category destination">
							<option disabled selected>Destination</option>
							<option value="US">United States</option>
							<option value="RU">Russia</option>
							<option value="CN">China</option>
						</select>
					</div>
					<div class="trip-category__wrapper">
						<i class="fa-solid fa-boot"></i>
						<select name="activities" id="activities" class="jcf-select trip-category activities">
							<option disabled selected>Activities</option>
							<option value="backpacking">Backpacking</option>
							<option value="hiking">Hiking</option>
							<option value="safari">Safari</option>
						</select>
					</div>
					<div class="trip-category__wrapper">
						<i class="fa-solid fa-clock"></i>
						<select name="length" id="length" class="jcf-select trip-category length">
							<option disabled selected>Length</option>
							<option value="1">1 Days</option>
							<option value="2">2 Days</option>
							<option value="3">3 Days</option>
						</select>
					</div>
					<div class="trip-category__wrapper">
						<i class="fa-solid fa-mountain-sun"></i>
						<select name="difficulty" id="difficulty" class="jcf-select trip-category difficulty">
							<option disabled selected>Difficulty</option>
							<option value="beginner">Beginner</option>
							<option value="easy">Easy</option>
							<option value="normal">Normal</option>
							<option value="hard">Hard</option>
							<option value="chaos">Chaos</option>
						</select>
					</div>
					<div class="trip-category__wrapper">
						<i class="fa-solid fa-bed"></i>
						<select name="lodging" id="lodging" class="jcf-select trip-category lodging">
							<option disabled selected>Lodging</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
					</div>
					<div class="clear-wrapper">
						<button class="btn-clear-filters">Clear</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="container-sm">
		<div class="trip-grid__info">
			<?php
			$heading = get_field( 'grid_heading', $term );
			$content = get_field( 'grid_content', $term );
			if ( $heading ) :
				?>
				<h3 class="trip-grid__heading a-up a-delay-1"><?php echo esc_html( $heading ); ?></h3>
			<?php endif; ?>
			<?php if ( $content ) : ?>
			<div class="trip-grid__content a-up a-delay-2">
				<?php echo $content; ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
	<?php if ( have_posts() ) : ?>
	<div class="container">
		<div class="cpt-slides a-up a-delay-3">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/loop', 'trip' );
			endwhile;
			?>
		</div>
	</div>
	<?php endif; ?>
</section>
<?php
$posts = get_field( 'featured_blog', $term );
if ( $posts ) :
	?>
	<section class="featured-blog a-up">
		<div class="container">
			<div class="swiper featured-blog__slider">
				<div class="swiper-wrapper">
					<?php
					foreach ( $posts as $post ) :
						setup_postdata( $post );
						get_template_part( 'template-parts/featured', 'post' );
					endforeach;
					?>
				</div>
			</div>
		</div>
	</section>
	<?php
endif;
wp_reset_postdata();
?>
<section class="content-slider">
	<div class="container">
		<div class="section-top a-up">
			<?php
			$heading = get_field( 'slider_heading', $term );
			if ( $heading ) :
				?>
			<h2 class="section-heading"><?php echo esc_html( $heading ); ?></h2>
			<?php endif; ?>
			<?php
			$image = get_field( 'slider_heading_image', $term );
			if ( $image ) :
				?>
			<div class="section-decor" style="background-image: url(<?php echo esc_url( $image['url'] ); ?>);"></div>
			<?php endif; ?>
		</div>
		<?php
		$slider = get_field( 'slider', $term );
		if ( have_rows( 'slider', $term ) ) :
			?>
		<div class="swiper a-up a-delay-1">
			<div class="swiper-wrapper">
				<?php
				while ( have_rows( 'slider', $term ) ) :
					the_row();
					$link = get_sub_field( 'link' );
					?>
				<div class="swiper-slide">
					<div class="content-slide">
						<?php if ( $link ) : ?>
						<a href="<?php echo esc_url( $link['url'] ); ?>" class="content-slide__img" target="<?php echo esc_attr( $link['target'] ? $link['target'] : '_self' ); ?>">
							<?php
							get_template_part_args(
								'template-parts/content-modules-image',
								array(
									'v'   => 'image',
									'is'  => false,
									'v2x' => false,
									'c'   => 'img-cover',
								)
							);
							?>
						</a>
						<?php endif; ?>
						<div class="content-slide__content">
							<?php
							get_template_part_args(
								'template-parts/content-modules-cta',
								array(
									'v' => 'link',
									'c' => 'content-slide__heading',
								)
							);
							?>
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'content',
									't'  => 'div',
                                    'tc' => 'content-slide__copy',
								)
							);
							?>
						</div>
					</div>
				</div>
				<?php endwhile; ?>
			</div>
			<?php if ( count( $slider ) > 1 ) : ?>
			<div class="swiper-button-prev"></div>
			<div class="swiper-button-next"></div>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	</div>
</section>
<?php
get_footer();
