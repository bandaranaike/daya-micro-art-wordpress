<?php

/**
 * Custom template tags for Fifty50
 * Eventually, some of the functionality here could be replaced by core features.
 * @package Fifty50
 * @since 1.0.0
 */

/* SIDE COLUMN
 @since 1.0.0
==================================================== */
if (!function_exists('fifty50_sidecolumn')) :
	function fifty50_sidecolumn()
	{
		echo 	'<div id="sidecolumn" class="sidecolumn"><div class="sidecolumn-inner"><header id="masthead" class="site-header" role="banner"><div class="site-identity">';
		fifty50_header_branding();
		fifty50_tagline('<div class="tagline">', '</div>');
		// Action hook for any content placed after the logo and tagline
		do_action('fifty50_after_tagline');
		echo	'</div></header></div></div>';
	}
endif;

/* SIDE COLUMN INTRO
 @since 1.0.0
==================================================== */
if (!function_exists('fifty50_tagline')) :
	function fifty50_tagline($before = '', $after = '')
	{
		$tagline = get_theme_mod('tagline');

		if ($tagline) {
			$tagline = wp_kses(
				$tagline,
				array(
					'a' => array(
						'href' => array(),
						'title' => array(),
						'target' => array()
					),
					'b'      => array(),
					'strong' => array(),
					'em'     => array(),
					'i'      => array(),
					'img' => array(
						'src' => array(),
						'alt' => array(),
						'title' => array()
					),
					'span' => array(),
					'br' => array(),
					'p'  => array()
				)
			);
		}

		if ($tagline || is_customize_preview()) {
			printf('%s%s%s', $before, $tagline, $after);
		}
	}
endif;


/* NAVIGATION MENUS
@since 1.0.0
==================================================== */
if (!function_exists('fifty50_menus')) :
	function fifty50_menus()
	{

		// Off Canvass menu
		$navbar = wp_nav_menu(
			array(
				'theme_location' => 'secondary',
				'menu_class'   => 'nav-menu',
				'fallback_cb'  => false,
				'container'    => false,
				'echo'         => false,
				'item_spacing' => 'discard',
				'link_before'  => '<span>',
				'link_after'   => '</span>',
			)
		);

		if ($navbar) {
			printf(
				'<nav class="navbar bg-light" aria-label="Light offcanvas navbar">
			<div class="container-fluid">
			<a class="navbar-brand" href="#"></a>
			<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbarLight" aria-controls="offcanvasNavbarLight">
				<span class="toggle-lines"><span class="toggle-line toggle-line--1"></span><span class="toggle-line toggle-line--2"></span><span class="toggle-line toggle-line--3"></span><span class="toggle-line toggle-line--4"></span></span>
			</button>
			<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbarLight" aria-labelledby="offcanvasNavbarLightLabel">
			<div class="offcanvas-header">
			  <h5 class="offcanvas-title" id="offcanvasNavbarLightLabel">%2$s</h5>
			  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="' . esc_attr__('Search', 'fifty50') . '"><i class="bi bi-x"></i></button>
			</div>
			<div class="offcanvas-body">%1$s			
			  <form  method="get" class="search-form" action="' . esc_url(home_url('/')) . '"><div class="search-wrap input-group">
				<input type="search" class="search-field" placeholder="' . esc_attr_x('Type keywords...', 'placeholder', 'fifty50') . '" value="' . get_search_query() . '" name="s" title="' . esc_attr_x('Search for:', '', 'fifty50') . '" aria-label="search" />
				<button class="btn btn-outline-success" type="submit"><span class="screen-reader-text">' . esc_html__('Search', 'fifty50') . '</span><i class="bi bi-search"></i></button>
			  </div></form>
			</div>
		  </div>				
		</div>
		</nav>',
				$navbar,
				get_bloginfo('name')
			);
		}

		// Top Menu
		$top_nav = wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'menu_class'   => 'nav-menu',
				'fallback_cb'  => false,
				'container'    => false,
				'echo'         => false,
				'item_spacing' => 'discard',
				'link_before'  => '<span>',
				'link_after'   => '</span>',
			)
		);

		if ($top_nav) {
			printf(
				'
          	<nav id="topnav" class="topnav">
		  
				<div class="topnav-header">
					<a href="#" id="topnav-toggle" class="topnav-toggle" title="%1$s">
						<span class="toggle-lines"><span class="toggle-line toggle-line--1"></span><span class="toggle-line toggle-line--2"></span><span class="toggle-line toggle-line--3"></span><span class="toggle-line toggle-line--4"></span></span>
					</a>
				</div>
            %2$s
          	</nav>',
				esc_html__('Menu', 'fifty50'),
				$top_nav,
			);
		}
	}
