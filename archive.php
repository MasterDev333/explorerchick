<?php
/*
Template Name: Archives
*/
get_header(); ?>

<section class="cpt-grid">
	<div class="container">
		<h1 class="section-heading"><?php echo get_the_archive_title(); ?></h1>
		<?php
		if ( have_posts() ) :
			?>
            <div class="cpt-slides">
                <?php
                while ( have_posts() ) :
                    the_post();
                    get_template_part( 'template-parts/loop', get_post_type() );
                endwhile;
                ?>
            </div>
		<?php else : ?>
            <div class="no-posts"><?php echo esc_html__( 'No posts found.' ); ?></div>
			<?php
		endif;
		?>
	</div>
</section>

<?php get_footer(); ?>
