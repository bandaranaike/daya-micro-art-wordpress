<?php
/**
 * About Section
 * 
 * @package Perfect_Portfolio_Pro
 */
$banner_layout = get_theme_mod( 'banner_layout', 'layout-one' );
$image_id      = sleek_portfolio_about_section_image_id();

if ( is_active_sidebar( 'about' ) ) { ?>
	<section id="about_section" class="about-section layout-four">
        <div class="image-holder">    
            <?php  echo wp_get_attachment_image( $image_id, 'sleek-portfolio-banner' ); ?>
        </div>
		<div class="tc-wrapper">
			<?php dynamic_sidebar( 'about' ); ?>
		</div>
	</section> <!-- .about-section -->
<?php }
