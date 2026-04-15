<?php
$thumb = (isset($args['thumb']) ? $args['thumb'] : [] );
$title = (isset($args['title']) ? $args['title'] : [] );
$is_new = ProductController::isNewProduct(get_the_ID());
?>
<a href="<?= esc_url(get_the_permalink()); ?>" class="product-listing-item" >
    <figure class="product-listing-item-figure product-image-outline" >
        <?php if($is_new): ?>
            <span class="badges floating">
                <?= LanguageController::translateStaticText("New", "Nouveau"); ?>
            </span>
        <?php endif; ?>
        <?php if(!empty($thumb)): ?>
            <img src="<?= esc_url($thumb['url']); ?>"
                width="330" height="200" alt="<?= esc_attr($thumb['alt']); ?>" loading="lazy" />
        <?php else: ?>
            <img src="<?= esc_url(ProductController::getDefautThumb()); ?>" 
                width="330" height="200" alt="<?= "Scorpe Technologies - " . esc_attr($title); ?>" loading="lazy" />
        <?php endif; ?>
    </figure>
    <h3 class="product-name link-with-arrow">
        <?= esc_html($title); ?>
    </h3>
</a>