<?php get_header(); ?>

<!-- container -->
<div class="container">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<?php if ( has_post_thumbnail() ) { 

		$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

	   	<!-- slider -->
	    <div class="slider-container">

	    	<div class="slider-bg" style="background: url(<?php echo $url;?>) no-repeat center center;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;"></div> 

	    </div>
	   	<!-- /slider -->

	<?php } ?>

    <!-- content -->
    <div class="content">

        <?php 

            $layout = get_post_meta( $post->ID, 'fullfolio_meta_box_select', true ); 

            if( empty( $layout ) || $layout == '2') { ?>

                <div class="col2">
                    <h2><?php the_title();?></h2>
                    <p class="date-item"><?php the_time(get_option('date_format')); ?></p>

                    <?php if( get_the_tag_list() ) { ?>

                        <p class="tags">Tags: <?php echo get_the_tag_list();?></p>

                    <?php } ?>                        
                </div>

                <div class="col2">
                    <?php the_content();?>
                </div>

            <?php } else { ?>

                <div class="col1">

                    <h2><?php the_title();?></h2>

                    <?php if( get_the_tag_list() ) { ?>

                        <p class="date-item date-col"><?php the_time(get_option('date_format')); ?></p>
                        <p class="tags">Tags: <?php echo get_the_tag_list();?></p>

                    <?php } else { ?>

                        <p class="date-item date-col" style="padding-bottom:30px;"><?php the_time(get_option('date_format')); ?></p>

                    <?php } ?>

                    <?php the_content();?>

                </div>

            <?php }

        ?>

    </div>
    <!-- content -->

    <?php if ($images = fullfolio_get_images( TRUE )) { ?>

    <!-- post-images -->
    <div id="items" class="post-images">

	    <?php foreach ($images as $image) {

			$img = wp_get_attachment_image($image->ID, 'full'); ?>

			<!-- item -->
			<div class="item">
				<?php echo $img; ?>
			</div>
			<!-- /item -->

        <?php } ?>

    </div>
    <!-- /post-images -->

    <?php } ?>

    <?php comments_template(); ?>

<?php endwhile; else: ?>
<?php endif; ?>

</div>
<!-- /container -->

<!-- load more posts -->
<div class="load-more-container">
    <div style="display:none;"><?php posts_nav_link();// prevent required error (theme check plugin)?></div>
    <div class="load-prev"><i class="fa fa-angle-left" style="margin-right:8px;"></i><?php previous_post_link('%link', __( 'Previous', 'fullfolio' ));?></div>  
    <div class="load-next"><?php next_post_link('%link', __( 'Next', 'fullfolio' ));?><i class="fa fa-angle-right" style="margin-left:8px;"></i></div>   
</div>
<!-- /load more posts -->

<?php get_footer(); ?>


