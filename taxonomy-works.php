<?php get_header(); ?>

<?php $herofeaturedimage = minimumminimal_themeoptions('herofeaturedimage'); 
	if ((!empty($herofeaturedimage))  && (has_post_thumbnail( $post->ID ) ) ): ?>       
              <div id="herofeaturedimage" class="coverimage">
              	<?php the_post_thumbnail( 'minimumminimal_single-post-cover' );?>
              </div>
<?php endif;

$args = array(
    'post_type' => 'work',
    'tax_query' => array(
        array(
            'taxonomy' => 'works',
            'field'    => 'slug',
            'terms'    => get_queried_object()->slug,
        ),
    ),
);
?>
<div id="container" class="row">
  <ul class="works-container"> 
    <?php    $loop = new WP_Query($args);
    while ( $loop->have_posts() ) {
    $loop->the_post(); ?>
      <li class="entry-content">
        <div class="postlistthumb">
          <div class="postlistthumbwrap">
            <figure>
              <a href="<?php the_permalink() ?>" rel="bookmark">
                <?php the_post_thumbnail( 'post-thumbnail' );?>
              </a>
            </figure>
            <figcaption><?php the_title()?></figcaption>  
          </div>
        </div>
      </li>
<?php } ?>  
    </ul>
</div>
<div>

</div>

<?php get_footer(); ?>

