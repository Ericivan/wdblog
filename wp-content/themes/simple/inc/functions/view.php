<?php /***********文章统计*********/  
function process_postviews() {   
    global $user_ID, $post;   
    if(check_cookie($post))   
        return;   
    if(is_int($post)) {   
        $post = get_post($post);   
    }   
    if(!wp_is_post_revision($post)) {   
        if(is_single() || is_page()) {   
            $id = intval($post->ID);   
            //$post_views = get_post_custom($id);   
            $post_views = get_post_meta($id,'_check_count',true);   
            //统计所有人   
            $should_count = true;   
            //排除机器人   
            $bots = array('Google Bot' => 'googlebot', 'Google Bot' => 'google', 'MSN' => 'msnbot', 'Alex' => 'ia_archiver', 'Lycos' => 'lycos', 'Ask Jeeves' => 'jeeves', 'Altavista' => 'scooter', 'AllTheWeb' => 'fast-webcrawler', 'Inktomi' => 'slurp@inktomi', 'Turnitin.com' => 'turnitinbot', 'Technorati' => 'technorati', 'Yahoo' => 'yahoo', 'Findexa' => 'findexa', 'NextLinks' => 'findlinks', 'Gais' => 'gaisbo', 'WiseNut' => 'zyborg', 'WhoisSource' => 'surveybot', 'Bloglines' => 'bloglines', 'BlogSearch' => 'blogsearch', 'PubSub' => 'pubsub', 'Syndic8' => 'syndic8', 'RadioUserland' => 'userland', 'Gigabot' => 'gigabot', 'Become.com' => 'become.com','Baidu Bot'=>'Baiduspider');   
            $useragent = $_SERVER['HTTP_USER_AGENT'];   
            foreach ($bots as $name => $lookfor) {   
                if (stristr($useragent, $lookfor) !== false) {   
                    $should_count = false;   
                    break;   
                }   
            }   
            if($should_count) {   
                if(!update_post_meta($id, '_check_count', ($post_views+1))) {   
                    add_post_meta($id, '_check_count', 1, true);   
                }   
            }   
        }   
    }   
}   
  
function check_cookie($post){   
    $COOKNAME = 'ashuwp_view';   
    if(isset($_COOKIE[$COOKNAME]))   
        $cookie = $_COOKIE[$COOKNAME];   
    else  
        return false;   
    $id = $post->ID;   
    if(empty($id)){   
        return false;   
    }   
    if(!empty($cookie)){   
        $list = explode('a', $cookie);   
        if(!empty($list) && in_array($id, $list)){   
            return true;   
        }   
    }   
    return false;   
}   
### Function: Display The Post Views   
function the_views($display = true,$id) {   
    $post_views = intval(get_post_meta($id,'_check_count',true));   
    $output = number_format_i18n($post_views);   
    if($display) {   
        echo $output;   
    } else {   
        return $output;   
    }   
}   
  
### Function: Display Total Views   
if(!function_exists('get_totalviews')) {   
    function get_totalviews($display = true) {   
        global $wpdb;   
        $total_views = intval($wpdb->get_var("SELECT SUM(meta_value+0) FROM $wpdb->postmeta WHERE meta_key = '_check_count'"));   
        if($display) {   
            echo number_format_i18n($total_views);   
        } else {   
            return $total_views;   
        }   
    }   
}   
  
### Function: Add Views Custom Fields   
add_action('publish_post', 'add_views_fields');   
add_action('publish_page', 'add_views_fields');   
function add_views_fields($post_ID) {   
    global $wpdb;   
    if(!wp_is_post_revision($post_ID)) {   
        add_post_meta($post_ID, '_check_count', 0, true);   
    }   
}   
### Function: Delete Views Custom Fields   
add_action('delete_post', 'delete_views_fields');   
function delete_views_fields($post_ID) {   
    global $wpdb;   
    if(!wp_is_post_revision($post_ID)) {   
        delete_post_meta($post_ID, '_check_count');   
    }   
}  ?>