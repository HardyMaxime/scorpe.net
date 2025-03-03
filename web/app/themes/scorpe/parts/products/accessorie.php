<?php
    $accessories = ProductController::getProductAccessories(get_the_ID());
    $is_accessory = ProductController::isAccessorie(get_the_ID());
?>
<details class="product-details" open >
    <summary class="title-with-arrow-icon white-arrow" >
        <div class="details-title">
            <?php if(LanguageController::currentLanguage() == "en"): ?>
                <?= ($is_accessory) ? "Related products" : "Accessories"; ?>
            <?php else: ?>
                <?= ($is_accessory) ? "Produits associés" : "Accessoires"; ?>
            <?php endif; ?>
        </div>
    </summary>
    <div class="details-content">
        <div class="accessories-thumbs">
            <?php foreach($accessories as $id => $accessorie): ?>
                <a href="<?= esc_url(get_permalink($accessorie->ID)); ?>">
                    <img src="<?= esc_url(ProductController::getProductThumbnails($accessorie->ID, 'url')); ?>" 
                        width="140" height="140" loading="lazy" alt="<?= esc_attr(ProductController::getProductThumbnails($accessorie->ID, 'alt')); ?>">
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</details>