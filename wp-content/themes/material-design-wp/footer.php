<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Material_Design_WP
 */

?>
<?php if(!is_page_template( 'blank-page.php' )): ?>
			</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- #content -->
    <?php get_template_part( 'footer-widget' ); ?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
            <div class="site-info">
                <a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'material-design-wp' ); ?>" rel="generator"><?php printf( esc_html( 'Proudly powered by %s', 'material-design-wp' ), 'WordPress' ); ?></a>
                <span class="sep"> | </span>
                <a class="credits" href="https://afterimagedesigns.com/material-design-wordpress-theme/" target="_blank" title="Material Design WP" alt="Material Design WP"><?php echo esc_html__('Material Design WP','material-design-wp') ?>
            </div><!-- close .site-info -->
		</div>
	</footer><!-- #colophon -->
<?php endif; ?>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
