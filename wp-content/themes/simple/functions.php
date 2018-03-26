<?php 
// 加载前端脚本及样式
function ality_scripts() {
wp_enqueue_style( 'style', get_stylesheet_uri(), array(), '2014.9.21' );
//wp_enqueue_style( 'bootstrap',get_template_directory_uri() . '/css/bootstrap.css', array(), '1.0' );
wp_enqueue_style( 'responsive-nav',get_template_directory_uri() . '/css/responsive-nav.css', array(), '1.0' );
wp_enqueue_style( 'font-awesome.min',get_template_directory_uri() . '/css/font-awesome.min.css', array(), '1.0' );
wp_enqueue_script( 'responsive-nav', get_template_directory_uri() . '/js/responsive-nav.js', array(), '1.0', false );
wp_enqueue_script( 'jquery.fancybox', get_template_directory_uri() . '/js/jquery.fancybox.js', array(), '2.15', false);
wp_enqueue_script( 'mousewheel', get_template_directory_uri() . '/js/jquery.mousewheel-3.0.6.pack.js', array(), '1.0', false );
wp_enqueue_script( 'script', get_template_directory_uri() . '/js/custom.js', array(), '1.0', false );
if ( is_singular() ) {
		wp_localize_script( 'script', 'wpl_ajax_url', admin_url() . "admin-ajax.php");
		 wp_enqueue_script( 'comments-ajax', get_template_directory_uri() . '/js/comments-ajax.js', array(), '1.3', false);
		wp_enqueue_style( 'fancybox',get_template_directory_uri() . '/css/jquery.fancybox.css', array(), '1.0' );
		wp_enqueue_style( 'fancybox-buttons',get_template_directory_uri() . '/js/helpers/jquery.fancybox-buttons.css', array(), '1.0' );
		wp_enqueue_script( 'fancybox-buttons', get_template_directory_uri() . '/js/helpers/jquery.fancybox-buttons.js', array(), '2.15', false);
       
	}
}
add_action( 'wp_enqueue_scripts', 'ality_scripts' );
// 文章形式
add_theme_support( 'post-formats', array(
	'aside', 'image',
) );
// 移除头部冗余代码
remove_action( 'wp_head', 'wp_generator' );// WP版本信息
remove_action( 'wp_head', 'rsd_link' );// 离线编辑器接口
remove_action( 'wp_head', 'wlwmanifest_link' );// 同上
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );// 上下文章的url
remove_action( 'wp_head', 'feed_links', 2 );// 文章和评论feed
remove_action( 'wp_head', 'feed_links_extra', 3 );// 去除评论feed
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );// 短链接

//取消默认相册样式
add_filter('use_default_gallery_style', '__return_false' );
remove_shortcode('gallery');
add_shortcode('gallery', 'custom_size_gallery');
function custom_size_gallery($attr) {
	$attr['size'] = 'medium';
	return gallery_shortcode($attr);
}
// 评论通知
require get_template_directory() . '/inc/functions/notify.php';
// 分页
require get_template_directory() . '/inc/functions/pagenavi.php';
// 评论模板
require get_template_directory() . '/inc/functions/comment-template.php';
// 友情链接
add_filter( 'pre_option_link_manager_enabled', '__return_true' );
// 评论链接新窗口
function commentauthor($comment_ID = 0) {
    $url    = get_comment_author_url( $comment_ID );
    $author = get_comment_author( $comment_ID );
    if ( empty( $url ) || 'http://' == $url )
		echo $author;
    else
		echo "<a href='$url' rel='external nofollow' target='_blank' class='url'>$author</a>";
}
// 禁用工具栏
show_admin_bar(false);

// 评论添加@，by Ludou
function ludou_comment_add_at( $comment_text, $comment = '') {
  if( $comment->comment_parent > 0) {
    $comment_text = '@<a href="#comment-' . $comment->comment_parent . '">'.get_comment_author( $comment->comment_parent ) . '</a> ' . $comment_text;
  }

  return $comment_text;
}
add_filter( 'comment_text' , 'ludou_comment_add_at', 20, 2);

