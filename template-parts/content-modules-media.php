<?php
$video = $args['video'];
$image = $args['image'];
$size  = $args['size'];
$class = $args['class'];
if ( $size ) :
	$img_url = $image['sizes'][ $size ];
else :
	$img_url = $image['url'];
endif;
?>
<?php if ( $video ) : ?>
	<video loop playsinline muted preload="metadata" src="<?php echo esc_url( $video ); ?>"<?php echo $class ? ' class="' . $class . '"' : ''; ?>>
		<source src="<?php echo esc_url( $video ); ?>" type="video/mp4">
	</video>
<?php elseif ( $image ) : ?>
	<img class="lazyload<?php echo $class ? ' ' . esc_attr( $class ) : ''; ?>" data-src="<?php echo esc_url( $img_url ); ?>" alt="">
<?php endif; ?>
