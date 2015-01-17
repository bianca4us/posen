<?php if ( is_active_sidebar( 'fullfolio-footer')) { ?>

        <!-- footer -->
        <footer>

            <?php dynamic_sidebar( 'fullfolio-footer' ); ?>

        </footer>
        <!-- /footer -->

<?php } ?> 

<?php
if(is_home())
{
if (function_exists (mypopup)) mypopup();
}
?>

<?php wp_footer(); ?>
</body>
</html>