endif;


/* SITE BRANDING
@since 1.0.0
   ==================================================== */
if (!function_exists('fifty50_site_identity')) :
	function fifty50_site_identity()
	{

		if (has_custom_logo()) {
			the_custom_logo();
		}

		if (esc_attr(get_theme_mod('fifty50_show_site_title', 1))) {
			printf(
				'<%1$s id="site-title"><a href="%2$s" rel="home">%3$s</a></%1$s>',
				is_front_page() && is_home() ? 'h1' : 'p',
				esc_url(home_url('/')),
				esc_html(get_bloginfo('name'))
			);
		}
	}
endif;

/* HEADER BRANDING
@since 1.0.0
==================================================== */
if (!function_exists('fifty50_header_branding')) :
	function fifty50_header_branding()
	{

		$description  = get_bloginfo('description', 'display');

		echo '<div id="site-branding">';

		fifty50_site_identity();

		if ($description) {
			if (esc_attr(get_theme_mod('fifty50_show_site_desc', 1))) {
				echo '<p id="site-description">' . esc_html($description) . '</p>';
			}
			echo '</div>';
		}
	}
endif;

/* DISPLAY FEATURED or CATEGORY LABEL
@since 1.0.0
==================================================== */
if (!function_exists('fifty50_featured_category_badge')) {
	function fifty50_featured_category_badge()
	{
		$fifty50_featured_label_text = get_theme_mod('fifty50_featured_label_text', esc_html__('Featured', 'fifty50'));

		if (is_sticky() && is_home() && !is_paged()) {
			echo '<span class="featured-badge">' . wp_kses_post($fifty50_featured_label_text) . '</span>';
		} else {

			fifty50_first_category();
		}
	}
}

/* POST DATES
@since 1.0.0
==================================================== */
if (!function_exists('fifty50_posted_on')) :
	// Returns the post date
	function fifty50_posted_on()
	{

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if (get_the_time('U') !== get_the_modified_time('U')) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr(get_the_date(DATE_W3C)),
			esc_html(get_the_date()),
			esc_attr(get_the_modified_date(DATE_W3C)),
			esc_html(get_the_modified_date())
		);

		echo '<li class="publish-date"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a></li>';
	}
endif;

/* UPDATED POST DATE
@since 1.0.0
==================================================== */
if (!function_exists('fifty50_updated')) :
	function fifty50_updated()
	{
		printf(
			'<li class="posted-update">' .	esc_html__('Updated <span>%s</span>', 'fifty50') . '</li>',
			get_the_modified_date()
		);
	}
endif;


/* META AUTHOR INFO
@since 1.0.0
==================================================== */
if (!function_exists('fifty50_posted_by')) :
	function fifty50_posted_by()
	{
		printf(
			'<li class="byline"><span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span></li>',
			esc_url(get_author_posts_url(get_the_author_meta('ID'))),
			esc_html(get_the_author())
		);
	}
endif;

/* META COMMENT COUNT & LINK
@since 1.0.0
==================================================== */
if (!function_exists('fifty50_comment_link')) :
	function fifty50_comment_link()
	{
		if (!post_password_required() && (comments_open() || get_comments_number())) {
			echo '<li class="comments-link">';
			/* translators: %s: Name of current post. Only visible to screen readers. */
			comments_popup_link(sprintf(__('Make a comment <span class="screen-reader-text">on %s</span>', 'fifty50'), get_the_title()));

			echo '</li>';
		}
	}
endif;

