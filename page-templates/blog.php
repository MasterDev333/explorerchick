<?php
/**
 * Template Name: Blog
 */
get_header();
global $post;
?>
<?php
$posts = get_field( 'featured_blog' );
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
<section class="blog-search">
	<div class="container-sm">
		<div class="blog-search__inner">
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 'search_form_heading',
					't'  => 'h4',
					'tc' => 'blog-search__title a-up',
					'o'  => 'f',
				)
			);
			?>
			<div class="form-row a-up a-delay-1">
				<div class="form-col">
					<div class="blog-search__form form-group">
						<input type="search" class="form-control" placeholder="Enter search term">
						<button type="submit" class="btn btn-yellow"><?php echo esc_html__( 'Search' ); ?></button>
					</div>
				</div>
				<?php
				$categories = get_categories();
				if ( $categories ) :
					?>
				<div class="form-col">
					<div class="form-group">
						<select name="" id="blog-categories" class="blog-categories jcf-select">
							<option selected disabled value=""><?php echo esc_html__( 'Select Category' ); ?></option>
							<?php foreach ( $categories as $category ) : ?>
							<option value="<?php echo esc_url( get_term_link( $category ) ); ?>"><?php echo esc_html( $category->name ); ?></option>
							<?php endforeach; ?>
						</select>
						<button class="btn btn-yellow"><?php echo esc_html__( 'Filter' ); ?></button>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<?php
$args  = array(
	'post_type'      => 'post',
	'post__not_in'   => array( get_the_ID() ),
	'posts_per_page' => 3,
	'posts_status'   => 'publish',
);
$query = new WP_Query( $args );
if ( $query->have_posts() ) :
	?>
	<section class="cpt-slider cpt-slider--post">
		<div class="container">
			<div class="section-top a-up">
				<h2 class="section-heading"><?php echo esc_html__( 'The Latest' ); ?></h2>
				<div class="section-decor" style="background-image: url(<?php echo esc_url( get_template_directory_uri() . '/assets/img/megaphone.png' ); ?>"></div>
			</div>
			<div class="swiper a-up a-delay-2">
				<div class="swiper-wrapper">
					<?php
					while ( $query->have_posts() ) :
						$query->the_post();
						get_template_part( 'template-parts/loop', 'post' );
					endwhile;
					?>
				</div>
				<div class="swiper-button-prev"></div>
				<div class="swiper-button-next"></div>
			</div>
			<div class="cpt-slider__cta a-up a-delay-3">
				<a href="#" class="btn btn-pink">View More Articles</a>
			</div>
		</div>
	</section>
	<?php
endif;
wp_reset_postdata();
?>
<?php
$selected_categories = get_field( 'categories' );
if ( $selected_categories ) :
	foreach ( $selected_categories as $cat_id ) :
		$args     = array(
			'post_type'      => 'post',
			'category__in'   => $cat_id,
			'post__not_in'   => array( get_the_ID() ),
			'posts_per_page' => 3,
		);
		$category = get_term_by( 'id', $cat_id, 'category' );
		$query    = new WP_Query( $args );
		if ( $query->have_posts() ) :
			?>
		<section class="cpt-slider cpt-slider--post">
			<div class="container">
				<div class="section-top a-up">
					<h2 class="section-heading"><?php echo esc_html( $category->name ); ?></h2>
					<?php
					$image = get_field( 'image', 'category_' . $cat_id );
					if ( $image ) :
						?>
					<div class="section-decor" style="background-image: url(<?php echo esc_url( $image ); ?>);"></div>
					<?php endif; ?>
				</div>
				<div class="swiper a-up a-delay-2">
					<div class="swiper-wrapper">
						<?php
						while ( $query->have_posts() ) :
							$query->the_post();
							get_template_part( 'template-parts/loop', 'post' );
						endwhile;
						?>
					</div>
					<div class="swiper-button-prev"></div>
					<div class="swiper-button-next"></div>
				</div>
				<?php if ( $query->max_num_pages > 1 ) : ?>
				<div class="cpt-slider__cta a-up a-delay-3">
					<a href="<?php echo esc_url( get_term_link( $category ) ); ?>" class="btn btn-pink"><?php echo esc_html__( 'View More Articles' ); ?></a>
				</div>
				<?php endif; ?>
			</div>
		</section>
			<?php
		endif;
		wp_reset_postdata();
	endforeach;
endif;
?>
<?php
get_footer();
