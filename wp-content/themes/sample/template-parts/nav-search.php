<?php
/**
 * The template used for displaying global search form.
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
?>

<?php
// Get current tax.
// https://stackoverflow.com/questions/12289169/how-do-i-get-current-taxonomy-term-id-on-wordpress
$queired = $wp_query->get_queried_object();
$isHistory = $queired->post_name === 'history' || $queired->post_type === 'history' ? true : false;
if (is_search() && ! empty( $_POST['search'])) {
    $isHistory = true;
}
?>

<form class="form-search" role="search" method="post" action="<?php echo switchUrl(site_url(), $lang); ?>">
  <div class="grid-container full-height">
    <div class="grid-x grid-padding-x align-middle small-padding-collapse">

        <div class="flex-item">
            <a href="#" class="button-search button-show-search float-right flip flex-search"><i class="fi-magnifying-glass"></i></a>
        </div>

        <div class="flex-item container-input position-relative">
            <input type="text" placeholder="<?php echo translateText(get_field('search', 'option'), $lang);?>" class="hide" name="s">
            <?php if ($isHistory === true) { ?>
            <input type="hidden" name="search" value="history">
            <?php } ?>
        </div>

    </div>
  </div>
</form>
