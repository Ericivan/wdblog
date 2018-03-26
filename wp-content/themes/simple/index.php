<?php get_header();?>
<div id="primary" class="site-content container">
 <div class="content-ajax">
  <?php if ( !is_paged() ) { ?>
		<?php if ( is_sticky() ) { ?><?php get_template_part( 'inc/sticky' ); ?><?php } ?>
	<?php } ?>
	<?php
		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
		$sticky = get_option( 'sticky_posts' );
		$args = array(
			'cat' => get_option('cx_cat_s'),
			'post__not_in' => $sticky,
			'paged' => $paged
		);
		query_posts( $args );
 	?>
<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'content', get_post_format() ); ?>
<?php endwhile; ?>
<?php else : ?>
<section class="content">
<p>目前还没有文章！</p>
<p><a href="<?php echo get_option('siteurl'); ?>/wp-admin/post-new.php">点击这里发布您的第一篇文章</a></p>
</section>
<?php endif; ?>
</div>
<nav class="pagenav col-md-12 hidden-sm hidden-md hidden-lg"><?php next_posts_link(__('点击更多')); ?></nav>
</div>
<?php pagenavi(); ?>
<?php get_footer();?>