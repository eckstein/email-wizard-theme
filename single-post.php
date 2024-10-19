<?php get_header(); ?>
<div class="content-area">
	<main class="site-main">
		<?php if ( have_posts() ) :
			while ( have_posts() ) :
				the_post(); ?>
				<?php get_template_part( 'single', 'entry' ); ?>
				<?php if ( comments_open() && ! post_password_required() ) {
					comments_template( '', true );
				} ?>
			<?php endwhile; endif; ?>
		<footer class="footer">
			<?php get_template_part( 'nav', 'below-single' ); ?>
		</footer>
	</main>
	<aside class="sidebar">
		<?php get_sidebar(); ?>
	</aside>
</div>
<?php get_footer(); ?>