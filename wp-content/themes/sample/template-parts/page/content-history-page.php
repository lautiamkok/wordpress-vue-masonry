<?php
/**
 * Displays content for history page
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

<div id="api-posts" data-filter="">

    <div class="row row-description collapse-padding-for-small-only">

        <div class="grid-container">
            <div class="grid-x grid-padding-x">

                <!-- cell -->
                <div class="large-6 cell">
                    <div class="container-text">
                        <h1 class="heading heading-history"><?php echo translateTitle($post, $lang); ?></h1>
                        <div class="tagline-history">
                            <?php echo translateContent($post, $lang); ?>
                        </div>
                    </div>
                </div>
                <!-- cell -->

            </div>
        </div>

    </div>

    <?php
    // JSON API endpoint.
    $endpoint = site_url() . '/wp-json/' . $slug . '/v1/lang/' . $langForApi . '/parent/' . $post->ID .'/page/';
    ?>
    <a href="#" id="button-load-posts" class="button button-load hide" data-posts-endpoint="<?php echo $endpoint; ?>" v-on:click.prevent="fetchPosts"><i class="material-icons">add</i><span>Load More</span></a>

    <?php get_template_part( 'template-parts/page/vue', 'items-history' ); ?>

</div>
