<?php
/**
* The default sidebar template for our theme.
* This template is used to display the sidebar on pages.
*
* @package Bold
* @since Bold 4.0
*
*/
?>

<?php if ( is_active_sidebar( 'page-sidebar' ) ) : ?>

	<div class="sidebar">
		<?php dynamic_sidebar( 'page-sidebar' ); ?>
	</div>

<?php endif; ?>