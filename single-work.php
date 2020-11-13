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
						<?php the_title(); ?>
					</h1>
					<?php //the_post_thumbnail( 'post-thumbnail' );
						// echo('<div class="entry-meta">');
						// the_author(); 
						// echo(' &middot; ') ;
						// echo minimumminimal_date(); 
						// echo('</div>');
						
					?>
				</header>
				<iframe src="<?php the_field('video_url'); ?>" width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
		</article>
			<?php endwhile;?>
    </div><!-- #primary -->
</div> <!-- #container -->
<?php get_footer(); ?>