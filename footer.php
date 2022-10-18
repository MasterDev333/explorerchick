
	</main>
	<footer class="footer">
		<div class="footer-main">
			<div class="container">
				<div class="footer-row">
					<div class="footer-col a-up">
						<a href="<?php echo esc_url( home_url() ); ?>" class="footer-logo">
							<?php
							get_template_part_args(
								'template-parts/content-modules-image',
								array(
									'v'   => 'footer_logo',
									'is'  => false,
									'v2x' => false,
									'o'   => 'o',
								)
							);
							?>
						</a>
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'footermenu',
                                'container'      => false,
                            )
                        );
                        ?>
					</div>
                    <?php dynamic_sidebar( 'footer_area_one' ); ?>
                    <?php dynamic_sidebar( 'footer_area_two' ); ?>
					<?php if ( have_rows( 'social_links', 'options' ) ) : ?>
					<div class="footer-col a-up a-delay-3">
						<h6><?php echo esc_html__( 'Say Hello' ); ?></h6>
						<ul class="menu">
							<?php
							while ( have_rows( 'social_links', 'options' ) ) :
								the_row();
								$icon = get_sub_field( 'icon' );
								$link = get_sub_field( 'link' );
								?>
								<li>
                                    <a href="<?php echo esc_url( $link['url'] ); ?>" 
                                       target="<?php echo esc_attr( $link['target'] ? $link['target'] : '_self' ); ?>">
                                       <?php if ( $icon ) : ?>
                                       <i class="fa-brands fa-<?php echo esc_attr( $icon ); ?>"></i>
                                       <?php endif; ?>
                                       <?php echo esc_html( $link['title'] ); ?>
                                    </a>
                                </li>
							<?php endwhile; ?>
						</ul>
					</div>
					<?php endif; ?>
					<div class="footer-subscribe a-up a-delay-4">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v' => 'footer_form_heading',
								't' => 'h6',
								'o' => 'o',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v' => 'footer_form_description',
								't' => 'p',
								'o' => 'o',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-shortcode',
							array(
								'v'  => 'footer_form_code',
								't'  => 'div',
								'tc' => 'footer-subscribe',
								'o'  => 'o',
							)
						);
						?>
						<form action="" class="footer-subscribe">
							<div class="form-row">
								<div class="form-col full-width">
									<input type="email" class="form-control" id="footer-email" placeholder="Email Address">
								</div>
								<div class="form-col">
									<input type="text" class="form-control" id="footer-first-name" placeholder="First Name">
								</div>
								<div class="form-col">
									<input type="text" class="form-control" id="footer-last-name" placeholder="Last Name">
								</div>
								<div class="form-col full-width">
									<button class="btn btn-pink" type="submit">Sign Me Up</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="container">
				<div class="footer-bottom__inner">
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'copyright',
							't'  => 'div',
							'tc' => 'footer-copy a-up',
							'o'  => 'o',
						)
					);
					?>
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'terms',
							't'  => 'div',
							'tc' => 'footer-right a-up a-delay-1',
							'o'  => 'o',
						)
					);
					?>
				</div>
			</div>
		</div>
	</footer>
	<?php wp_footer(); ?>
</body>
</html>
