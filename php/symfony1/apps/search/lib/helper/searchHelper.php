<?php

function search_display_facet($facets)
{
    echo '<p>Category</p>';
    echo '<ul>';
    foreach ($facets as $facet) {
        if (count($facet['terms'] > 0)) {
            foreach ($facet['terms'] as $term) {
                echo sprintf('<li>%s (%s)</li>', $term['term'], $term['count']);
            }
        }
    }
    echo '</ul>';
}
