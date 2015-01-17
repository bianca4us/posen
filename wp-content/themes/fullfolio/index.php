<?php get_header(); ?>

<!-- container -->
<div id="items" class="container container-home">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<!-- item -->
	<?php get_template_part( 'template', 'item' ); ?> 
	<!-- /item -->

<?php endwhile; else: ?>
<?php endif; ?>

</div>
<!-- /container -->

<!-- load more posts -->
<div class="load-more-container">
	<div style="display:none;"><?php wp_link_pages();// prevent required error (theme check plugin)?></div>
	<a class="load_more" data-nonce="<?php echo wp_create_nonce('load_posts') ?>" href="#"><?php echo __( 'Load more', 'fullfolio' );?><span class="plus"><i class="fa fa-plus"></i></span></a>
</div>
<!-- /load more posts -->

<?php get_footer(); ?>


