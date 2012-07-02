<?php use_helper('search'); ?>

<div class="span-6">
    <?php search_display_facet($books->getFacets()); ?>
</div>
<div class="span-18 last">
    <?php foreach ($books as $book): ?>
        <?php $data = $book->getData(); ?>
        <li><?php echo sprintf('%s %s %s', $data['name'], $data['description'], $data['category']); ?></li>
    <?php endforeach; ?>
</div>
