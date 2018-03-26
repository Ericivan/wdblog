<?php if ( is_home() || is_category() || is_search() || is_tag() || is_month() || is_author() || is_day() || is_month() || is_year() ) : ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<section class="content">
		<header class="post-meta no-img">
		<div class="date">
					<span class="month"><?php the_time('F'); ?> </span>
					<span class="day"><?php the_time('d'); ?> </span>
										
				</div>
				<?php If (in_array( 'wp-zan/wp-zan.php',
apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){?><?php  wp_zan();?><?php };?>
		</header>
		<!-- .entry-header -->
		<div class="entry-content">
		<div class="entry-header">
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<div class="entry-meta">
		    <span class="author fa fa-user fa-1"> <?php the_author_posts_link(); ?></span>
			<span class="cat fa fa-folder-open fa-1"><?php the_category( ', ' ) ?></span>
			<span class="fa fa-comment fa-1"><?php comments_popup_link( '沙发', '评论 1 条', '评论 % 条' ); ?></span>
			<?php If (in_array( 'wp-postviews/wp-postviews.php',
apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){?>
			<span class="fa fa-eye fa-1"><a href="javascript:void(0);"><?php the_views();?></a></span><?php };?>
			<?php edit_post_link( '<span class="edit"><i class="icon-edit"></i>编辑', ' ', '</span>'); ?>
			
		</div></div>
		<div class="entry-site"> <?php the_excerpt() ?></div>
				<div class="entry-more"><a href="<?php the_permalink(); ?>" rel="bookmark" >阅读全文</a></div>
	
			<!-- .entry-meta -->
		</div>
		<!-- .entry-content -->
	</section>
	<!-- #content -->
</article>
<?php endif; ?>
<?php if ( is_single() ) : ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="single-header">
		<h1 class="single-title"><?php the_title(); ?></h1>
		<div class="single-meta">
			<span class="fa fa-user fa-1"> <?php the_author_posts_link(); ?></span>
			<span class="cat fa fa-folder-open fa-1"><?php the_category( ', ' ) ?></span>
			<span class="fa fa-comment fa-1"><?php comments_popup_link( '沙发', '评论 1 条', '评论 % 条' ); ?></span>
				<?php If (in_array( 'wp-postviews/wp-postviews.php',
apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){?>
			<span class="fa fa-eye fa-1"><a href="javascript:void(0);"><?php the_views();?></a></span><?php };?>
			
			<?php edit_post_link( '<span class="edit"><i class="icon-edit"></i>编辑', ' ', '</span>'); ?>
			<span class="time"><?php If (in_array( 'wp-zan/wp-zan.php',
apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){?><?php wp_zan();?><?php };?><?php the_time('M月 j日, Y'); ?></span>
		</div>
		<!-- .entry-meta -->
	</header>
	<!-- .single-header -->

	<div class="single-main">
		<?php the_content(); ?>
		<div class="post-tags"><h4>Tags: </h4><?php the_tags('','',''); ?></div>
		<?php if (get_option('cx_share') == 'true') { ?>
					<?php get_template_part( 'inc/share' ); ?>
			
			<?php } ?>
		
	</div>
	<!-- .single-content -->
</article>
<?php endif; ?>
<?php if ( is_page() ) : ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="single-header">
		<h1 class="single-title"><?php the_title(); ?></h1>
		<!-- .entry-meta -->
	</header>
	<!-- .single-header -->

	<div class="single-main">
		<?php the_content(); ?>
	</div>
	<!-- .single-content -->
</article>
<?php endif; ?>
