<?php get_header(); ?>

<?php if(have_posts()): ?>
	
	<?php while(have_posts()): the_post(); ?>
		<?php get_template_part('content', get_post_format()); ?>
	<?php endwhile; ?>
	
	<div class="paging row">
		<div class="paging-prev alignleft"><?php next_posts_link('&larr; Older'); ?></div>
		<div class="paging-next alignright"><?php previous_posts_link('Newer &rarr;'); ?></div>
	</div>

<?php endif; ?>

<?php get_footer(); ?>