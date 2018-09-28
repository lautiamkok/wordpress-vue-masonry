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

<?php
// Check if the list has items.
if(have_rows('gallery_items')):
?>
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

                            <?php
                            // loop through the rows of data
                            while (have_rows('gallery_items')) : the_row();

                            // Get fields data.
                            $image = get_sub_field('gallery_image');
                            $title = get_sub_field('gallery_title');
                            $alt = get_sub_field('gallery_alt');
                            $description = get_sub_field('gallery_description');
                            ?>

                            <div class="swiper-slide">
                                <img src="<?php echo $image['url']; ?>" alt="<?php echo translateText($alt, $lang);?>">
                            </div>
                            <?php
                            endwhile;
                            ?>

                        </div>

                    </div>
                    <!-- Swiper -->

                    <!-- Add Pagination -->
                    <div class="container-pagination">
                        <div class="grid-x grid-padding-x align-middle full-height small-padding-collapse">
                             <div class="swiper-pagination small-12 cell align-self-middle"></div>
                        </div>
                    </div>
                    <!-- Add Arrows -->
                    <!-- <div class="swiper-button-next swiper-arrow float-right button-arrow-right"><i class="icon-arrow-up"></i></div>
                    <div class="swiper-button-prev swiper-arrow float-left button-arrow-left"><i class="icon-arrow-up"></i></div> -->

                    <div class="swiper-button-next swiper-arrow"></div>
                    <div class="swiper-button-prev swiper-arrow"></div>

                </div>
                <!-- row swiper -->

            </div>

        </div>
    </div>

</div>
<!-- overlay swiper -->
<?php
endif;
?>

<div class="row row-article collection">
    <div class="grid-container full-height">
        <div class="grid-x grid-padding-x">
            <div class="large-10 medium-12 cell large-offset-1">

                <div class="grid-x grid-padding-x small-padding-collapse">

                    <?php
                    // Check if the list has items.
                    if(have_rows('gallery_items')):
                    ?>
                    <div class="large-6 medium-12 cell">
                        <!-- Swiper -->
                        <div class="swiper-container gallery-top swiper-gallery">
                            <div class="swiper-wrapper">

                                <?php
                                $index = 0;;
                                // loop through the rows of data
                                while (have_rows('gallery_items')) : the_row();

                                // Get fields data.
                                $image = get_sub_field('gallery_image');
                                $title = get_sub_field('gallery_title');
                                $alt = get_sub_field('gallery_alt');
                                $description = get_sub_field('gallery_description');
                                ?>
                                <div class="swiper-slide open-overlay-content" data-index="<?php echo $index; ?>" style="background-image:url(<?php echo $image['url']; ?>)"><img src="<?php echo $image['url']; ?>" alt="<?php echo translateText($alt, $lang);?>" class="hide"></div>
                                <?php
                                $index ++;
                                endwhile;
                                ?>

                            </div>
                            <!-- Add Arrows -->

                            <div class="swiper-button-next swiper-button-white swiper-arrow"></div>
                            <div class="swiper-button-prev swiper-button-white swiper-arrow"></div>
                        </div>

                        <div class="swiper-container gallery-thumbs">
                            <div class="swiper-wrapper">

                                <?php
                                // loop through the rows of data
                                while (have_rows('gallery_items')) : the_row();

                                // Get fields data.
                                $image = get_sub_field('gallery_image');
                                ?>
                                <div class="swiper-slide button-thumbnail" style="background-image:url(<?php echo $image['url']; ?>)"></div>
                                <?php
                                endwhile;
                                ?>
                            </div>
                        </div>
                    </div>

                    <?php
                    endif;
                    ?>

                    <div class="large-6 medium-12 cell">
                        <div class="container-text medium-padding small-padding">

                            <!-- <i class="material-icons mi-arrow-down">keyboard_arrow_right</i> -->
                            <nav class="nav-breadcrumbs">
                              <ul class="align-left">
                                <li><a href="<?php echo switchLink(get_permalink($parent[0]->ID), $lang); ?>"><?php echo translateTitle($parent[0], $lang); ?></a></li>
                                <li><a href="<?php echo switchLink(get_permalink($post->ID), $lang); ?>"><?php echo translateTitle($post, $lang); ?></a></li>
                              </ul>
                            </nav>

                            <h2 class="heading collection-heading"><?php echo translateTitle($post, $lang); ?></h2>

                            <?php
                            $material = get_field('product_material', $post->ID);
                            $dimensions = get_field('product_dimensions', $post->ID);
                            $origin = get_field('product_origin', $post->ID);
                            ?>
                            <p class="meta">
                                <span class="material"><?php echo translateText($material, $lang); ?></span>
                                <span class="dimensions"><?php echo translateText($dimensions, $lang); ?></span>
                                <span class="origin"><?php echo translateText($origin, $lang); ?></span>
                            </p>

                            <?php echo translateContent($post, $lang); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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

<?php
// Get the taxonomy that attached to the post.
$taxonomy = get_the_terms($post, $taxonomy);
$taxonomyCurrent = current($taxonomy);
?>

<div class="row row-related">
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <div class="large-3 cell">
                <h3 class="heading heading-related" data-aos="fade-up"><?php echo translateText(get_field('more_in_this_collection', 'option'), $lang); ?></h3>
            </div>

            <div class="large-9 cell">

                <div id="api-posts" data-filter="category" data-filter="category">

                <?php
                // JSON API endpoint.
                $endpoint = site_url() . '/wp-json/' . $parentSlug . '/v1/lang/' . $langForApi . '/category/';
                ?>
                <a href="#" id="button-load-catposts" class="button button-load hide" data-posts-endpoint="<?php echo $endpoint; ?>" data-cat="<?php echo $taxonomyCurrent->slug; ?>" data-exclude="<?php echo $post->ID; ?>" v-on:click.prevent="fetchCatPosts"><i class="material-icons">add</i><span>Load More</span></a>

                <?php get_template_part( 'template-parts/page/vue', 'items-related' ); ?>

                </div>

            </div>
        </div>
    </div>
</div>
