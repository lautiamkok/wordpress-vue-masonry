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

<div v-if="item.mode ==='portrait'" class="image-background xtra-portrait-image" v-bind:style="{ 'background-image' : 'url(' + item.image.url + ')' }" v-on:click.prevent="traceUrl">
    <a :href="item.url">
        <img :src="item.image.url" :alt="item.image.alt">
    </a>
</div>

<div v-else class="image-background landscape-image" v-bind:style="{ 'background-image' : 'url(' + item.image.url + ')' }"  v-on:click.prevent="traceUrl">
    <a :href="item.url">
        <img :src="item.image.url" :alt="item.image.alt">
    </a>
</div>
