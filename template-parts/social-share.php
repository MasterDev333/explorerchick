<div class="social-share">
    <p><?php echo esc_html__( 'Share' ); ?></p>
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( get_the_permalink() ); ?>"><i class="fa-brands fa-facebook-f"></i></a>
    <a href="https://pinterest.com/pin/create/button/?url=<?php echo esc_url( get_the_permalink() ); ?>&media=&description="><i class="fa-brands fa-pinterest-p"></i></a>
    <a href="mailto:info@example.com?&subject=&cc=&bcc=&body=<?php echo esc_url( get_the_permalink() ); ?>%0A"><i class="fa-solid fa-envelope"></i></a>
    <a href="javascript:;" data-url="<?php echo esc_url( get_the_permalink() ); ?>" class="social-share__copy"><i class="fa-solid fa-link-horizontal"></i></a>
</div>