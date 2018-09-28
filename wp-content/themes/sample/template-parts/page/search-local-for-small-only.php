<?php
/**
 * Displays content for local search on small screens
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

// Get the post by slug.
// https://stackoverflow.com/questions/14979837/wordpress-query-single-post-by-slug
$slug = 'history';
$args = array(
  'name' => $slug,
  'post_type' => 'page',
  'post_status' => 'publish',
  'numberposts' => 1
);
$post = get_posts($args);
$post = $post[0];
?>

<!-- local search - small only -->
<div class="row row-search hide-for-large hide">

    <div class="grid-container full full-height">

        <!-- grid-x -->
        <div class="grid-x small-padding-collapse">

            <div class="small-12 cell cell-search">
                <!-- menu -->
                <div class="container-button">
                    <a href="#" class="button-close button-hide-local-search"><i class="material-icons">close</i></a></li>
                </div>
                <!-- menu -->
            </div>

            <div class="small-12 cell cell-search">
                <h5 class="heading heading-search"><?php echo translateText(get_field('search_history', 'option'), $lang); ?></h5>
            </div>

            <!-- cell/ menu-block-aside -->
            <div class="small-12 cell cell-search">

                <div class="container-search">
                    <form class="form-search" role="search" method="post" action="<?php echo switchUrl(site_url(), $lang); ?>">
                      <div class="grid-container full-height">
                        <div class="grid-x grid-padding-x align-middle small-padding-collapse">
                          <div class="small-10 cell">
                            <label>
                              <input type="text" placeholder="<?php echo translateText(get_field('search', 'option'), $lang);?>" name="s">
                              <input type="hidden" name="search" value="history">
                            </label>
                          </div>
                          <div class="small-2 cell">
                            <a href="#" class="button-search button-show-search float-right flip"><i class="fi-magnifying-glass"></i></a>
                          </div>
                        </div>
                      </div>
                    </form>
                </div>
            </div>
            <!-- cell/ menu-block-aside -->

        </div>
        <!-- grid-x -->

    </div>

</div>
<!-- local search - small only -->
