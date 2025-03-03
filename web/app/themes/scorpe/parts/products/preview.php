<?php
    $product_details = DefaultController::field_value("product_pinned", get_the_ID());
?>
<div class="product-preview">
    <?php if(false && !empty(ProductController::getProductContent(get_the_id(), 'description'))): ?>
        <p class="product-description">
            <?= ProductController::getProductContent(get_the_id(), 'description'); ?>
        </p>
    <?php endif; ?>
    <?php if(!empty($product_details)): ?>
        <figure class="product-image-outline" >
            <img class="product-preview-image" src="<?= esc_url($product_details['url']); ?>" alt="<?= esc_attr($product_details['alt']); ?>"
                width="1425" height="500" loading="lazy" />
        </figure>
    <?php endif; ?>
    <?php if(false && ProductController::getFiles(get_the_ID(), 'datasheet')): ?>
        <a href="<?= esc_url(ProductController::getFiles(get_the_ID(), 'datasheet')['url']); ?>" target="_blank" class="button" >
            <?= LanguageController::translateStaticText("Technical characteristics", "Caractéristiques techniques"); ?>
        </a>
    <?php endif; ?>
</div>