<?php get_header();?>
<div id="content">
    <?php if (have_posts()): while (have_posts()): the_post(); //ループ開始?>
        <h1><?php the_title(); //タイトル?></h1>
        <div id="blogbox">
            <p>
                <i class="fa fa-calendar"></i>&nbsp;-&nbsp;
                <time class="entry-date" datetime="<?php the_time('c') ;?>">
                    <?php the_time('Y/m/d') ;?>
                </time>
            </p>
            <p><i class="fa fa-anchor"></i>&nbsp;-&nbsp;<?php breadcrumb(); //パンくず?></p>
            <p>
                <i class="fa fa-tags"></i>&nbsp;-&nbsp;
                <?php the_category(', ')?>
                <?php the_tags('', ', ');?>
            </p>
        </div>
        <div id="headad">
            <?php if (wp_is_mobile() && has_tag(array(96,102,103))): //禁止タグではスマホは忍者一つ?>
                <script src="http://adm.shinobi.jp/s/036b18e03686c910acd4c4eec36d89bb"></script>
            <?php elseif (has_tag(array(96,102,103))): //禁止タグPCでは忍者２つ?>
                <script src="http://adm.shinobi.jp/s/036b18e03686c910acd4c4eec36d89bb"></script>
                <script src="http://adm.shinobi.jp/s/036b18e03686c910acd4c4eec36d89bb"></script>
            <?php elseif (wp_is_mobile()): //モバイルではレスポンシブ広告?>
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- smarthead -->
                <ins class="adsbygoogle"
                style="display:block"
                data-ad-client="ca-pub-6112624668752806"
                data-ad-slot="8897652573"
                data-ad-format="auto"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            <?php else://通常はAdSense2つ?>
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- pchead -->
                <ins class="adsbygoogle"
                style="display:inline-block;width:336px;height:280px"
                data-ad-client="ca-pub-6112624668752806"
                data-ad-slot="1374385778"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- pchead -->
                <ins class="adsbygoogle"
                style="display:inline-block;width:336px;height:280px"
                data-ad-client="ca-pub-6112624668752806"
                data-ad-slot="1374385778"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            <?php endif;?>
        </div>
        <?php the_content();?>
    <?php endwhile; else: endif;?>
    <div id="p_navi">
        <?php //ページネーション
        $prev_post = get_previous_post();
        if (!empty($prev_post)):?>
            <div id="prev">
                PREV<br/>
                <a href="<?php echo get_permalink($prev_post->ID);?>"><?php echo $prev_post->post_title;?></a>
            </div>
        <?php endif; //?>
        <?php
        $next_post = get_next_post();
        if (!empty($next_post)):?>
            <div id="next">
                NEXT<br/>
                <a href="<?php echo get_permalink($next_post->ID);?>"><?php echo $next_post->post_title;?></a>
            </div>
        <?php endif; //ここまで?>
    </div>
</div>
<div id="shere">
    <p><a title="facebookでシェアする" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title();?>&nbsp;-&nbsp;<?php bloginfo('name');?>" target="_blank"><img  src="<?php bloginfo('template_url');?>/images/fb-shere.png" alt="Facebookでシェアする" width="100%" height="auto" ></a></p>
    <p><a target="_blank" href="http://twitter.com/share?url=<?php the_permalink();?>&amp;text=<?php the_title();?>&nbsp;-&nbsp;<?php bloginfo('name');?>"><img  src="<?php bloginfo('template_url');?>/images/tw-shere.png" alt="Twitterでシェアする" width="100%" height="auto" ></a></p>
    <p><a target="_blank" href="http://b.hatena.ne.jp/entry/hoge.html<?php the_permalink();?>" class="hatena-bookmark-button" data-hatena-bookmark-layout="simple" title="<?php the_title();?>&nbsp;-&nbsp;<?php bloginfo('name');?>"><img  src="<?php bloginfo('template_url');?>/images/hatebu.png" alt="はてなブックマークに追加" width="100%" height="auto" ></a></p>
</div>
<?php get_footer();?>
