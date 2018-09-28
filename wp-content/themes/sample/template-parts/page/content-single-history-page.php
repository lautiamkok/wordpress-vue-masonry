<?php
/**
 * Displays content for single page
 *
 * @package WordPress
 * @subpackage Sample
 * @since 1.0
 * @version 1.0
 */
?>

<?php
// Get requested language.
$lang = get_query_var('lang');
$langForApi = $lang ? $lang : 'en';

// Get the post by slug.
// https://stackoverflow.com/questions/14979837/wordpress-query-single-post-by-slug
$args = array(
  'name' => $parentSlug,
  'post_type' => 'page',
  'post_status' => 'publish',
  'numberposts' => 1
);
$parent = get_posts($args);

// Send $type to templates.
set_query_var('parent', $parent);
?>

<!-- row heading -->
<div class="row row-heading article history" data-aos="fade-in">
    <div class="grid-container">
        <div class="grid-x grid-padding-x align-bottom">

            <div class="large-6 large-offset-3 cell">
                <a href="<?php echo switchLink(get_permalink($parent[0]), $lang); ?>" class="button-grey uppercase position-relative padding-left"><i class="material-icons">keyboard_arrow_left</i> ALL POSTS</span></a>

                <h2 class="heading article-title"><?php echo translateTitle($post, $lang); ?></h2>

                <p class="article-excerpt"><?php echo translateText(get_the_excerpt(), $lang); ?></p>

                <?php
                if (has_post_thumbnail()) {

                    // Get image alt.
                    // https://stackoverflow.com/questions/19267650/get-wordpress-featured-image-alt
                    $alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
                    $desc = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_caption', true);


                    // Image data.
                    $postImage = array(
                        'id' => get_post_thumbnail_id() ,
                        'url'  => get_the_post_thumbnail_url(),
                        'caption' => get_the_post_thumbnail_caption(),
                        'alt' => $alt,
                        'description' => $desc,
                    );
                ?>
                <div class="container-image">
                    <a href="#" class="button-image open-overlay-content" data-index="0">
                        <img src="<?php echo $postImage['url']; ?>" alt="<?php echo $postImage['alt']; ?>" />
                    </a>
                </div>
                <?php } ?>

            </div>

        </div>
    </div>
</div>
<!-- row heading -->

<!-- row article -->
<div class="row row-article history">
    <div class="grid-container">
        <div class="grid-x grid-padding-x align-middle">

            <!-- cell -->
            <div class="large-6 large-offset-3 cell">

                <?php
                // Wrap <p><img ..> with <div...>
                $startIndex = 0;
                if (has_post_thumbnail()) {
                    $startIndex = 1;
                }
                $string = translateContent($post, $lang);
                $replacer = new stringReplace($startIndex);
                $string = $replacer->replace('/<p><img src="(.*?)" alt="(.*?)" (.*?)\/><\/p>/', $string);
                $total = $replacer->sumMatches();
                $images = $replacer->getImages();

                if ($total > 0 && has_post_thumbnail()) {
                    $images = array_merge(array($postImage), $images);
                }

                if ($total === 0 && has_post_thumbnail()) {
                    $images = array($postImage);
                }

                // print_r($total);
                // print_r($images);

                echo $string;
                ?>

                <?php
                // Check if the list has items.
                if(have_rows('items_download')):
                ?>
                <ul class="list-block for-history for-article">

                    <?php
                    $index = 0;;
                    // loop through the rows of data
                    while (have_rows('items_download')) : the_row();

                    // Get fields data.
                    $file = get_sub_field('item_file');
                    $name = get_sub_field('item_name');
                    ?>
                    <li><a href="<?php echo $file['url']; ?>" target="_blank"><i class="material-icons">insert_drive_file</i> <?php echo $name; ?> (<?php echo $file['mime_type']; ?>)</a></li>
                    <?php
                    $index ++;
                    endwhile;
                    ?>
                </ul>
                <?php
                endif;
                ?>

            </div>
            <!-- cell -->

        </div>
    </div>
</div>
<!-- row article -->

<div class="row row-divider collection">
    <div class="grid-container">
        <div class="grid-x grid-padding-x">

            <!-- cell -->
            <div class="large-12 cell">
                <hr/>
            </div>
            <!-- cell -->

        </div>
    </div>
</div>

