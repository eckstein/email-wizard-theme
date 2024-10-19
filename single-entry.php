<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header>
		<?php
		echo '<h1 class="entry-title" itemprop="headline">';
		the_title();
		echo '</h1>';

		get_template_part( 'entry', 'meta' );

		get_template_part( 'entry-content' );
        
		get_template_part( 'entry-footer' );
		?>
	</header>	
</article>