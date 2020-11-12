<?php get_header(); ?>

<?php $herofeaturedimage = minimumminimal_themeoptions('herofeaturedimage'); 
	if ((!empty($herofeaturedimage))  && (has_post_thumbnail( $post->ID ) ) ): ?>       
              <div id="herofeaturedimage" class="coverimage">
              	<?php the_post_thumbnail( 'minimumminimal_single-post-cover' );?>
              </div>
<?php endif; ?>

<div id="container" class="row">
  <div id="primary" class="<?php if (( has_post_format( 'video' )) || ( has_post_format( 'video' )) || ( has_post_format( 'gallery' ))) : ?>small-11<?php else : ?>large-7 medium-8 small-11<?php endif; ?> small-centered columns">
  	<article <?php post_class('articlebox'); ?>>
	<?php	
		while ( have_posts() ) : the_post(); ?>
	
			<header class="entry-header entry-header-single">
				<h1 class="entry-title">
					<?php if ( has_post_format( 'audio' )) : ?>
						  <span class="icon-volume-up-1"></span>
						<?php elseif ( has_post_format( 'video' )) : ?>
						  <span class="icon-play-circled2"></span>
						<?php elseif  ( has_post_format( 'image' )) : ?>
						  <span class="icon-picture-2"></span>
						<?php elseif ( has_post_format( 'gallery' )) : ?>
						  <span class="icon-picture"></span>
						<?php elseif ( has_post_format( 'link' )) : ?>
						  <span class="icon-link-1"></span>
						<?php elseif ( has_post_format( 'quote' )) : ?>
						  <span class="icon-quote"></span>
						<?php elseif ( has_post_format( 'status' )) : ?>
						  <span class="icon-child"></span>
						<?php elseif ( has_post_format( 'chat' )) : ?>
						  <span class="icon-link-1"></span>
						 <?php elseif ( has_post_format( 'aside' )) : ?>
						  <span class="icon-heart-empty"></span>
						<?php endif; ?>
					<?php the_title(); ?>
				</h1>
				<?php 
				 	echo('<div class="entry-meta">');
				 	the_author(); 
				 	echo(' &middot; ') ;
				 	echo minimumminimal_date(); 
				 	echo('</div>');
				?>
			</header>
			<div class="entry-content">
				<?php the_content(); 

				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'minimum-minimal' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) ); ?>
			</div><!-- .entry-content -->
	</article>
			
		<div class="entry-meta cat-and-tags">
			<div id="categories"><span class="icon-archive"></span> <p><?php the_category( ', ' ); ?></p></div>
			<?php if(get_the_tag_list()) : ?>
				<div id="tags"><span class="icon-tags"></span> <p><?php echo get_the_tag_list('',', ','');?></p></div>
			<?php endif; ?>
    	</div>

    </div><!-- #primary -->
    <div class="row">
    	<div class="large-7 medium-8 small-11 small-centered columns">
	    	<?php 
			// Author Bio
			if ( get_the_author_meta( 'description' ) ) :
				get_template_part( 'author-bio' );
			endif;


	        // Above Comments Widget Area
	        if ( is_active_sidebar( 'above-comments-widget-area' ) ) : ?>
	            <div id="above-comments-widget-area" class="widget-area" role="complementary">
	              <?php dynamic_sidebar( 'above-comments-widget-area' ); ?>
	            </div><!-- #above-comments-posts-widget-area -->
	        <?php endif;

			// Comments
				if ( comments_open() || get_comments_number() ) :
				comments_template();
				endif;
			endwhile;?>
		    

	    	<?php // Above Related Posts Widget Area
	    		if ( is_active_sidebar( 'above-related-posts-widget-area' ) ) : ?>
	            <div id="above-related-posts-widget-area" class="widget-area" role="complementary">
	              <?php dynamic_sidebar( 'above-related-posts-widget-area' ); ?>
	            </div><!-- #above-related-posts-widget-area -->
	        <?php endif; 
	        	// Related Posts
	        	$displayrelatedposts = minimumminimal_themeoptions('displayrelated'); 
	        	if ($displayrelatedposts != '') : 
	        		get_template_part( 'single-related' ); 
	        	endif; ?>

    	</div>
    </div>


                  

</div> <!-- #container -->

<?php get_footer(); ?>