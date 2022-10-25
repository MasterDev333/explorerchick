<div class="featured-post">
    <div class="featured-post__content">
        <h3 class="h3-alt featured-post__title"><?php echo esc_html( get_the_title() ); ?></h3>
        <?php if ( has_excerpt() ) : ?>
        <p class="featured-post__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
        <?php endif; ?>
        <a href="<?php echo esc_url( get_the_permalink() ); ?>" class="btn btn-yellow btn-read-more">
            <?php echo esc_html__( 'Read More' ); ?>
        </a>
    </div>
    <?php if ( has_post_thumbnail() ) : ?>
    <div class="featured-post__image">
        <img class="img-cover" src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>" alt="">
    </div>
    <?php endif; ?>
</div>
