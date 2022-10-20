<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<header class="header">
		<?php
		$enable_top_bar = get_field( 'enable_top_bar', 'options' );
		if ( $enable_top_bar && have_rows( 'top_bar_slider', 'options' ) ) : ?>
        <div class="header-top">
            <div class="container">
                <div class="swiper header-top__slider">
                    <div class="swiper-wrapper">
						<?php
						while ( have_rows( 'top_bar_slider', 'options' ) ) :
							the_row();
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'content',
									't'  => 'div',
									'tc' => 'swiper-slide header-top__slide',
								)
							);
						endwhile;
						?>
                    </div>
                </div>
            </div>
        </div>
		<?php endif; ?>
        <div class="header-main">
            <div class="container">
                <nav class="header-nav">
                    <a href="<?php echo esc_url( home_url() ); ?>" class="header-logo">
                        <?php
						get_template_part_args(
							'template-parts/content-modules-image',
							array(
								'v'   => 'logo',
								'v2x' => false,
								'is'  => false,
								'o'   => 'o',
							)
						);
						?>
                    </a>
                    <button class="hamburger">
                        <span></span>
                    </button>
                    <ul class="header-menu sm">
                        <?php header_mega_menu( 'mainmenu' ); ?>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
	<main class="main">