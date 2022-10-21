<?php $content_modules = get_field( 'content_modules' ); ?>
<section class="sidebar-content sidebar-content__scroller">
	<div class="sidebar-content__inner container">
		<div class="sidebar a-right">
			<?php if ( have_rows( 'modules' ) ) : ?>
			<h6><?php echo esc_html__( 'In This Article:' ); ?></h6>
			<ul class="sidebar-menu">
				<?php
				while ( have_rows( 'modules' ) ) :
					the_row();
					$anchor_id = get_sub_field( 'anchor_id' );
					$heading   = get_sub_field( 'heading' );
					if ( $anchor_id && $heading ) :
						?>
					<li><a href="#<?php echo esc_attr( $anchor_id ); ?>"><?php echo esc_html( $heading ); ?></a></li>
					<?php endif; ?>
				<?php endwhile; ?>
			</ul>
			<?php endif; ?>
			<?php if ( 'post' == get_post_type() ) : ?>
			<a href="#subscribe" class="btn btn-yellow btn-download-guide">
				<?php echo esc_html__( 'Get A Free Training Guide' ); ?>
			</a>
			<?php endif; ?>
			<?php if ( 'trip' == get_post_type() ) : ?>
				<?php
				get_template_part_args(
					'template-parts/content-modules-cta',
					array(
						'v' => 'book_cta',
						'c' => 'btn btn-pink',
						'o' => 'f',
					)
				);
				?>
			<?php endif; ?>
			<?php
			if ( $content_modules ) :
				foreach ( $content_modules as $module ) :
					if ( 'subscribe' == $module['acf_fc_layout'] ) :
						?>
						<a href="javascript:;" data-fancybox data-src="#trip-packet" class="btn btn-yellow btn-download-guide">
							<?php echo esc_html__( 'Download Trip Packet' ); ?>
						</a>
						<?php
					endif;
				endforeach;
			endif;
			?>
			<?php get_template_part( 'template-parts/social', 'share' ); ?>
		</div>
		<div class="content a-left">
			<div class="post-author">
				<div class="post-author__icon">
					<i class="fa-solid fa-feather"></i>
				</div>
				<div class="post-author__info">
					<p class="post-author__name"><?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?></p>
					<p class="post-author__date"><?php echo get_the_date( 'F d, Y' ); ?></p>
				</div>
			</div>
			<?php
			if ( have_rows( 'modules' ) ) :
				while ( have_rows( 'modules' ) ) :
					the_row();
					$anchor_id = get_sub_field( 'anchor_id' );
					?>
					<?php
					if ( 'general_content' == get_row_layout() ) :
						$disable_decor = get_sub_field( 'disable_decoration' );
						?>
						<div class="content-block general-content<?php echo $disable_decor ? ' content-block--no-decor' : ''; ?>"
							<?php echo $anchor_id ? 'id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v' => 'heading',
									't' => 'h3',
								)
							);
							?>
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v' => 'content',
									't' => 'div',
								)
							);
							?>
						</div>
					<?php elseif ( 'itinerary' == get_row_layout() ) : ?>
						<div class="content-block itinerary"
							<?php echo $anchor_id ? 'id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
							<div class="itinerary-header">
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
								<a href="javascript:;" class="btn-expand-all">Expand All Days</a>
							</div>
							<?php
							if ( have_rows( 'accordions' ) ) :
								while ( have_rows( 'accordions' ) ) :
									the_row();
									?>
								<div class="accordion">
									<?php
									get_template_part_args(
										'template-parts/content-modules-text',
										array(
											'v'  => 'heading',
											't'  => 'h6',
											'w'  => 'div',
											'wc' => 'accordion-header',
										)
									);
									?>
									<div class="accordion-content">
										<div class="itinerary-accordion">
											<?php
											get_template_part_args(
												'template-parts/content-modules-text',
												array(
													'v'  => 'content',
													'w'  => 'div',
													'wc' => 'itinerary-accordion__content',
												)
											);
											?>
											<?php
											get_template_part_args(
												'template-parts/content-modules-image',
												array(
													'v'   => 'image',
													'is'  => false,
													'v2x' => false,
													'w'   => 'div',
													'wc'  => 'itinerary-accordion__img',
												)
											);
											?>
										</div>
									</div>
								</div>
									<?php
								endwhile;
							endif;
							?>
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'map',
									't'  => 'div',
									'tc' => 'itinerary-map',
								)
							);
							?>
						</div>
						<?php
					elseif ( 'gallery' == get_row_layout() ) :
						$images = get_sub_field( 'gallery' );
						?>
						<div class="content-block gallery" id="block-3">
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
							<?php if ( $images ) : ?>
							<div class="gallery-grid">
								<?php foreach ( $images as $image ) : ?>
								<div class="gallery-item"><img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>"></div>
								<?php endforeach; ?>
								<?php if ( count( $images ) > 9 ) : ?>
								<div class="gallery-cta">
									<a href="javascript:;" class="btn btn-yellow">Load More</a>
								</div>
								<?php endif; ?>
							</div>
							<?php endif; ?>
						</div>
					<?php else : ?>
				<?php endif; ?>
					<?php
				endwhile;
			endif;
			?>
			<?php if ( 'post' == get_post_type() ) : ?>
				<?php get_template_part( 'template-parts/social', 'share' ); ?>
				<?php $author_id = get_the_author_meta( 'ID' ); ?>

				<div class="author-box">
					<div class="author-box__image">
						<img class="img-cover" src="<?php echo esc_url( get_avatar_url( $author_id ) ); ?>" alt="">
					</div>
					<div class="author-box__content">
						<h3 class="author-box__name">Meet <?php echo get_the_author_meta( 'Display Name' ); ?></h3>
						<?php
						$bio       = get_the_author_meta( 'user_description' );
						if ( $bio ) :
							?>
							<p class="author-box__bio"><?php echo esc_html( $bio ); ?></p>
						<?php endif; ?>
						<a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>" class="btn btn-yellow"><?php echo esc_html__( 'More From This Author' ); ?></a>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
