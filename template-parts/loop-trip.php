<?php
global $post;
$tags = get_the_terms( $post, 'trip_tag' );
?>
<div class="swiper-slide">
	<div class="cpt-slide">
		<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="cpt-slide__img">
			<img class="img-cover" src="<?php echo esc_url( get_the_post_thumbnail_url( $post, 'loop-trip-img' ) ); ?>" alt="">
			<?php if ( $tags ) : ?>
			<span class="cpt-slide__cat"><?php echo esc_html( $tags[0]->name ); ?></span>
			<?php endif; ?>
		</a>
		<?php endif; ?>
		<div class="cpt-slide__content">
			<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="cpt-slide__title">
				<?php echo esc_html( get_the_title() ); ?>
			</a>
			<p class="cpt-slide__date">7 DAYS, WYOMING</p>
			<div class="cpt-slide__item">
				<i class="fa-solid fa-boot"></i>
				<span>Hiking, National Parks, Wildlife</span>
			</div>
			<div class="cpt-slide__item">
				<i class="fa-solid fa-bed"></i>
				<span>Shared Housing, Park Hotels</span>
			</div>
		</div>
	</div>
</div>
