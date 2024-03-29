<!-- BEGIN .portfolio-wrap -->
<div class="portfolio-wrap">

	<?php
		$portfoliocat = of_get_option('category_portfolio');
		if ( function_exists('icl_object_id')) { 
			$multi_lingual_ID = icl_object_id($portfoliocat, 'category', false);
			$terms = get_terms('category', 'child_of='.$multi_lingual_ID.'&hide_empty=0' );
		} else {
			$terms = get_terms('category', 'child_of='.$portfoliocat.'&hide_empty=0' );
		}
		$count = count($terms);
		if ( $count > 0 ) {
			echo '<ul id="portfolio-filter">';
			echo '<li><a class="radius-full" href="javascript:void(0)" data-filter="*">All</a></li>';
			foreach ( $terms as $term ) {
				$termname = strtolower($term->slug);
				$termname = str_replace(' ', '-', $termname);
				echo '<li><a class="radius-full" href="javascript:void(0)" data-filter=".category-'.$termname.'" rel="'.$termname.'">'.$term->name.'</a></li>';
			}
			echo "</ul>";
		}
	?>
	
	<!-- BEGIN .portfolio -->
	<div class="portfolio radius-bottom <?php if (of_get_option('portfolio_columns') == 'two') { ?>portfolio-half<?php } if (of_get_option('portfolio_columns') == 'three') { ?>portfolio-third<?php } ?>">
		
		<!-- BEGIN .row -->
		<ul id="portfolio-list" class="row">
			
		<?php $wp_query = new WP_Query(array('cat'=>of_get_option('category_portfolio'), 'posts_per_page'=>-1, 'suppress_filters'=>0)); ?>
		<?php if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); ?>
		<?php if (isset($_POST['featurevid'])){ $custom = get_post_custom($post->ID); $featurevid = $custom['featurevid'][0]; } ?>
	
			<!-- BEGIN .portfolio-item -->
			<li class="portfolio-item <?php if (of_get_option('portfolio_columns') == 'one') { ?>single<?php } if (of_get_option('portfolio_columns') == 'two') { ?>half<?php } if (of_get_option('portfolio_columns') == 'three') { ?>third<?php } ?> <?php $allClasses = get_post_class(); foreach ($allClasses as $class) { echo $class . " "; } ?>" data-filter="category-<?php $allClasses = get_post_class(); foreach ($allClasses as $class) { echo $class . " "; } ?>">
			
				<!-- BEGIN .post-holder -->
				<div class="post-holder radius-full">
				
					<?php if ( get_post_meta($post->ID, 'featurevid', true) ) { ?>
						<div class="feature-vid"><?php echo get_post_meta($post->ID, 'featurevid', true); ?></div>
					<?php } else { ?>
						<?php if ( '' != get_the_post_thumbnail()) { ?>
							<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'organicthemes' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail( 'bold-featured-large' ); ?></a>
						<?php } ?>
					<?php } ?>
				
					<?php if(of_get_option('display_portfolio_info') == '1') { ?>
						<div class="excerpt radius-bottom">
							<h2 class="title text-center"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
							<?php the_excerpt(); ?>
						</div><!-- END .excerpt -->
					<?php } ?>
				
				<!-- END .post-holder -->
				</div>
			
			<!-- END .portfolio-item -->
			</li>
	
		<?php endwhile; ?>
	
		<!-- END .row -->
		</ul>
	
		<?php else: ?>
		
		<p><?php _e("Sorry, no posts matched your criteria.", 'organicthemes'); ?></p>
		
		<?php endif; ?>
	
	<!-- END .portfolio -->
	</div>

<!-- END .portfolio-wrap -->
</div>