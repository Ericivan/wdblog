<?php get_header();?>
<div id="primary" class="site-content container">
<header class="single-header">
<h1 class="single-title"><?php printf( __( '搜索关键词为: %s', 'xiaoshou' ), get_search_query() ); ?> </h1>
<div class="des"><b><?php global $wp_query; echo $wp_query->found_posts; ?></b>条结果</div>
</header>
 <div class="content-ajax">
<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'content', get_post_format() ); ?>
<?php endwhile; ?>
<?php else : ?>
<div class="entry-site">
<p>目前还没有文章！</p>
<h2>加我QQ448696976，我可能会帮到你</h2>
</div>
<?php endif; ?>
</div>
<nav class="pagenav col-md-12 hidden-sm hidden-md hidden-lg"><?php next_posts_link(__('点击更多')); ?></nav>
</div>
<?php pagenavi(); ?>
<?php get_footer();?>