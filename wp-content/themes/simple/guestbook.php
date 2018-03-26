<?php
/*
Template Name: 关于我
*/
?>
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
<div id='readerswall'>
<?php
  global $wpdb;
  $counts = wp_cache_get( 'ludou_mostactive' );

  if ( false === $counts ) {
    $counts = $wpdb->get_results("SELECT COUNT(comment_author) AS cnt, comment_author, comment_author_url, comment_author_email
        FROM {$wpdb->prefix}comments
        WHERE comment_date > date_sub( NOW(), INTERVAL 1 MONTH ) 
            AND comment_approved = '1' 
            AND comment_author_email != '448696976@qq.com'
            AND comment_author_url != ''
            AND comment_type = ''
            AND user_id = '0'
        GROUP BY comment_author_email
        ORDER BY cnt DESC
        LIMIT 30");
  }

  $mostactive = '';

  if ( $counts ) {
    wp_cache_set( 'ludou_mostactive', $counts );

    foreach ($counts as $count)if (no_gravatar($count->comment_author_email)) { {
      $c_url = $count->comment_author_url;
      $mostactive .=  '<a href="'. $c_url . '" title="' . $count->comment_author .' 发表 '. $count->cnt . ' 条评论" target="_blank" rel="external nofollow">' . get_avatar($count->comment_author_email, 70, '', $count->comment_author . ' 发表 ' . $count->cnt . ' 条评论') . 
	 '<span>'.$count->comment_author.'</span>' .'</a>';
    }}
  echo $mostactive;
  } 
?>
</div> <!-- / hotfriends -->
<?php comments_template( '', true ); ?>
</div>
<style type="text/css">
#readerswall{overflow: hidden;margin-top: -4em;}
#readerswall a{
position: relative;
float: left;
padding: 5px 23px;
margin-bottom: 50px;
text-align: center;
list-style: none!important;
color: #626773;
overflow: hidden;
width: 116px;
white-space: nowrap;
text-overflow: ellipsis;
}
#readerswall a img{
position: relative;
border-radius: 50%;
margin-bottom: 15px;
display: block;
}
</style>
<?php get_footer();?>