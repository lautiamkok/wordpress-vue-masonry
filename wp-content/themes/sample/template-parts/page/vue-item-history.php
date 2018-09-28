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

<!-- container card -->
<div class="container-card bar-bottom" data-aos="fade-up">

    <!-- card -->
    <div class="card card-history">

        <!-- grid-x -->
        <div class="grid-x grid-padding-x align-stretch full-height">

            <!-- cell -->
            <div class="auto cell small-order-2 large-order-1">

                <div class="card-section full-height">

                    <!-- grid-x -->
                    <div class="grid-x grid-padding-x align-stretch full-height">

                        <!-- cell -->
                        <div class="small-12 cell align-self-top">
                            <h3 class="card-heading">
                                <a :href="item.url" v-html="item.title"></a>
                            </h3>

                            <div class="container-excerpt">
                                <p class="card-excerpt truncate-3" v-html="item.excerpt"></p>
                            </div>
                        </div>
                        <!-- cell -->

                        <!-- cell -->
                        <div class="small-12 cell align-self-bottom">
                            <a :href="item.url" class="button-green uppercase"><?php echo translateText(get_field('read_more', 'option'), $lang); ?></a>
                        </div>
                        <!-- cell -->

                    </div>

                </div>

            </div>
            <!-- cell -->

            <!-- cell -->
            <div class="large-6 cell small-order-1" v-if="item.image.url">
                <div class="card-image scale-fade full-height">
                    <div class="image-background full-height square-image" v-bind:style="{ 'background-image' : 'url(' + item.image.url + ')' }" v-on:click.prevent="traceUrl">
                        <a :href="item.url">
                            <img :src="item.image.url" :alt="item.image.alt">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- grid-x -->

    </div>
    <!-- card -->

</div>
<!-- container card -->
