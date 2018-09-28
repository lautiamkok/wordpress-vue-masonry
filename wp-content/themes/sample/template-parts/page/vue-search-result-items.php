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

<!-- publications -->
<div class="container-publications">

    <h3 class="heading-group" v-html="item.parent"></h3>

    <div class="published-item">
        <h5 class="heading-published"><a :href="item.url" v-html="item.title"></a></h5>
        <div class="published-publishers">
            <template v-for="tax in item.taxonomy">
                <span class="published-publisher" v-html="tax.name"></span>
            </template>
        </div>
    </div>

</div>
<!-- publications -->
