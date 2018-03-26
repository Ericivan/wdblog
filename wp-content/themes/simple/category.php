<?php get_header();?>
<div id="primary" class="site-content container">
<header class="single-header">
<h1 class="single-title"><?php single_cat_title('<small>分类:</small>'); ?></h1>
</header>
 <div class="content-ajax">
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