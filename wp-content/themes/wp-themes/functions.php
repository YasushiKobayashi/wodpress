<?php
function register_jq_script()
{
    if (!is_admin()) {
        $script_dir = get_template_directory_uri();
        wp_deregister_script('jquery');
        wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js', [], false, false);
    }
}
add_action('wp_enqueue_scripts', 'register_jq_script');

//WordPress の投稿スラッグを自動的に生成する
function auto_post_slug($slug, $post_ID, $post_status, $post_type)
{
    if (preg_match('/(%[0-9a-f]{2})+/', $slug)) {
        $slug = utf8_uri_encode($post_type) . '-' . $post_ID;
    }
    return $slug;
}
add_filter('wp_unique_post_slug', 'auto_post_slug', 10, 4);

// 抜粋の長さを変更する
function custom_excerpt_length($length)
{
    return 70;
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);

// 文末文字を変更する
function custom_excerpt_more($more)
{
    return ' <br/>... read more ';
}
add_filter('excerpt_more', 'custom_excerpt_more');

//スマホ表示分岐
function is_mobile()
{
    $useragents = [
        'iPhone', // iPhone
        'iPod', // iPod touch
        'Android.*Mobile', // 1.5+ Android *** Only mobile
        'Windows.*Phone', // *** Windows Phone
        'dream', // Pre 1.5 Android
        'CUPCAKE', // 1.5+ Android
        'blackberry9500', // Storm
        'blackberry9530', // Storm
        'blackberry9520', // Storm v2
        'blackberry9550', // Storm v2
        'blackberry9800', // Torch
        'webOS', // Palm Pre Experimental
        'incognito', // Other iPhone browser
        'webmate', // Other iPhone browser
    ];
    $pattern = '/'.implode('|', $useragents).'/i';
    return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}
//アイキャッチサムネイル
add_theme_support('post-thumbnails');

//カスタムメニュー
register_nav_menus(array('navbar' => 'ナビゲーションバー'));

// RSS
add_theme_support('automatic-feed-links');



//投稿用ファイルを読み込む
get_template_part('functions/create-thread');

//ページャー機能
function pagination($pages = '', $range = 4)
{
    $showitems = ($range * 2)+1;
    global $paged;
    if (empty($paged)) {
        $paged = 1;
    }
    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }
    if (1 != $pages) {
        echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
        if ($paged > 2 && $paged > $range+1 && $showitems < $pages) {
            echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
        }
        if ($paged > 1 && $showitems < $pages) {
            echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;
            Previous</a>";
        }

        for ($i=1; $i <= $pages; $i++) {
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems)) {
                echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"
                <a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
            }
        }
        if ($paged < $pages && $showitems < $pages) {
            echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";
        }
        if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) {
            echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
        }
        echo "</div>\n";
    }
}

//ヘッダーを綺麗に
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'wp_generator');

// パンくずリスト
function breadcrumb()
{
    global $post;
    $str ='';
    if (!is_home()&&!is_admin()){
        $str.= '<a href="'. home_url() .'" itemprop="url">ホーム</a> &gt;';

        if (is_category()) {
            $cat = get_queried_object();
            if ($cat -> parent != 0){
                $ancestors = array_reverse(get_ancestors($cat -> cat_ID, 'category'));
                foreach($ancestors as $ancestor){
                    $str.='<a href="'. get_category_link($ancestor) .'" itemprop="url">'. get_cat_name($ancestor) .'</a> &gt;';
                }
            }
            $str.='<a href="'. get_category_link($cat -> term_id). '" itemprop="url">'. $cat-> cat_name . '</a>';
        } elseif (is_page()){
            if ($post -> post_parent != 0){
                $ancestors = array_reverse(get_post_ancestors($post->ID));
                foreach($ancestors as $ancestor){
                    $str.='<a href="'. get_permalink($ancestor).'" itemprop="url">'. get_the_title($ancestor) .'</a>';
                }
            }
        } elseif (is_single()){
            $categories = get_the_category($post->ID);
            $cat = $categories[0];
            if ($cat -> parent != 0){
                $ancestors = array_reverse(get_ancestors($cat -> cat_ID, 'category'));
                foreach($ancestors as $ancestor){
                    $str.='<a href="'. get_category_link($ancestor).'" itemprop="url">'. get_cat_name($ancestor). '</a> &gt;';
                }
            }
            $str.='<a href="'. get_category_link($cat -> term_id). '" itemprop="url">'. $cat-> cat_name . '</a>';
        } else{
        }
    }
    echo $str;
}

//moreリンク
function custom_content_more_link($output)
{
    $output = preg_replace('/#more-[\d]+/i', '', $output);
    return $output;
}
add_filter('the_content_more_link', 'custom_content_more_link');


//iframeのレスポンシブ対応
function wrap_iframe_in_div($the_content)
{
    if (is_singular()) {
        $the_content = preg_replace('/< *?iframe/i', '<div class="youtube-container"><iframe', $the_content);
        $the_content = preg_replace('/<\/ *?iframe *?>/i', '</iframe></div>', $the_content);
    }
    return $the_content;
}
add_filter('the_content', 'wrap_iframe_in_div');


//更新日の追加
function get_mtime($format)
{
    $mtime = get_the_modified_time('Ymd');
    $ptime = get_the_time('Ymd');
    if ($ptime > $mtime) {
        return get_the_time($format);
    } elseif ($ptime === $mtime) {
        return null;
    } else {
        return get_the_modified_time($format);
    }
}

add_filter('wp_calculate_image_srcset', '__return_false');
