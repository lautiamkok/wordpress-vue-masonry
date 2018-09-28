<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
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

<footer id="footer" class="hide-for-print">
    <div class="row row-footer">

        <div class="row row-bottom">
            <div class="grid-container">
                <div class="grid-x grid-padding-x align-middle">

                    <!-- cell -->
                    <div class="large-10 medium-9 small-8 cell">

                        <nav class="nav-copyright">
                            <ul class="menu simple hide-for-small-only">
                                <li class="copyright"><?php echo get_option('copyright');?></li>
                                <?php
                                // Include the page nav.
                                get_template_part( 'template-parts/nav', 'footer-copyright' );
                                ?>
                                <li><a href="#"><?php echo translateText(get_field('site_by', 'option'), $lang);?> <span class="bold">STUDIO Sample</span></a></li>
                            </ul>

                            <ul class="menu simple show-for-small-only">
                                <li class="copyright"><?php echo get_option('copyright');?></li>
                                <li><a href="#"><?php echo translateText(get_field('site_by', 'option'), $lang);?> <span class="bold">STUDIO Sample</span></a></li>
                            </ul>
                        </nav>

                    </div>
                    <!-- cell -->

                     <!-- cell -->
                    <div class="large-10 medium-9 small-4 cell show-for-small-only">

                        <nav class="nav-terms">
                            <ul class="menu vertical align-right">
                                <?php
                                // Include the page nav.
                                get_template_part( 'template-parts/nav', 'footer-copyright-mobile' );
                                ?>
                            </ul>
                        </nav>

                    </div>
                    <!-- cell -->

                    <!-- cell -->
                    <div class="large-2 medium-3 small-12 cell show-for-small-only">

                        <nav class="nav-language">
                            <ul class="menu simple align-left">
                                <?php
                                // Include the page nav.
                                get_template_part( 'template-parts/nav', 'lang' );
                                ?>
                            </ul>
                        </nav>

                    </div>
                    <!-- cell -->

                    <!-- cell -->
                    <div class="large-2 medium-3 small-12 cell hide-for-small-only">

                        <nav class="nav-language">
                            <ul class="menu simple align-right">
                                <?php
                                // Include the page nav.
                                get_template_part( 'template-parts/nav', 'lang' );
                                ?>
                            </ul>
                        </nav>

                    </div>
                    <!-- cell -->

                    <div class="small-12 cell show-for-small-only">
                        <a href="#" class="button-to-top button-scroll-up">Back To Top</a>
                    </div>

                </div>
            </div>
        </div>

    </div>

</footer>

<?php wp_footer(); ?>

</body>
</html>
