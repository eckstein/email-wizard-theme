<?php get_header(); ?>
<div class="content-area">
    

    <main class="site-main">
        <?php if ( have_posts() ) :
			while ( have_posts() ) :
				the_post(); ?>
				<?php get_template_part( 'entry' ); // Post format  ?>
			<?php endwhile; endif; ?>
		<?php get_template_part( 'nav', 'below' ); // Pagination  ?>
	</main>
    <aside class="sidebar">
        <?php get_sidebar(); ?>
    </aside>
</div>



<?php get_footer(); ?>