<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>

<?php get_sidebar(); ?>
	
	<div class="page-top">
	<div class="page-bottom">
	<div id="content" class="narrowcolumn" role="main">
	<div class="paper-top">
	<div class="paper-bottom">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
		<h2><?php the_title(); ?></h2>
			<div class="entry">
				<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

			</div>
		</div>
		<?php endwhile; endif; ?>
	
	</div>
	</div>
	</div>
	</div>
	</div>

<?php get_footer(); ?>