<?php if (count($images) > 0) { ?>
<!-- overlay swiper -->
<div class="overlay-content">
    <div class="grid-container full-height">
        <div class="grid-x grid-padding-x small-padding-collapse full-height">

            <div class="small-10 cell small-offset-1 position-relative align-self-bottom">
                <nav class="float-right">
                    <a href="#" class="button-exit-reveal exit-overlay-content"><i class="material-icons">close</i></a></a>
                </nav>
            </div>

            <div class="small-10 cell small-offset-1">

                <!-- row swiper -->
                <div class="row row-swiper autoheight">

                    <!-- Swiper -->
                    <div class="swiper-container">
                        <div class="swiper-wrapper">

                            <?php foreach ($images as $key => $image) { ?>
                            <div class="swiper-slide"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"></div>
                            <?php } ?>

                        </div>

                    </div>
                    <!-- Swiper -->

                    <?php if (count($images) > 1) { ?>
                    <!-- Add Pagination -->
                    <div class="container-pagination">
                        <div class="grid-x grid-padding-x align-middle full-height small-padding-collapse">
                             <div class="swiper-pagination small-12 cell align-self-middle"></div>
                        </div>
                    </div>
                    <?php } ?>

                    <!-- Add Arrows -->
                    <!-- <div class="swiper-button-next swiper-arrow float-right button-arrow-right"><i class="icon-arrow-up"></i></div>
                    <div class="swiper-button-prev swiper-arrow float-left button-arrow-left"><i class="icon-arrow-up"></i></div> -->

                    <?php if (count($images) > 1) { ?>
                    <div class="swiper-button-next swiper-arrow"></div>
                    <div class="swiper-button-prev swiper-arrow"></div>
                    <?php } ?>

                </div>
                <!-- row swiper -->

            </div>

        </div>
    </div>

</div>
<!-- overlay swiper -->
<?php } ?>

<?php
// Get the taxonomy that attached to the post.
$taxonomy = get_the_terms($post, $taxonomy);
$taxonomyCurrent = current($taxonomy);
?>

<!-- row-heading -->
<div class="row row-heading history" data-aos="fade-up">
    <div class="grid-container">
        <div class="grid-x grid-padding-x align-bottom">

            <div class="large-6 large-offset-3 cell">
               <h2 class="heading medium"><?php echo translateText(get_field('related_posts', 'option'), $lang); ?></h2>
            </div>

        </div>
    </div>
</div>
<!-- row-heading -->

<?php
// JSON API endpoint.
$endpoint = site_url() . '/wp-json/' . $parentSlug . '/v1/lang/' . $langForApi . '/category/';
?>
<a href="#" id="button-load-catposts" class="button button-load hide" data-posts-endpoint="<?php echo $endpoint; ?>" data-cat="<?php echo $taxonomyCurrent->slug; ?>" data-exclude="<?php echo $post->ID; ?>" v-on:click.prevent="fetchCatPosts"><i class="material-icons">add</i><span>Load More</span></a>

<div id="api-posts" data-filter="category" data-filter="category">

    <template v-if="items">

    <!-- row cards -->
    <div class="row row-card collapsed-margin-top-for-small">
        <div class="grid-container">
            <div class="grid-x grid-padding-x" v-masonry transition-duration="0.3s" item-selector=".item" :origin-top="true" :horizontal-order="false">

                <!-- vue - loop -->
                <!-- https://laracasts.com/discuss/channels/vue/use-v-for-without-wrapping-element -->
                <template v-for="item in items">

                <!-- cell -->
                <div v-masonry-tile class="large-6 large-offset-3 cell cell-card item" v-if="item.id !='<?php echo $post->ID; ?>'">

                    <?php get_template_part( 'template-parts/page/vue', 'item-history' ); ?>

                </div>
                <!-- cell -->

                </template>
                <!-- vue - loop -->

            </div>
        </div>
    </div>
    <!-- row cards -->

    <div class="container-spinner">
        <div v-if="loading === true" class="sk-circle">
          <div class="sk-circle1 sk-child"></div>
          <div class="sk-circle2 sk-child"></div>
          <div class="sk-circle3 sk-child"></div>
          <div class="sk-circle4 sk-child"></div>
          <div class="sk-circle5 sk-child"></div>
          <div class="sk-circle6 sk-child"></div>
          <div class="sk-circle7 sk-child"></div>
          <div class="sk-circle8 sk-child"></div>
          <div class="sk-circle9 sk-child"></div>
          <div class="sk-circle10 sk-child"></div>
          <div class="sk-circle11 sk-child"></div>
          <div class="sk-circle12 sk-child"></div>
       </div>
    </div>

    </template>

</div>

