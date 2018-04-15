<?php get_header();?>
<div id="content">
    <p><i class="fa fa-anchor"></i>&nbsp;-&nbsp;<?php breadcrumb(); //パンくず ?></p>
    <!--/kuzu-->
    <h2>「
        <?php if (is_category()):
            single_cat_title();
        elseif (is_tag()):
            single_tag_title();
        elseif (is_tax()):
            single_term_title();
        elseif (is_day()):?>
            日別アーカイブ：<?php echo get_the_time('Y年m月d日');?>
        <?php elseif (is_month()):?>
            月別アーカイブ：<?php echo get_the_time('Y年m月');?>
        <?php elseif (is_year()):?>
            年別アーカイブ：<?php echo get_the_time('Y年');?>
        <?php elseif (is_author()):?>
            投稿者アーカイブ：<?php echo esc_html(get_queried_object()->display_name);?>
        <?php elseif (isset($_GET['paged']) && !empty($_GET['paged'])):?>
            ブログアーカイブ
        <?php endif;?>
        」 一覧
    </h2>
    <!--ループ開始-->
    <?php if (have_posts()): while (have_posts()): the_post();?>
        <dl>
            <dt>
                <a href="<?php the_permalink() ?>" >
                    <?php
                    if (has_post_thumbnail()):
                        the_post_thumbnail();
                    else:
                    ?>
                        <img src="<?php echo get_template_directory_uri();?>/images/no_image.png" alt="no image" title="no image" width="100" height="100" />
                    <?php endif;?>
                </a>
            </dt>
            <dd>
                <h3>
                    <a href="<?php the_permalink();?>">
                    <?php the_title();?>
                    </a>
                </h3>
                <p>
                    <i class="fa fa-calendar"></i>&nbsp;-&nbsp;
                    <time class="entry-date" datetime="<?php the_time('c');?>">
                        <?php the_time('Y/m/d');?>
                    </time>
                </p>
                <div class="smart">
                    <a href="<?php the_permalink();?>"><?php the_excerpt();?></a>
                </div>
            </dd>
        </dl>
        <p style="clear:both; height:30px;"></p>
    <?php endwhile; else: ?>
        <p>記事がありません</p>
    <?php endif;?>
    <?php
    if (function_exists("pagination")) {
        pagination($wp_query->max_num_pages);
    }?>
</div>
<!--/#content -->
<?php get_footer();?>