//摘要支持HTML
function get_excerpt($excerpt){
$content = get_the_content();
$content = strip_tags($content,'<img><h2><ul><ol><li><strong><h3><blockquote><strong>');
$content = mb_strimwidth($content,0,600,'...');
return wpautop($content);
}
add_filter('the_excerpt','get_excerpt');
// 默认菜单
function default_menu() {
require get_template_directory() . '/inc/default-menu.php';
}
// 自定义菜单
register_nav_menus(
   array(
      'header-menu' => __( '顶部菜单' ),
      'footer-menu' => __( '底部菜单' ),
      'mini-menu' => __( '移动版菜单' )
   )
);
// 主题设置
require get_template_directory() . '/inc/theme-options.php';
require get_template_directory() . '/inc/guide.php';

//高亮显示搜索词
function search_word_replace($buffer){
    if(is_search()){
        $arr = explode(" ", get_search_query());
        $arr = array_unique($arr);
        foreach($arr as $v)
            if($v)
                $buffer = preg_replace("/(".$v.")/i", "<span style=\"color: #ff8598;;\"><strong>$1</strong></span>", $buffer);
    }
    return $buffer;
}
add_filter("the_title", "search_word_replace", 200);
add_filter("the_excerpt", "search_word_replace", 200);
add_filter("the_content", "search_word_replace", 200);
function emtx_excerpt_length( $length ) {
	return 200; //把92改为你需要的字数，具体就看你的模板怎么显示了。
}
add_filter( 'excerpt_length', 'emtx_excerpt_length' );