/* META POST FORMAT
@since 1.0.0
==================================================== */
if (!function_exists('fifty50_post_format')) :
	// Returns the post date
	function fifty50_post_format()
	{

		$format = get_post_format();
		if (current_theme_supports('post-formats', $format)) {
			printf(
				'<li class="post-format"><a href="%1$s">%2$s</a></li>',

				esc_url(get_post_format_link($format)),
				esc_html(get_post_format_string($format))
			);
		}
	}
endif;

/* META EDIT LINK
@since 1.0.0
==================================================== */
if (!function_exists('fifty50_edit_link')) :
	function fifty50_edit_link()
	{
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				__('Edit Post<span class="screen-reader-text">%s</span>', 'fifty50'),
				get_the_title()
			),
			'<li class="edit-link"></li>'
		);
	}
endif;


/* ENTRY META DETAILS
@since 1.0.0
==================================================== */
if (!function_exists('fifty50_entry_meta')) :

	function fifty50_entry_meta()
	{

		echo '<ul class="entry-meta">';
		fifty50_post_format();
		fifty50_posted_on();
		fifty50_posted_by();
		fifty50_comment_link();
		if (!esc_attr(get_theme_mod('fifty50_hide_edit', 0))) {
			fifty50_edit_link();
		}

		echo '</ul>';
	}
endif;

/* ENTRY BOX META DETAILS
@since 1.0.0
==================================================== */
if (!function_exists('fifty50_box_meta_date')) :
	function fifty50_box_meta_date(
		$before = '',
		$after = '',
		$display_date = true,
		$simple_date = true
	) {
		if (!$post = get_post())
			return;

		$output = '';
		$post_type = get_post_type();

		if (in_array($post_type, array('post', 'attachment')) && $simple_date) {
			$time_string = sprintf('<time class="entry-date published updated" datetime="%1$s">%2$s</time>', esc_attr(get_the_date('c')), get_the_date('M j Y'));

			$output .= sprintf('<span class="posted-on box-meta">%s</span>', $time_string);
		}

		if ($output)
			printf('%s%s%s', $before, $output, $after);
	}
endif;

/* DISPLAY MINI SUMMARY POST META INFO
@since 1.0.0
==================================================== */
if (!function_exists('fifty50_entry_mini_meta')) :
	function fifty50_entry_mini_meta()
	{
		echo '<ul class="entry-meta">';
		fifty50_posted_on();
		echo '</ul>';
	}
endif;


/* POST THUMBNAILS
@since 1.0.0
==================================================== */
if (!function_exists('fifty50_post_thumbnail')) :
	function fifty50_post_thumbnail()
	{
		$thumbnail_caption = '';

		if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
			return;
		}

		$thumbnail_size = get_theme_mod('fifty50_thumbnail_size', 'default');

		$thumbnail_post = get_post(get_post_thumbnail_id());

		if ($thumbnail_post) {
			$thumbnail_caption = $thumbnail_post->post_excerpt;
		}

		// If the full post or a page
		if (is_singular()) :
?>

			<figure class="post-thumbnail<?php if ($thumbnail_caption) : ?> has-caption<?php endif; ?>">
				<?php the_post_thumbnail('post-thumbnail', array('class' => 'default-thumbnail', 'alt' => get_the_title())); ?>
			</figure><!-- .post-thumbnail -->

		<?php // If this is the blog
		else : ?>

			<figure class="post-thumbnail">
				<a class="post-thumbnail-link <?php if ($thumbnail_caption) : ?> has-caption<?php endif; ?>" href="<?php esc_url(the_permalink()); ?>" aria-hidden="true">
					<?php the_post_thumbnail('post-thumbnail', array('class' => 'default-thumbnail', 'alt' => get_the_title())); ?>
				</a>
			</figure>

<?php endif; // End is_singular()

		if ($thumbnail_caption && !is_search()) {
			printf('<div class="wp-caption-text post-thumbnail-caption">%s</div>', $thumbnail_caption);
		}
	}
endif;


