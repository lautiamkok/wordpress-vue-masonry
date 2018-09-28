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

<li class="child <?php if(!$lang) { ?>current<?php }?>"><a href="<?php echo switchToEnglish(); ?>">English</a><li>
<li class="child"><span class="divide-vertical">&sol;</span></li>
<li class="child <?php if($lang === 'cn') { ?>current<?php }?>"><a href="<?php echo switchToChinese($lang); ?>">中文</a></li>
