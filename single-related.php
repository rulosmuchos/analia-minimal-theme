
	 				
<?php
//function to get related post having codition inside
function minimumminimal_get_related_post($postID){
		
			$tags = wp_get_post_tags($postID);
			$foundPosts = 0;
			 $excludes = array();
             $excludes[]=$postID;
			
			if ($tags) {
					$tag_ids = array();
					foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
			
					$args=array(
							'tag__in' => $tag_ids,
							'post__not_in' => array($postID),
							'showposts'=>8,
							'ignore_sticky_posts'=>1
						 );
			
				$my_query = new WP_Query($args);
				$foundPosts = $my_query->found_posts;
			
				if( $my_query->have_posts() ) {
					while ($my_query->have_posts()) : $my_query->the_post();
					$excludes[]=$my_query->post->ID; 
					
						 get_template_part( 'loop', get_post_format() ); 
						 
					endwhile;
				}
				wp_reset_postdata();
				
			}
			
			if ($foundPosts <8){
					$remainingPosts = 8- $foundPosts;
					minimumminimal_get_category_posts($postID, $remainingPosts, $excludes);
				}
			
}

//Get remaining post from category by that given post id
function minimumminimal_get_category_posts($postID, $remainingPosts, $excludes){

				$catArgs = array(
												'category__in' =>  wp_get_post_categories($postID), 
												'showposts' => $remainingPosts,
												'post__not_in' => $excludes
										);
										
		 		$cat_post_query = new WP_Query($catArgs);
				$foundPosts = $cat_post_query->found_posts;
			
				if( $cat_post_query->have_posts() ) {
					
					while ($cat_post_query->have_posts()) : $cat_post_query->the_post();
						$excludes[]=$cat_post_query->post->ID; 
						
							 get_template_part( 'loop', get_post_format() ); 
							 
					endwhile;
				}
				wp_reset_postdata();

     	if ($foundPosts < $remainingPosts){
				$stillRemaing = $remainingPosts-$foundPosts;
				
			minimumminimal_get_latest_posts($excludes, $stillRemaing);
				
			}
  }

//Get rest of the posts from latest post types

function minimumminimal_get_latest_posts($excludes, $stillRemaing){
	
	
			$latestPost = array(
					'showposts' => $stillRemaing,
					'post__not_in' => $excludes,
					'post_type' => 'post',
					'posts_per_page' => $stillRemaing,
					'offset'=>0,
					'orderby' => 'post_date',
					'order' => 'DESC',
			);
			$latest_post_query = new WP_Query($latestPost);
		
			if( $latest_post_query->have_posts() ) {
					while ($latest_post_query->have_posts()) : $latest_post_query->the_post(); 
					
						 get_template_part( 'loop', get_post_format() ); 
						  
					endwhile;
				}
				wp_reset_postdata();
	}

 echo minimumminimal_get_related_post($post->ID); ?>


<aside class="backhome">
	<a href="<?php echo esc_url(home_url( '/' )); ?>" class="button" title="<?php bloginfo( 'name', 'display' );?> - <?php bloginfo( 'description' ); ?>">
       <?php _e( 'Back to Home Page', 'minimum-minimal' ); ?>
    </a>
</aside>