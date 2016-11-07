<?php
/**
* The post sidebar template for our theme.
* This template is used to display the sidebar on single posts.
*
* @package Bold
* @since Bold 4.0
*
*/
?>

<?php if ( is_active_sidebar( 'post-sidebar' ) ) : ?>

	<div class="sidebar">
		<?php dynamic_sidebar( 'post-sidebar' ); ?>
	</div>

<?php endif; ?>