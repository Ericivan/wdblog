<?php
function mytheme_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	//主评论计数器初始化 begin - by zwwooooo
global $commentcount;
$page = ( !empty($in_comment_loop) ) ? get_query_var('cpage') : get_page_of_comment( $comment->comment_ID, $args );//zww
$cpp=get_option('comments_per_page');//获取每页评论显示数量
if(!$commentcount) { //初始化楼层计数器
if ($page > 1) {
$commentcount = $cpp * ($page - 1);
} else {
$commentcount = 0;//如果评论还没有分页，初始值为0
}
}
//主评论计数器初始化 end - by zwwooooo
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<div id="anchor"><div id="comment-<?php comment_ID() ?>"></div></div>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php echo get_avatar( $comment, 50 ); ?>
		<!--<?php printf( __( '<cite class="fn">%s</cite> <span class="says">:</span>' ), get_comment_author_link() ); ?>-->
		<strong class="fn"><?php commentauthor(); ?></strong>
		<span class="comment-meta commentmetadata">
			<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"></a>
			<span class="comment-aux">
				<?php printf( __('%1$s at %2$s'), get_comment_date( 'Y年m月d日' ),  get_comment_time() ); ?>
				<?php
					if ( is_user_logged_in() ) {
						$url = get_bloginfo('url');
						echo '<a id="delete-'. $comment->comment_ID .'" href="' . wp_nonce_url("$url/wp-admin/comment.php?action=deletecomment&amp;p=" . $comment->comment_post_ID . '&amp;c=' . $comment->comment_ID, 'delete-comment_' . $comment->comment_ID) . '" >&nbsp;删除</a>';
					}
				?>
				<?php edit_comment_link( '编辑' , '&nbsp;', '' ); ?>
			</span>
			<span class="reply">&nbsp;<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></span>
		</span>
	</div>
	<?php comment_text(); ?>
	<?php if ( $comment->comment_approved == '0' ) : ?>
		<div class="comment-awaiting-moderation">您的评论正在等待审核！</div>
	<?php endif; ?>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<div class="floor"><!-- 主评论楼层号 by zwwooooo -->
<?php if(!$parent_id = $comment->comment_parent) {printf('%1$s',++$commentcount); echo"楼";} ?><!-- 当前页每个主评论自动+1 --><!-- 当前页每个主评论自动+1 --></div>
	<?php endif; ?>
<?php
}