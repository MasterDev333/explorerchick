<?php extract( $template_args ); ?>
<?php $ww = isset( $w ) && ! empty( $w ) ? $w : false; ?>
<?php $wclass = isset( $wc ) && ! empty( $wc ) ? $wc : ''; ?>
<?php $val = isset( $v ) && ! empty( $v ) ? $v : 'video'; ?>
<?php $class = isset( $c ) && ! empty( $c ) ? $c : ''; ?>
<?php $option = isset( $o ) && ! empty( $o ) ? $o : false; ?>

<?php
if ( 'o' == $option ) {
	$url = get_field( $val, 'option' );
} elseif ( 'f' == $option ) {
	$url = get_field( $val );
} else {
	$url = get_sub_field( $val );
}
?>
<?php if ( $url ) : ?> 
	<?php if ( $ww ) : ?>
		<<?php echo esc_attr( $ww ); ?> <?php
		if ( $wclass ) {
			echo 'class="' . esc_attr( $wclass ) . '"'; }
		?>
		>
	<?php endif ?>
		<video autoplay loop playsinline muted preload="metadata" src="<?php echo esc_url( $url ); ?>" 
		<?php
			if ( $class ) {
				echo 'class="' . esc_attr( $class ) . '"';
			}
		?>
		
		>
			<source src="assets/video/banner.mp4" type="video/mp4">
		</video>
	<?php if ( $ww ) : ?>
		</<?php echo esc_attr( $ww ); ?>>
	<?php endif; ?>
<?php endif; ?>