/* BIO INFO
@since 1.0.0
==================================================== */
if (!function_exists('fifty50_bio_info')) :
	function fifty50_bio_info()
	{

		echo '<div class="author-info content-outer"><div class="content-inner"><div class="author-content">';
		printf('<div class="author-avatar">%s</div>', get_avatar(get_the_author_meta('user_email'), 100));
		echo '<div class="author-description"><div class="author-bio">';
		printf('<h3 class="author-heading section-title">%s</h3>', sprintf(esc_html__('Published by %s', 'fifty50'), get_the_author()));
		the_author_meta('description');
		echo '</div><a class="author-link" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '" rel="author">';
		printf(esc_html__('View all posts by %s &rarr;', 'fifty50'), get_the_author());
		echo '</a></div></div></div></div>';
	}
endif;


/* CATEGORY LIST
@since 1.0.0
==================================================== */
if (!function_exists('fifty50_post_categories')) :
	function fifty50_post_categories()
	{
		$categories_list = get_the_category_list(esc_attr_x(', ', 'Used between list items, there is a space after the comma.', 'fifty50'));
		if ($categories_list) {
			printf('<span class="post-cats">' . esc_html__('Categories: %1$s', 'fifty50') . '</span>', $categories_list);
		}
	}
endif;

/* DISPLAY POST TAGS
@since 1.0.0
==================================================== */
if (!function_exists('fifty50_post_tags')) :
	function fifty50_post_tags()
	{
		$tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'fifty50'));
		if ($tags_list) {
			/* translators: 1: list of tags. */
			printf('<div class="post-tags">' . esc_html__('Tags: %1$s', 'fifty50') . '</div>', $tags_list);
		}
	}
endif;

/* POST FOOTER
@since 1.0.0
==================================================== */
if (!function_exists('fifty50_entry_footer')) :
	function fifty50_entry_footer()
	{

		echo '<footer class="entry-footer">';

		// Post categories
		if (!esc_attr(get_theme_mod('fifty50_hide_post_category_tags', 0))) {
			fifty50_post_categories();
		}
		// Post tags
		if (!esc_attr(get_theme_mod('fifty50_hide_post_tags', 0))) {
			fifty50_post_tags();
		}

		echo '</footer>';
	}
endif;


/* DISPLAY A SINGLE POST CATEGORY
@since 1.0.0
==================================================== */
if (!function_exists('fifty50_first_category')) :
	function fifty50_first_category()
	{
		$category = get_the_category();
		$first_category = $category[0];
		echo sprintf(
			'<span class="category-badge"><a href="%s">%s</a></span>',
			get_category_link($first_category),
			$first_category->name
		); // phpcs:ignore WordPress.Security.EscapeOutput
	}
endif;



/* BLOG  NAVIGATION
Navigation for the blog
@since 1.0.0
==================================================== */
if (!function_exists('fifty50_paging_nav')) :
	function fifty50_paging_nav()
	{
		the_posts_pagination(array(
			'prev_text'          => is_rtl() ? '<i class="bi bi-caret-right-fill"></i>' : '<i class="bi bi-caret-left-fill"></i>',
			'next_text'          =>  is_rtl() ? '<i class="bi bi-caret-left-fill"></i>' : '<i class="bi bi-caret-right-fill"></i>',
			'before_page_number' => ''
		));
	}
endif;


/* POST NAVIGATION
Navigation for full posts.
@since 1.0.0
==================================================== */
if (!function_exists('fifty50_post_pagination')) :
	function fifty50_post_pagination()
	{

		the_post_navigation(array(
			'next_text' => '<span class="nav-meta">' . (is_singular('post') ? esc_html__('Next post', 'fifty50') : esc_html__('Next', 'fifty50')) . '</span> <span class="post-title">%title</span>',
			'prev_text' => '<span class="nav-meta">' . (is_singular('post') ? esc_html__('Previous post', 'fifty50') : esc_html__('Previous', 'fifty50')) . '</span> <span class="post-title">%title</span>',
		));
	}
endif;


/* MULTIPAGE NAVIGATION
Navigation for splitting posts or pages into more than one page.
@since 1.0.0
==================================================== */
if (!function_exists('fifty50_multipage_pagination')) :
	function fifty50_multipage_pagination()
	{

		wp_link_pages(array(
			'before'      => '<div class="multi-page-links"><span class="multi-page-links-title">' . esc_html__('Pages:', 'fifty50') . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '%',
			'separator'   => false,
		));
	}
endif;
