<?php if ( post_password_required() ) { return; }?>

<!-- comments -->
<div id="comments" class="comments-area">

  <?php if ( have_comments() ) : ?>

    <!-- comments title -->
    <h3 class="comments-title">
      <?php printf( _n( 'One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'fullfolio' ),number_format_i18n( get_comments_number() ), get_the_title() );?>
    </h3>
    <!-- /comments title -->

    <!-- comments list -->
    <ul class="comment-list" id="items">
      <?php
        wp_list_comments( array(
          'style'      => 'ul',
          'short_ping' => true,
          'avatar_size'=> 34,
        ) );
      ?>
    </ul>
    <!-- /comments list -->

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
      <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
        <h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'fullfolio' ); ?></h1>
        <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'fullfolio' ) ); ?></div>
        <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'fullfolio' ) ); ?></div>
      </nav>
    <?php endif;?>

    <?php if ( ! comments_open() ) : ?>
      <p class="no-comments"><?php _e( 'Comments are closed.', 'fullfolio' ); ?></p>
    <?php endif; ?>

  <?php endif; ?>

  <div class="comment-form">
    <?php comment_form(); ?>
  </div>

</div>
<!-- /comments -->
