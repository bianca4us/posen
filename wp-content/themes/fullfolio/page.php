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
                </div>

                <div class="col2">
                    <?php the_content();?>
                </div>

            <?php } else { ?>

                <div class="col1">

                    <h2 class="col1-page-title"><?php the_title();?></h2>
                    <?php the_content();?>

                </div>

            <?php }

        ?>

    </div>
    <!-- content -->

    <!-- comments -->
    <div class="content">
    <?php comments_template(); ?>
    </div>
    <!-- /comments -->

<?php endwhile; else: ?>
<?php endif; ?>

</div>
<!-- /container -->

<?php get_footer(); ?>


