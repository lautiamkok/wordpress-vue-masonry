<?php
/**
 * The template used for displaying page nav
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

<?php if(!$lang) { ?>
<li class="current"><a href="<?php echo switchToEnglish(); ?>" class="button-language">ENG <i class="material-icons mi-arrow-down">keyboard_arrow_down</i></a></li>
<li><a href="<?php echo switchToChinese($lang); ?>" class="button-language">中文</a></li>
<?php }?>

<?php if($lang) { ?>
<li class="current"><a href="<?php echo switchToChinese($lang); ?>" class="button-language">中文 <i class="material-icons mi-arrow-down">keyboard_arrow_down</i></a></li>
<li><a href="<?php echo switchToEnglish(); ?>" class="button-language">ENG</a></li>
<?php }?>