//多说头像
function mytheme_get_avatar($avatar) {
    $avatar = str_replace(array("www.gravatar.com","0.gravatar.com","1.gravatar.com","2.gravatar.com"),"gravatar.duoshuo.com",$avatar);
    return $avatar;
}
add_filter( 'get_avatar', 'mytheme_get_avatar', 10, 3 );
add_theme_support( 'post-thumbnails' );
remove_action('pre_post_update', 'wp_save_post_revision'); 
add_action('wp_print_scripts', 'disable_autosave'); 
function 
disable_autosave() { wp_dereGISter_script('autosave'); 
}
function ashuwp_remove_open_sans() {
    wp_deregister_style( 'open-sans' );
    wp_register_style( 'open-sans', false );
    wp_enqueue_style('open-sans','');
}
add_action('init','ashuwp_remove_open_sans');
//标签下拉
function dropdown_tag_cloud( $args = '' ) {
    $defaults = array(
        'smallest' => 8, 'largest' => 22, 'unit' => 'pt', 'number' => 45,
        'format' => 'flat', 'orderby' => 'name', 'order' => 'ASC',
        'exclude' => '', 'include' => ''
    );
    $args = wp_parse_args( $args, $defaults );
    $tags = get_tags( array_merge($args,
array('orderby' => 'count', 'order' => 'DESC')) ); // Always query top tags
    if ( empty($tags) )
        return;
    $return = dropdown_generate_tag_cloud( $tags, $args );
// Here's where those top tags get sorted according to $args
    if ( is_wp_error( $return ) )
        return false;
    else
        echo apply_filters( 'dropdown_tag_cloud', $return, $args );
}
function kratos_admin_footer_text($text) {
       $text = '<span id="footer-thankyou">感谢使用 <a href=http://cn.wordpress.org/ target="_blank">WordPress</a>进行创作，并使用 <a href="http://www.seo628.com" target="_blank" style="font-size: 16px;color: red;">小兽SEO</a>主题样式，<a class="qq" rel="nofollow" target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=448696976&amp;site=qq&amp;menu=yes" title="QQ咨询" style="font-size: 16px;color: red;">点击</a> 咨询问题。</span>';
    return $text;
}
add_filter('admin_footer_text', 'kratos_admin_footer_text',1);
function dropdown_generate_tag_cloud( $tags, $args = '' ) {
    global $wp_rewrite;
    $defaults = array(
        'smallest' => 8, 'largest' => 22, 'unit' => 'pt', 'number' => 45,
        'format' => 'flat', 'orderby' => 'name', 'order' => 'ASC'
    );
    $args = wp_parse_args( $args, $defaults );
    extract($args);
    if ( !$tags )
        return;
    $counts = $tag_links = array();
    foreach ( (array) $tags as $tag ) {
        $counts[$tag->name] = $tag->count;
        $tag_links[$tag->name] = get_tag_link( $tag->term_id );
        if ( is_wp_error( $tag_links[$tag->name] ) )
            return $tag_links[$tag->name];
        $tag_ids[$tag->name] = $tag->term_id;
    }
    $min_count = min($counts);
    $spread = max($counts) - $min_count;
    if ( $spread <= 0 )
        $spread = 1;
    $font_spread = $largest - $smallest;
    if ( $font_spread <= 0 )
        $font_spread = 1;
    $font_step = $font_spread / $spread;
    if ( 'name' == $orderby )
        uksort($counts, 'strnatcasecmp');
    else
        asort($counts);
    if ( 'DESC' == $order )
        $counts = array_reverse( $counts, true );
    $a = array();
    $rel = ( is_object($wp_rewrite) && $wp_rewrite->using_permalinks() ) ? ' rel="tag"' : '';
    foreach ( $counts as $tag => $count ) {
        $tag_id = $tag_ids[$tag];
        $tag_link = clean_url($tag_links[$tag]);
        $tag = str_replace(' ', '&nbsp;', wp_specialchars( $tag ));
        $a[] = "\t<option value='$tag_link'>$tag ($count)</option>";
    }
    switch ( $format ) :
    case 'array' :
        $return =& $a;
        break;
    case 'list' :
        $return = "<ul class='wp-tag-cloud'>\n\t<li>";
        $return .= join("</li>\n\t<li>", $a);
        $return .= "</li>\n</ul>\n";
        break;
    default :
        $return = join("\n", $a);
        break;
    endswitch;
    return apply_filters( 'dropdown_generate_tag_cloud', $return,
$tags, $args );
}
// 垃圾评论拦截
class anti_spam {
	function anti_spam() {
		if ( !current_user_can('level_0') ) {
			add_action('template_redirect', array($this, 'w_tb'), 1);
			add_action('init', array($this, 'gate'), 1);
			add_action('preprocess_comment', array($this, 'sink'), 1);
		}
	}
	function w_tb() {
		if ( is_singular() ) {
			ob_start(create_function('$input','return preg_replace("#textarea(.*?)name=([\"\'])comment([\"\'])(.+)/textarea>#",
				"textarea$1name=$2w$3$4/textarea><textarea name=\"comment\" cols=\"100%\" rows=\"4\" style=\"display:none\"></textarea>",$input);') );
		}
	}
	function gate() {
		if ( !empty($_POST['w']) && empty($_POST['comment']) ) {
			$_POST['comment'] = $_POST['w'];
		} else {
			$request = $_SERVER['REQUEST_URI'];
			$referer = isset($_SERVER['HTTP_REFERER'])         ? $_SERVER['HTTP_REFERER']         : '隐瞒';
			$IP      = isset($_SERVER["HTTP_X_FORWARDED_FOR"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] . ' (透过代理)' : $_SERVER["REMOTE_ADDR"];
			$way     = isset($_POST['w'])                      ? '手动操作'                       : '未经评论表格';
			$spamcom = isset($_POST['comment'])                ? $_POST['comment']                : null;
			$_POST['spam_confirmed'] = "请求: ". $request. "\n来路: ". $referer. "\nIP: ". $IP. "\n方式: ". $way. "\n內容: ". $spamcom. "\n -- 记录成功 --";
		}
	}
	function sink( $comment ) {
		if ( !empty($_POST['spam_confirmed']) ) {
			if ( in_array( $comment['comment_type'], array('pingback', 'trackback') ) ) return $comment;
			//方法一: 直接挡掉, 將 die(); 前面两斜线刪除即可.
			die();
			//方法二: 标记为 spam, 留在资料库检查是否误判.
			//add_filter('pre_comment_approved', create_function('', 'return "spam";'));
			//$comment['comment_content'] = "[ 小墙判断这是 Spam! ]\n". $_POST['spam_confirmed'];
		}
		return $comment;
	}
}
$anti_spam = new anti_spam();
function no_gravatar($email) {
$emailaddress = md5($email);//xiaohudie.net
$url = 'http://www.gravatar.com/avatar/' . $emailaddress . '?d=404';//从gravatar处调用默认头像
$headers = @get_headers($url);
if (!preg_match("|200|", $headers[0])) {//进行匹配
$is_no_avatar = FALSE;//如果这个邮件地址没有生成默认头像,则判断为有头像用户
} else {
$is_no_avatar = TRUE;//反之则是没头像了
}
return $is_no_avatar;
}
//自定义表情路径
function custom_smilies_src($src, $img){return get_bloginfo('template_directory').'/img/smilies/' . $img;}
add_filter('smilies_src', 'custom_smilies_src', 10, 2);
?>