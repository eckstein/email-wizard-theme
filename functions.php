<?php
add_action( 'after_setup_theme', 'emailwizard_theme_setup' );
function emailwizard_theme_setup() {
	load_theme_textdomain( 'emailwizard_theme_theme', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'navigation-widgets' ) );
	global $content_width;
	if ( ! isset ( $content_width ) ) {
		$content_width = 1920;
	}
	register_nav_menus( array( 'user-menu' => esc_html__( 'User Menu', 'emailwizard_theme_theme' ) ) );
	register_nav_menus( array( 'content-menu' => esc_html__( 'Content Menu', 'emailwizard_theme_theme' ) ) );
}

add_action( 'wp_enqueue_scripts', 'emailwizard_theme_enqueue' );
function emailwizard_theme_enqueue() {
	wp_enqueue_style( 'emailwizard_theme-style', get_stylesheet_uri() );
	wp_enqueue_script( 'jquery' );
}

// Custom fonts
add_action('wp_head', 'emailwizard_theme_fonts');
function emailwizard_theme_fonts() {
  ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Andika:ital,wght@0,400;0,700;1,400;1,700&display=swap"
	rel="stylesheet">
  <?php
}

add_action( 'wp_footer', 'emailwizard_theme_footer' );
function emailwizard_theme_footer() {
	?>
	<script>
		jQuery(document).ready(function ($) {
			var deviceAgent = navigator.userAgent.toLowerCase();
			if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
				$("html").addClass("ios");
				$("html").addClass("mobile");
			}
			if (deviceAgent.match(/(Android)/)) {
				$("html").addClass("android");
				$("html").addClass("mobile");
			}
			if (navigator.userAgent.search("MSIE") >= 0) {
				$("html").addClass("ie");
			}
			else if (navigator.userAgent.search("Chrome") >= 0) {
				$("html").addClass("chrome");
			}
			else if (navigator.userAgent.search("Firefox") >= 0) {
				$("html").addClass("firefox");
			}
			else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
				$("html").addClass("safari");
			}
			else if (navigator.userAgent.search("Opera") >= 0) {
				$("html").addClass("opera");
			}
		});
	</script>
	<?php
}
add_filter( 'document_title_separator', 'emailwizard_theme_document_title_separator' );
function emailwizard_theme_document_title_separator( $sep ) {
	$sep = esc_html( '|' );
	return $sep;
}
add_filter( 'the_title', 'emailwizard_theme_title' );
function emailwizard_theme_title( $title ) {
	if ( $title == '' ) {
		return esc_html( '...' );
	} else {
		return wp_kses_post( $title );
	}
}
function emailwizard_theme_schema_type() {
	$schema = 'https://schema.org/';
	if ( is_single() ) {
		$type = "Article";
	} elseif ( is_author() ) {
		$type = 'ProfilePage';
	} elseif ( is_search() ) {
		$type = 'SearchResultsPage';
	} else {
		$type = 'WebPage';
	}
	echo 'itemscope itemtype="' . esc_url( $schema ) . esc_attr( $type ) . '"';
}
add_filter( 'nav_menu_link_attributes', 'emailwizard_theme_schema_url', 10 );
function emailwizard_theme_schema_url( $atts ) {
	$atts['itemprop'] = 'url';
	return $atts;
}
if ( ! function_exists( 'emailwizard_theme_wp_body_open' ) ) {
	function emailwizard_theme_wp_body_open() {
		do_action( 'wp_body_open' );
	}
}
add_action( 'wp_body_open', 'emailwizard_theme_skip_link', 5 );
function emailwizard_theme_skip_link() {
	echo '<a href="#content" class="skip-link screen-reader-text">' . esc_html__( 'Skip to the content', 'emailwizard_theme_theme' ) . '</a>';
}
add_filter( 'the_content_more_link', 'emailwizard_theme_read_more_link' );
function emailwizard_theme_read_more_link() {
	if ( ! is_admin() ) {
		return ' <a href="' . esc_url( get_permalink() ) . '" class="more-link">' . sprintf( __( '...%s', 'emailwizard_theme_theme' ), '<span class="screen-reader-text">  ' . esc_html( get_the_title() ) . '</span>' ) . '</a>';
	}
}
add_filter( 'excerpt_more', 'emailwizard_theme_excerpt_read_more_link' );
function emailwizard_theme_excerpt_read_more_link( $more ) {
	if ( ! is_admin() ) {
		global $post;
		return ' <a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="more-link">' . sprintf( __( '...%s', 'emailwizard_theme_theme' ), '<span class="screen-reader-text">  ' . esc_html( get_the_title() ) . '</span>' ) . '</a>';
	}
}
add_filter( 'big_image_size_threshold', '__return_false' );
add_filter( 'intermediate_image_sizes_advanced', 'emailwizard_theme_image_insert_override' );
function emailwizard_theme_image_insert_override( $sizes ) {
	unset( $sizes['medium_large'] );
	unset( $sizes['1536x1536'] );
	unset( $sizes['2048x2048'] );
	return $sizes;
}
add_action( 'widgets_init', 'emailwizard_theme_widgets_init' );
function emailwizard_theme_widgets_init() {
	register_sidebar( array(
		'name' => esc_html__( 'Sidebar Widget Area', 'emailwizard_theme_theme' ),
		'id' => 'primary-widget-area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'wp_head', 'emailwizard_theme_pingback_header' );
function emailwizard_theme_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'comment_form_before', 'emailwizard_theme_enqueue_comment_reply_script' );
function emailwizard_theme_enqueue_comment_reply_script() {
	if ( get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
function emailwizard_theme_custom_pings( $comment ) {
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<?php echo esc_url( comment_author_link() ); ?>
	</li>
	<?php
}
add_filter( 'get_comments_number', 'emailwizard_theme_comment_count', 0 );
function emailwizard_theme_comment_count( $count ) {
	if ( ! is_admin() ) {
		global $id;
		$get_comments = get_comments( 'status=approve&post_id=' . $id );
		$comments_by_type = separate_comments( $get_comments );
		return count( $comments_by_type['comment'] );
	} else {
		return $count;
	}
}

// Require theme customizer
require_once get_template_directory() . '/customizer.php';
