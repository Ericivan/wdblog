<?php get_header();?>
<div id="primary" class="site-content container">
<header class="single-header">
<h1 class="single-title"><?php the_author(); ?></h1>
<p><?php the_author_description(); ?></p>
</header>
<div class="row">
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
<?php pagenavi(); ?>
</div>
</div>
<?php get_footer();?>