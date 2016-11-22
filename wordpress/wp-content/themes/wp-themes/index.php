<?php get_header(); ?>
<div id="top" data-liffect="slideBottom">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <dl>
            <dt>
                <?php if (has_post_thumbnail()):
                    the_post_thumbnail();
                else: // サムネイルを持っていないときの処理 ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/no_image.png" alt="no image" title="no image" width="100" height="100" />
                <?php endif; ?>
            </dt>
            <dd>
                <h3><?php the_title(); ?></h3>
                <p>
                    <span>
                        <i class="fa fa-tags"></i>&nbsp;
                        <?php the_category(', ') ?>
                    </span>
                </p>
                <div class="smart">
                    <?php the_excerpt();?>
                </div>
            </dd>
            <a href="<?php the_permalink(); ?>"><span>Read more</span></a>
        </dl>
    <?php endwhile; else: ?>
        <p>記事がありません</p>
    <?php endif; ?>
    <!--ページナビ-->
    <?php
    if (function_exists("pagination")) {
        pagination($wp_query->max_num_pages);
    }
    ?>
</div>
<?php get_footer(); ?>
