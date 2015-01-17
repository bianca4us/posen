	<?php

        $cats = get_the_category();
        $arr = array();

        foreach ($cats as $cat) {

        	array_push($arr, $cat->name);

        }

        $cats_arr = implode(', ', $arr);

    ?>

	<div id="post-<?php the_ID(); ?>" <?php post_class('item'); ?>>

		<a href="<?php the_permalink();?>">

			<?php if ( has_post_thumbnail() ) { ?>

				<?php the_post_thumbnail('fullfolio-thumb'); ?>
				<div class="mask">
					<div class="mask-content">
						<h2><?php the_title();?></h2>
						<p class="date-item"><?php the_time(get_option('date_format')); ?></p>
						<p><?php echo $cats_arr;?></p>
					</div>
				</div>

			<?php } else { ?>

				<div class="item-no-thumbnail">
					<h2><?php the_title();?></h2>
					<p class="date-item"><?php the_time(get_option('date_format')); ?></p>
					<p><?php echo $cats_arr;?></p>
				</div>

			<?php } ?>

		</a>
		
	</div>