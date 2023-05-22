<?php

// Listing Blog New

add_shortcode( 'listing-blog-new', function( $atts ) {
	ob_start();
	extract( shortcode_atts(
		array(
			'post_type' 		=> 'post',
			'orderby' 			=> '',
			'order' 			=> '',
			'posts_per_page' 	=> get_option( 'posts_per_page' ),
			'taxonomy' 			=> '',
			'terms' 			=> '',
			'pagination' 		=> 'no', // yes or no
			'select_listing'	=> '', // posts, category or -
			'posts'				=> '',
			'extra_class'		=> ''
		),
		$atts
	));

	static $uuid_listing = 2015;
	$id_listing 	= "listing-" . $uuid_listing;

	$orderby		= ( $orderby === 'popular' ) ? 'post_views' : $orderby;

	$paged_type		= ( is_front_page() ) ? "page" : "paged";
	$paged			= ( get_query_var( $paged_type ) ) ? get_query_var( $paged_type ) : 1;

	// Default Argument for WP_Query
	$args = array(
		'post_type' 			=> $post_type,
		'posts_per_page' 		=> $posts_per_page,
		'post_status' 			=> 'publish',
		'ignore_sticky_posts' 	=> true,
		'order' 				=> $order,
		'orderby' 				=> $orderby,
	);

	// Validate query param target_pagination exists and match with $id_listing
	if ( isset( $_GET['target_pagination'] ) && $_GET['target_pagination'] === $id_listing ) {
		$args['paged'] = $paged;
	}

	// Make exclude for current post
	if ( is_singular() ) {
		$args['post__not_in'] = array( get_queried_object()->ID );
	}

	// Custom Argument for selected taxonomy and term
	if ( ! empty( $taxonomy ) && $select_listing === "category" ) {
		if ( empty( $terms ) ) {
			$terms = array(); 
			$get_terms = get_terms( array(
							'taxonomy' => $taxonomy,
							'hide_empty' => false,
						) );

			foreach ( $get_terms as $get_term ) {
				$terms[] = $get_term->term_id;
			}
		} else {
			$terms = str_replace( " , ", ",", $terms );
			$terms = str_replace( " ,", ",", $terms );
			$terms = str_replace( ", ", ",", $terms );
			$terms = explode ( ",", $terms );
		}

		$args['tax_query'] = array(
			array(
				'taxonomy' => $taxonomy,
				'field'    => 'term_id',
				'terms'    => $terms,
			),
		);

		$extra_class .= " listing-selected-tax";
	}

	// Custom Argument for selected posts
	if ( $select_listing === "posts" ) {
		$posts = str_replace( " , ", ",", $posts );
		$posts = str_replace( " ,", ",", $posts );
		$posts = str_replace( ", ", ",", $posts );

		$select_post = explode( ",", $posts );
		$args['post__in'] = $select_post;
		$args['posts_per_page'] = -1;

		$extra_class .= " listing-selected-item";
	}


	$query 			= new WP_Query( $args ); 
	$class_listing 	= "listing listing-list listing-blog-new $extra_class";
	?>

	<div id="<?php echo esc_attr( $id_listing ); ?>" class="<?php echo esc_attr( $class_listing ); ?>">
		<?php
			if ( $query->have_posts() ) :
				while ( $query->have_posts() ) :
					$query->the_post();

					$post_id		= get_the_ID();

					$thumb_id		= get_post_thumbnail_id( $post_id );
					$title_listing	= get_the_title( $post_id );
					$url_link		= get_permalink( $post_id );
					$text_info 		= get_field( "infotext" );
					$thumb_url		= wp_get_attachment_image_src( $thumb_id, 'large' )[0];
					?>
						
					<div class="listing-item">
						<div class="listitem-wrapper" style="background: url( '<?php echo $thumb_url ?>' ) center center/cover no-repeat;">
							<a href="<?php echo esc_url( $url_link ); ?>" class="link-absolute"></a>
							<div class="content-item">
								
								<div class="field-info">
									<h2 class="text-info"><?php echo esc_html( $text_info ); ?></h2>
								</div>

								<div class="wrapper-info">
									<h4 class="title-listing"><?php echo esc_html( $title_listing ); ?></h4>
									<div class="infolist">
										<span class="info-category"><?php echo get_the_term_list( $post_id, 'category', '', '' ); ?></span>
									</div>
									<div class="excerpt-listing"><?php echo esc_html( the_excerpt() ); ?></div>
									<a href="<?php echo esc_url( $url_link ); ?>" class="button-link">Button Link</a>
								</div>

							</div>
						</div>
					</div>

					<?php
				endwhile;
			endif;
		?>
	</div>

	<?php if ( $pagination === 'yes' ): ?>
		<div class="pagination-wrapper">
			<?php echo whello_pagination( $query, $paged_type, $id_listing );?>
		</div>
	<?php endif; ?>

	<?php
	$uuid_listing++;
	wp_reset_postdata();
	return ob_get_clean();
} );