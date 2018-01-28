<?php get_header(); ?>
<div id="content">
    <?php if (have_posts()): while(have_posts()): the_post();// ループ開始 ?>
        <h1><?php the_title(); //タイトル ?></h1>
        <div id="blogbox">
            <p>
                <i class="fa fa-calendar"></i>
                &nbsp;-&nbsp;
                <time class="entry-date" datetime="<?php the_time('c') ;?>">
                    <?php the_time('Y/m/d') ;?>
                </time>
            </p>
            <p><i class="fa fa-anchor"></i>&nbsp;-&nbsp;<?php breadcrumb(); //パンくず ?>&nbsp;-&nbsp;<?php the_title(); //タイトル ?></p>
        </div>
        <?php the_content();
    endwhile; else: endif;?>
</div>
<div id="shere">
    <p><a title="facebookでシェアする" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php the_title(); ?>&nbsp;-&nbsp;<?php bloginfo('name'); ?>" target="_blank"><img  src="<?php bloginfo('template_url'); ?>/images/fb-shere.png" alt="Facebookでシェアする" width="100%" height="auto" ></a></p>
    <p><a target="_blank" href="http://twitter.com/share?url=<?php the_permalink(); ?>&amp;text=<?php the_title(); ?>&nbsp;-&nbsp;<?php bloginfo('name'); ?>"><img  src="<?php bloginfo('template_url'); ?>/images/tw-shere.png" alt="Twitterでシェアする" width="100%" height="auto" ></a></p>
    <p><a target="_blank" href="http://b.hatena.ne.jp/entry/hoge.html<?php the_permalink(); ?>" class="hatena-bookmark-button" data-hatena-bookmark-layout="simple" title="<?php the_title(); ?>&nbsp;-&nbsp;<?php bloginfo('name'); ?>"><img  src="<?php bloginfo('template_url'); ?>/images/hatebu.png" alt="はてなブックマークに追加" width="100%" height="auto" ></a></p>
</div>
<?php get_footer(); ?>
