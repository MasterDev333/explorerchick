<?php global $post; ?>
<div class="swiper-slide">
	<div class="cpt-slide">
		<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="cpt-slide__img">
			<img class="img-cover" src="<?php echo esc_url( get_the_post_thumbnail_url( $post, 'loop-trip-img' ) ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
		</a>
		<?php endif; ?>
		<div class="cpt-slide__content">
			<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="cpt-slide__title">
				<?php echo esc_html( get_the_title() ); ?>
			</a>
			<?php if ( has_excerpt() ) : ?>
			<p class="cpt-slide__text"><?php echo esc_html( get_the_excerpt() ); ?></p>
			<?php endif; ?>
			<?php
			$categories = get_the_category();
			if ( $categories ) :
				?>
			<p class="cpt-slide__category">
				<i class="fas fa-tag"></i>
				<?php
				$category_names = array();
				foreach ( $categories as $category ) :
					$category_names[] = $category->name;
				endforeach;
				echo esc_html( join( ', ', $category_names ) );
				?>
			</p>
			<?php endif; ?>
		</div>
	</div>
</div>
