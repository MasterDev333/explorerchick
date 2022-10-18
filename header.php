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
                        <li class="menu-item">
                            <a href="#">Destinations</a>
                        </li>
                        <li class="menu-item">
                            <a href="#">EC Trips</a>
                            <ul class="dropdown">
                                <li>
                                    <div class="submenu">
                                        <div class="column">
                                            <h6>By Style</h6>
                                            <div class="submenu-links">
                                                <div><a href="#">Backpacking</a></div>
                                                <div><a href="#">Bucket List</a></div>
                                                <div><a href="#">Glamping</a></div>
                                                <div><a href="#">Hiking</a></div>
                                                <div><a href="#">International</a></div>
                                                <div><a href="#">Multiday Treks</a></div>
                                                <div><a href="#">Multisport</a></div>
                                                <div><a href="#">National Park</a></div>
                                                <div><a href="#">Safari</a></div>
                                                <div><a href="#">Snowy Adventures</a></div>
                                                <div><a href="#">Tropical</a></div>
                                                <div><a href="#">US-Based</a></div>
                                                <div><a href="#">Water Sports</a></div>
                                                <div><a href="#">Weekend</a></div>
                                            </div>
                                        </div>
                                        <div class="column">
                                            <h6>By Activity</h6>
                                            <div class="submenu-links col-2">
                                                <div><a href="#">Camping</a></div>
                                                <div><a href="#">Canyonnering</a></div>
                                                <div><a href="#">Caving</a></div>
                                                <div><a href="#">Climbing</a></div>
                                                <div><a href="#">Cross Country Skiing</a></div>
                                                <div><a href="#">Cycling</a></div>
                                                <div><a href="#">Dog Sledding</a></div>
                                                <div><a href="#">Glacier Trek</a></div>
                                                <div><a href="#">Hiking</a></div>
                                                <div><a href="#">Horseback Riding</a></div>
                                                <div><a href="#">Hot Springs</a></div>
                                                <div><a href="#">Ice Climbing</a></div>
                                                <div><a href="#">Off Roading</a></div>
                                                <div><a href="#">Paddling</a></div>
                                                <div><a href="#">Rappelling</a></div>
                                                <div><a href="#">Snow Shoeing</a></div>
                                                <div><a href="#">Surfing</a></div>
                                                <div><a href="#">Tree Climbing</a></div>
                                                <div><a href="#">Trekking</a></div>
                                                <div><a href="#">White Water Rafting</a></div>
                                                <div><a href="#">Wildlife</a></div>
                                                <div><a href="#">Workshops</a></div>
                                                <div><a href="#">Yoga</a></div>
                                                <div><a href="#">Zip Lining</a></div>
                                            </div>
                                        </div>
                                        <div class="column">
                                            <h6>By Demands</h6>
                                            <div class="submenu-links">
                                                <div><a href="#">Activity Level 1</a></div>
                                                <div><a href="#">Activity Level 2</a></div>
                                                <div><a href="#">Activity Level 3</a></div>
                                                <div><a href="#">Activity Level 4</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item">
                            <a href="#">Day Adventures</a>
                        </li>
                        <li class="menu-item">
                            <a href="#">Travel Dates</a>
                        </li>
                        <li class="menu-item">
                            <a href="#">EC Essentials</a>
                        </li>
                        <li class="menu-item">
                            <a href="#">Why EC?</a>
                        </li>
                        <li class="menu-item">
                            <a href="#">Shop</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
	<main class="main">