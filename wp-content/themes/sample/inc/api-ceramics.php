<?php
/**
 * Sample APIs
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Sample
 * @since 1.0
 * @version 1.0
 */

/**
 * Custom JSON API endpoint.
 * Usage: http://127.0.1.1/repo-github/wordpress-vue-masonry/wp-json/ceramics/v1/lang/en/parent/2/page/1
 * https://developer.wordpress.org/rest-api/extending-the-rest-api/adding-custom-endpoints/
 * https://webdevstudios.com/2015/07/09/creating-simple-json-endpoint-wordpress/
 */
function api_ceramics($data) {
    $output = array();

    // e.g. 1, 2, 3,...
    $paged = $data['page_number'] ? $data['page_number'] : 1;
    $lang = $data['lang'];
    $query_args = array(
        'post_type' => 'ceramic',
        'post_status' => array('publish'),
        'posts_per_page' => 4,
        'paged' => $paged,
        'orderby' => 'date',

        // Specific year.
        // 'year' => 2016,

        // Specific category.
        // 'cat' => '', // e.g. 1, 2, 3, 4, ...
        // 'category_name' => 'events', // .e.g. news, events, ...

        // Exclude meta specific key.
        // https://core.trac.wordpress.org/ticket/18158
        // 'meta_query' => array(
        //     array(
        //         'key' => 'java_meta_feature',
        //         'compare' => 'NOT EXISTS'
        //     ),
        // )
    );

    // Create a new instance of WP_Query
    $the_query = new WP_Query($query_args);

    if (!$the_query->have_posts()) {
        return null;
    }

    while ($the_query->have_posts()) {
        $the_query->the_post();

        $post_id = get_the_ID();

        // Get the slug.
        // https://wordpress.stackexchange.com/questions/11426/how-can-i-get-page-slug
        $post = get_post($post_id);
        $post_slug = $post->post_name;

        $post_title = translateTitle($post, $lang);
        $post_mode = get_field('image_mode', $post_id);

        $post_url = switchLink(get_permalink($post_id), $lang);

        // Get image alt.
        // https://stackoverflow.com/questions/19267650/get-wordpress-featured-image-alt
        $alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
        $desc = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_caption', true);

        // Get image description.
        // https://wordpress.stackexchange.com/questions/111937/how-to-show-featured-image-caption-only-if-it-exist
        $description = null;
        $thumbnail = get_posts(array('p' => get_post_thumbnail_id(), 'post_type' => 'attachment'));
        if ($thumbnail && isset($thumbnail[0])) {
            $description = $thumbnail[0]->post_content;
        }

        // Image data.
        $post_image = array(
            'id' => get_post_thumbnail_id() ,
            'url'  => get_the_post_thumbnail_url(),
            'caption' => get_the_post_thumbnail_caption(),
            'alt' => $alt,
            'description' => $description,
        );

        // Push the post data into the array.
        $output[] = array(
            'id' => $post_id, // cannot use numbers, or hyphens between words for Zurb data toggle attribute
            'slug' => $post_slug,
            'title' => $post_title,
            'url' => $post_url,
            'image' => $post_image,
            'mode' => $post_mode
        );
    }

    // Reset the post to the original after loop. otherwise the current page
    // becomes the last item from the while loop.
    wp_reset_query();

    return $output;
}
add_action('rest_api_init', function () {
    register_rest_route('ceramics/v1', '/lang/(?P<lang>[a-zA-Z0-9-]+)/parent/(?P<parent_id>\d+)/page/(?P<page_number>\d+)', array(
        'methods' => 'GET',
        'callback' => 'api_ceramics',
    ));
});

/**
 * Custom JSON API endpoint.
 * Usage: http://127.0.0.1/projects/andrew-collections-wordpress/wp-json/ceramics/v1/lang/en/category/bird-feeders/page/1
 * https://developer.wordpress.org/rest-api/extending-the-rest-api/adding-custom-endpoints/
 * https://webdevstudios.com/2015/07/09/creating-simple-json-endpoint-wordpress/
 */
function api_ceramics_by_category($data) {
    $output = array();

    // e.g. 1, 2, 3,...
    $paged = $data['page_number'] ? $data['page_number'] : 1;
    $lang = $data['lang'];
    $category_slug = $data['category_slug'];
    $query_args = array(
        'post_type' => 'ceramic',
        'post_status' => array('publish'),
        'posts_per_page' => 4,
        // 'post_parent' => 2,
        'paged' => $paged,
        'orderby' => 'date',

        // Specific year.
        // 'year' => 2016,

        // Specific category.
        // 'cat' => $cat_id, // e.g. 1, 2, 3, 4, ...
        // 'category_name' => $category_slug, // .e.g. news, events, ...

        'tax_query' => array(
            array (
                'taxonomy' => 'ceramic-category',
                'field' => 'slug', //this is by slug
                'terms' => $category_slug, // slug name
            )
        ),
    );

    // Create a new instance of WP_Query
    $the_query = new WP_Query($query_args);
    if (!$the_query->have_posts()) {
        return null;
    }

    while ($the_query->have_posts()) {
        $the_query->the_post();

        $post_id = get_the_ID();

        // Get the slug.
        // https://wordpress.stackexchange.com/questions/11426/how-can-i-get-page-slug
        $post = get_post($post_id);
        $post_slug = $post->post_name;

        $post_title = translateTitle($post, $lang);
        $post_mode = get_field('image_mode', $post_id);

        $post_url = switchLink(get_permalink($post_id), $lang);

        // Get image alt.
        // https://stackoverflow.com/questions/19267650/get-wordpress-featured-image-alt
        $alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
        $desc = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_caption', true);

        // Get image description.
        // https://wordpress.stackexchange.com/questions/111937/how-to-show-featured-image-caption-only-if-it-exist
        $description = null;
        $thumbnail = get_posts(array('p' => get_post_thumbnail_id(), 'post_type' => 'attachment'));
        if ($thumbnail && isset($thumbnail[0])) {
            $description = $thumbnail[0]->post_content;
        }

        // Image data.
        $post_image = array(
            'id' => get_post_thumbnail_id() ,
            'url'  => get_the_post_thumbnail_url(),
            'caption' => get_the_post_thumbnail_caption(),
            'alt' => $alt,
            'description' => $description,
        );

        // Push the post data into the array.
        $output[] = array(
            'id' => $post_id, // cannot use numbers, or hyphens between words for Zurb data toggle attribute
            'slug' => $post_slug,
            'title' => $post_title,
            'url' => $post_url,
            'image' => $post_image,
            'mode' => $post_mode
        );
    }

    // Reset the post to the original after loop. otherwise the current page
    // becomes the last item from the while loop.
    wp_reset_query();

    return $output;
}
add_action('rest_api_init', function () {
    register_rest_route('ceramics/v1', '/lang/(?P<lang>[a-zA-Z0-9-]+)/category/(?P<category_slug>[a-zA-Z0-9-]+)/page/(?P<page_number>\d+)', array(
        'methods' => 'GET',
        'callback' => 'api_ceramics_by_category',
    ));
});
