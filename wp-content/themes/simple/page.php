<?php get_header();?>
<div id="primary" class="site-content container">
<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'content', get_post_format() ); ?>
<?php endwhile; ?>
<?php else : ?>
<section class="content">
<p>目前还没有文章！</p>
</section>
<?php endif; ?>
</div>
 <?php get_footer();?>