<?php get_header(); ?>

		<div id="container">
			<div id="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header>
						<?php if ( is_front_page() ) { ?>
							<h2 class="entry-title"><?php the_title(); ?></h2>
						<?php } else { ?>
							<h1 class="entry-title"><?php the_title(); ?></h1>
						<?php } ?>
					</header>

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
						<?php //edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
					</div>
				</article>

				<?php comments_template( '', true ); ?>

<?php endwhile; ?>

			</div>
		</div>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
