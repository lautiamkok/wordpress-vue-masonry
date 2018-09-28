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
 * Usage: http://127.0.1.1/repo-github/wordpress-vue-masonry/wp-json/search/v1/lang/en/keywords/something+amazing/page/1
 * https://developer.wordpress.org/rest-api/extending-the-rest-api/adding-custom-endpoints/
 * https://webdevstudios.com/2015/07/09/creating-simple-json-endpoint-wordpress/
 */
function api_global_search($data) {
    $output = array();

    // e.g. 1, 2, 3,...
    $paged = $data['page_number'] ? $data['page_number'] : 1;
    $lang = $data['lang'];
    $keywords = $data['keywords'];
    $query_args = array(
        's' => $keywords,
        'post_type' => array(
            'ceramic',
            'textile',
        ),
        'post_status' => array('publish'),
        'posts_per_page' => 4,
        'paged' => $paged,
        'orderby' => 'date',
    );

    // Create a new instance of WP_Query
    $the_query = new WP_Query($query_args);

    if (!$the_query->have_posts()) {
        return null;
    }

    // Get the total number of the search result.
    $query_args = array(
        's' => $keywords,
        'post_type' => array(
            'ceramic',
            'textile',
        ),
        'post_status' => array('publish'),
        'showposts' => 0,
    );
    $allsearch = new WP_Query($query_args);
    $total = $allsearch ->found_posts;

    while ($the_query->have_posts()) {
        $the_query->the_post();

        $post_id = get_the_ID();

        // Get the slug.
        // https://wordpress.stackexchange.com/questions/11426/how-can-i-get-page-slug
        $post = get_post($post_id);
        $post_slug = $post->post_name;

        $post_title = translateTitle($post, $lang);
        $post_excerpt = translateText(get_the_excerpt(), $lang);
        $post_date = get_the_date('j M Y');
        $post_type = get_post_type();

        // Get post url.
        $post_url = switchLink(get_permalink($post_id), $lang);

        // Get the taxonomy that attached to the post.
        $taxonomy = get_the_terms($post, 'ceramic-category');
        if ($post_type === 'textile') {
            $taxonomy = get_the_terms($post, 'textile-category');
        }
        $taxonomy = translateTextInArray($items = $taxonomy, $search = 'name', $lang);

        // Get the post by slug.
        // https://stackoverflow.com/questions/14979837/wordpress-query-single-post-by-slug
        $parentSlug = 'ceramics';
        if ($post_type === 'textile') {
            $parentSlug = 'textiles';
        }
        $args = array(
          'name' => $parentSlug,
          'post_type' => 'page',
          'post_status' => 'publish',
          'numberposts' => 1
        );
        $parent = get_posts($args);
        $parent_title = translateTitle($parent[0], $lang);

        // Push the post data into the array.
        $output[] = array(
            'id' => $post_id,
            'slug' => $post_slug,
            'title' => $post_title,
            'url' => $post_url,
            'date' => $post_date,
            'taxonomy' => $taxonomy,
            'type' => $post_type,
            'parent' => $parent_title,
            'total' => $total,
        );
    }

    // Reset the post to the original after loop. otherwise the current page
    // becomes the last item from the while loop.
    wp_reset_query();

    return $output;
}
add_action('rest_api_init', function () {
    // Include spaces in the search.
    // https://wordpress.stackexchange.com/questions/269149/rest-api-custom-endpoint-with-space-character
    register_rest_route('search/v1', '/lang/(?P<lang>[a-zA-Z0-9-]+)/keywords/(?P<keywords>([a-zA-Z0-9-\+])+)/page/(?P<page_number>\d+)', array(
        'methods' => 'GET',
        'callback' => 'api_global_search',
    ));
});

/**
 * Custom JSON API endpoint.
 * Usage: http://127.0.1.1/repo-github/wordpress-vue-masonry/wp-json/search/v1/lang/en/keywords/something+amazing/year/2016/page/1
 * https://developer.wordpress.org/rest-api/extending-the-rest-api/adding-custom-endpoints/
 * https://webdevstudios.com/2015/07/09/creating-simple-json-endpoint-wordpress/
 */
