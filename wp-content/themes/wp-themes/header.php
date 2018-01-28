<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]> <html class="i7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]> <html class="ie" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
<meta name="format-detection" content="telephone=no" />
<?php if(is_tag()): ?>
<meta name="robots" content="noindex,follow">
<?php endif; ?>
<meta name="google-site-verification" content="NMj8nhjiRtk6exmbHNpF-Dnw1Y2a7MXcSNJXYCMAPvQ" />
<!-- OGP設定 -->
<meta property="fb:admins" content="100002018265474" />
<meta property="og:locale" content="ja_JP">
<meta property="og:type" content="blog">
<meta property='og:site_name' content='<?php bloginfo('name'); ?>'>
<meta property='og:url' content='<?php the_permalink(); ?>'>
<meta property="og:description" content="<?php bloginfo('description'); ?>..." />
<meta property="og:title" content="
<?php
global $page, $paged;
if (is_front_page()):
elseif (is_single()):
    wp_title('|', true, 'right');
elseif (is_page()):
    wp_title('|', true, 'right');
elseif (is_archive()):
    wp_title('|', true, 'right');
elseif (is_search()):
    wp_title('|', true, 'right');
elseif (is_404()):
    echo'404 |';
endif;
    bloginfo('name');
if ($paged >= 2 || $page >= 2):
    echo'-'.sprintf(
        '%sページ',
        max($paged, $page)
    );
endif;
?>
">
<?php
if (is_single() || is_page()) {
    if (has_post_thumbnail()) {
        $image_id = get_post_thumbnail_id();
        $image = wp_get_attachment_image_src($image_id, 'full');
        echo '<meta property="og:image" content="'.$image[0].'">';
        echo "\n";
    } elseif (preg_match('/<img.*?src=(["\'])(.+?)\1.*?>/i', $post->post_content, $imgurl) && !is_archive()) {//アイキャッチ以外の画像がある場合
        echo '<meta property="og:image" content="'.$imgurl[2].'">';
        echo "\n";
    } else {//画像が1つも無い場合
        echo '<meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/images/blog.jpg">';
        echo "\n";
    }
} else { //ホーム・カテゴリーページなど
    echo '<meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/images/blog.jpg">';
    echo "\n";
}
?>
<!-- Twitterカード -->
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@jkhayate">
<meta name="twitter:creator" content="@jkhayate">
<meta name="twitter:domain" content="http://yasushikobayashi.info/" />
<!-- タイトル設定 -->
<title>
<?php
global $page, $paged;
if(is_front_page()):
elseif(is_single()):
    wp_title('|', true, 'right');
elseif(is_page()):
    wp_title('|', true, 'right');
elseif(is_archive()):
    wp_title('|', true, 'right');
elseif(is_search()):
    wp_title('|', true, 'right');
elseif(is_404()):
    echo'404 |';
endif;
    bloginfo('name');
if ($paged >= 2 || $page >= 2):
    echo'-'.sprintf(
        '%sページ',
        max($paged, $page)
    );
endif;
?>
</title>
<!-- CSSなど -->
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/style.css" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" />
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.11.2.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/extend.js"></script>
<!--[if lt IE 9]>
    <script src="<?php bloginfo('template_directory'); ?>/js/css3-mediaqueries.min.js"></script>
    <script src="<?php bloginfo('template_directory'); ?>/js/html5shiv.min.js"></script>
<![endif]-->
<?php wp_head(); ?>
<?php if(is_mobile()):?>
    <link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-precomposed.png" />
<?php endif;?>
<meta name="google-site-verification" content="9xYlw_J73xvHigg1CaePoxCHIU0X0xXuoMpzv9XajEM" />
</head>
<body <?php body_class(); ?>>
<div id="fb-root"></div>
<script type="text/javascript">
//フェイスブックページ設置用
(function (d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.5";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
// fb問い合わせ
(function(d, t) {
  var a = d.createElement(t), s = d.getElementsByTagName(t)[0];
  a.async = a.src = '//cdn.speaklyn.com/383526b6798f8070413de06335e6d5d9.js';
  s.parentNode.insertBefore(a, s);
}(document, 'script'));
</script>
<header>
<div id="header">
    <?php if (is_home()) { ?>
        <h1><a href="<?php bloginfo('url'); ?>" ><?php bloginfo('name'); ?></a></h1>
    <?php } else { ?>
        <h2 id="sitename"><a href="<?php bloginfo('url'); ?>" ><?php bloginfo('name'); ?></a></h2>
    <?php } ?>
        <!--メニュー-->
        <nav id="g_navi">
            <p id="nav_close"><a href="#page">CLOSE</a></p>
            <?php
            $defaults = array(
                'theme_location'  => 'navbar',
            );
            wp_nav_menu($defaults);
            ?>
        </nav>
        <p id="nav_open"><a href="#g_navi">MENU</a></p>
    </div>
</header>
