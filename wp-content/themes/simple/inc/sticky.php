<div id="sticky">
	<?php
		$args = array(
			'posts_per_page' => 1,
			'post__in'  => get_option( 'sticky_posts' ),
			'ignore_sticky_posts' => 1
		);
		query_posts($args);
	?>
	<?php while (have_posts()) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
         	<section class="content">
		<header class="post-meta no-img">
		<div class="date">
					<span class="month"><?php the_time('F'); ?> </span>
					<span class="day"><?php the_time('d'); ?> </span>
										
				</div>
				<?php If (in_array( 'wp-zan/wp-zan.php',
apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){?><?php  wp_zan();?><?php };?>
<div style="text-align: center;color: #00b1a7;">【置顶】</div>
		</header>
		<!-- .entry-header -->
		<div class="entry-content">
		<div class="entry-header">
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<div class="entry-meta">
		    <span class="author fa fa-user fa-1"> <?php the_author_posts_link(); ?></span>
			<span class="cat fa fa-folder-open fa-1"><?php the_category( ', ' ) ?></span>
			<span class="fa fa-comment fa-1"><?php comments_popup_link( '沙发', '评论 1 条', '评论 % 条' ); ?></span>
			<span class="fa fa-eye fa-1"><a href="javascript:void(0);"><?php the_views();?></a></span>
			<?php edit_post_link( '<span class="edit"><i class="icon-edit"></i>编辑', ' ', '</span>'); ?>
			
		</div></div>
		<div class="entry-site"> <?php the_excerpt() ?></div>
				<div class="entry-more"><a href="<?php the_permalink(); ?>" rel="bookmark" >阅读全文</a></div>
	
			<!-- .entry-meta -->
		</div>
		<!-- .entry-content -->
	</section>
            </article>
	<?php endwhile; ?>
	<?php wp_reset_query(); ?>
</div>