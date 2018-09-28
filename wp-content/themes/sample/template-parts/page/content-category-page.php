<?php
/**
 * Displays content for ceramics taxonomy page
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
?>

<?php
// Get current tax.
// https://stackoverflow.com/questions/12289169/how-do-i-get-current-taxonomy-term-id-on-wordpress
$tax = $wp_query->get_queried_object();

// Get the post by slug.
// https://stackoverflow.com/questions/14979837/wordpress-query-single-post-by-slug
$args = array(
  'name' => $parentSlug,
  'post_type' => 'page',
  'post_status' => 'publish',
  'numberposts' => 1
);
$parent = get_posts($args);
?>

<div id="api-posts" data-filter="category" data-filter="category">

    <div class="row row-description small-only">

        <div class="grid-container">
            <div class="grid-x grid-padding-x">

                <!-- cell -->
                <div class="large-4 medium-6 cell">
                    <div class="container-text">
                        <span class="collection-category"><?php echo translateTitle($parent[0], $lang); ?></span>
                        <h2 class="heading collection-heading"><?php echo translateText($tax->name, $lang); ?></h2>
                        <p><?php echo translateText($tax->description, $lang); ?></p>
                    </div>
                </div>
                <!-- cell -->

            </div>
        </div>

    </div>

    <?php
    // JSON API endpoint.
    $endpoint = site_url() . '/wp-json/' . $parentSlug . '/v1/lang/' . $langForApi . '/category/';
    ?>
    <a href="#" id="button-load-catposts" class="button button-load hide" data-posts-endpoint="<?php echo $endpoint; ?>" data-cat="<?php echo $tax->slug; ?>" v-on:click.prevent="fetchCatPosts"><i class="material-icons">add</i><span>Load More</span></a>

    <?php get_template_part( 'template-parts/page/vue', 'items' ); ?>

</div>
