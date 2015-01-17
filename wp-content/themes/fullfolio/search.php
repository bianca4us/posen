<?php get_header(); ?>

<!-- title -->
<div class="title">
	<h3><?php echo __( 'Search: ', 'fullfolio' );?> <?php echo get_search_query(); ?></h3>
</div>
<!-- /title -->

<!-- container -->
<div id="items" class="container" style="margin-top:0;padding-bottom:30px;">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<!-- item -->
	<?php get_template_part( 'template', 'item' ); ?> 
	<!-- /item -->

<?php endwhile; else: ?>
<p class="sorry"><?php echo __('Sorry, no posts matched your criteria.', 'fullfolio' );?></p>
<?php endif; ?>

</div>
<!-- /container -->

<?php get_footer(); ?>