function api_global_search_by_year($data) {
    $output = array();

    // e.g. 1, 2, 3,...
    $paged = $data['page_number'] ? $data['page_number'] : 1;
    $lang = $data['lang'];
    $keywords = $data['keywords'];
    $year = $data['year'];
    $query_args = array(
        's' => $keywords,
        'post_type' => array(
            'ceramic',
            'textile',
        ),
        'post_status' => array('publish'),
        'posts_per_page' => 4,
        'paged' => $paged,
        'orderby' => 'date',

        // Specific year.
        'year' => $year,
    );

    // Create a new instance of WP_Query
    $the_query = new WP_Query($query_args);

    if (!$the_query->have_posts()) {
        return null;
    }

    // Get the total number of the search result.
    $query_args = array(
        's' => $keywords,
        'post_type' => array(
            'ceramic',
            'textile',
        ),
        'post_status' => array('publish'),
        'showposts' => 0,

        // Specific year.
        'year' => $year,
    );
    $allsearch = new WP_Query($query_args);
    $total = $allsearch ->found_posts;

    while ($the_query->have_posts()) {
        $the_query->the_post();

        $post_id = get_the_ID();

        // Get the slug.
        // https://wordpress.stackexchange.com/questions/11426/how-can-i-get-page-slug
        $post = get_post($post_id);
        $post_slug = $post->post_name;

        $post_title = translateTitle($post, $lang);
        $post_excerpt = translateText(get_the_excerpt(), $lang);
        $post_date = get_the_date('j M Y');
        $post_type = get_post_type();

        // Get post url.
        $post_url = switchLink(get_permalink($post_id), $lang);

        // Get the taxonomy that attached to the post.
        $taxonomy = get_the_terms($post, 'ceramic-category');
        if ($post_type === 'textile') {
            $taxonomy = get_the_terms($post, 'textile-category');
        }
        $taxonomy = translateTextInArray($items = $taxonomy, $search = 'name', $lang);

        // Push the post data into the array.
        $output[] = array(
            'id' => $post_id,
            'slug' => $post_slug,
            'title' => $post_title,
            'url' => $post_url,
            'date' => $post_date,
            'taxonomy' => $taxonomy,
            'type' => $post_type,
            'total' => $total,
        );
    }

    // Reset the post to the original after loop. otherwise the current page
    // becomes the last item from the while loop.
    wp_reset_query();

    return $output;
}
add_action('rest_api_init', function () {
    // Include spaces in the search.
    // https://wordpress.stackexchange.com/questions/269149/rest-api-custom-endpoint-with-space-character
    register_rest_route('search/v1', '/lang/(?P<lang>[a-zA-Z0-9-]+)/keywords/(?P<keywords>([a-zA-Z0-9-\+])+)/year/(?P<year>[a-zA-Z0-9-]+)/page/(?P<page_number>\d+)', array(
        'methods' => 'GET',
        'callback' => 'api_global_search_by_year',
    ));
});

/**
 * Custom JSON API endpoint.
 * Usage: http://127.0.1.1/repo-github/wordpress-vue-masonry/wp-json/search/v1/lang/en/keywords/something+amazing/type/video/page/1
 * https://developer.wordpress.org/rest-api/extending-the-rest-api/adding-custom-endpoints/
 * https://webdevstudios.com/2015/07/09/creating-simple-json-endpoint-wordpress/
 */
function api_global_search_by_type($data) {
    $output = array();

    // e.g. 1, 2, 3,...
    $paged = $data['page_number'] ? $data['page_number'] : 1;
    $lang = $data['lang'];
    $keywords = $data['keywords'];
    $type = $data['type'];
    $query_args = array(
        's' => $keywords,
        'post_type' => $type,
        'post_status' => array('publish'),
        'posts_per_page' => 4,
        'paged' => $paged,
        'orderby' => 'date',
    );

    // Create a new instance of WP_Query
    $the_query = new WP_Query($query_args);

    if (!$the_query->have_posts()) {
        return null;
    }

    // Get the total number of the search result.
    $allsearch = new WP_Query("s=" . $keywords . "&post_type=" . $type . "&showposts=0");
    $total = $allsearch ->found_posts;

    while ($the_query->have_posts()) {
        $the_query->the_post();

        $post_id = get_the_ID();

        // Get the slug.
        // https://wordpress.stackexchange.com/questions/11426/how-can-i-get-page-slug
        $post = get_post($post_id);
        $post_slug = $post->post_name;

        $post_title = translateTitle($post, $lang);
        $post_excerpt = translateText(get_the_excerpt(), $lang);
        $post_date = get_the_date('j M Y');
        $post_type = get_post_type();

        // Get post url.
        $post_url = switchLink(get_permalink($post_id), $lang);

        // Get the taxonomy that attached to the post.
        $taxonomy = get_the_terms($post, 'ceramic-category');
        if ($post_type === 'textile') {
            $taxonomy = get_the_terms($post, 'textile-category');
        }
        $taxonomy = translateTextInArray($items = $taxonomy, $search = 'name', $lang);

        // Push the post data into the array.
        $output[] = array(
            'id' => $post_id,
            'slug' => $post_slug,
            'title' => $post_title,
            'url' => $post_url,
            'date' => $post_date,
            'taxonomy' => $taxonomy,
            'type' => $post_type,
            'total' => $total,
        );
    }

    // Reset the post to the original after loop. otherwise the current page
    // becomes the last item from the while loop.
    wp_reset_query();

    return $output;
}
add_action('rest_api_init', function () {
    // Include spaces in the search.
    // https://wordpress.stackexchange.com/questions/269149/rest-api-custom-endpoint-with-space-character
    register_rest_route('search/v1', '/lang/(?P<lang>[a-zA-Z0-9-]+)/keywords/(?P<keywords>([a-zA-Z0-9-\+])+)/type/(?P<type>[a-zA-Z0-9-]+)/page/(?P<page_number>\d+)', array(
        'methods' => 'GET',
        'callback' => 'api_global_search_by_type',
    ));
});

