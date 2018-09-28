<?php
/**
 * Displays publications with vue template.
 *
 * @package WordPress
 * @subpackage Sample
 * @since 1.0
 * @version 1.0
 */
?>

<template v-if="items">

    <!-- row collection -->
    <div class="row row-card">
        <div class="grid-container">
            <div class="grid-x grid-padding-x" v-masonry transition-duration="0.3s" item-selector=".item" :origin-top="true" :horizontal-order="false">

                <!-- vue - loop -->
                <!-- https://laracasts.com/discuss/channels/vue/use-v-for-without-wrapping-element -->
                <template v-for="item in items">

                    <!-- cell -->
                    <div v-masonry-tile class="large-3 medium-4 small-6 cell cell-card item">

                        <!-- container card -->
                        <div class="container-card" data-aos="fade-up">

                            <!-- card -->
                            <div class="card card-collection">
                                <div class="card-image scale-fade">

                                    <?php get_template_part( 'template-parts/page/vue', 'item' ); ?>

                                </div>
                            </div>
                            <!-- card -->

                        </div>
                        <!-- container card -->

                    </div>
                    <!-- cell -->

                </template>
                <!-- vue - loop -->

            </div>
        </div>
    </div>
    <!-- row collection -->

    <div class="container-spinner">
        <div v-if="loading === true" class="sk-circle">
          <div class="sk-circle1 sk-child"></div>
          <div class="sk-circle2 sk-child"></div>
          <div class="sk-circle3 sk-child"></div>
          <div class="sk-circle4 sk-child"></div>
          <div class="sk-circle5 sk-child"></div>
          <div class="sk-circle6 sk-child"></div>
          <div class="sk-circle7 sk-child"></div>
          <div class="sk-circle8 sk-child"></div>
          <div class="sk-circle9 sk-child"></div>
          <div class="sk-circle10 sk-child"></div>
          <div class="sk-circle11 sk-child"></div>
          <div class="sk-circle12 sk-child"></div>
       </div>
    </div>

</template>
