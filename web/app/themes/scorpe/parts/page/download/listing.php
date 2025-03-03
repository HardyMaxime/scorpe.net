<?php
    $categories = ProductController::getProductCategories(false, true);
?>
<?php if($categories): ?>
<div class="download-listing">
    <?php foreach($categories as $key => $category):
        $products = ProductController::getProducts($category->term_id, -1, true, false, true, true); ?>
        <details class="product-details" open data-id="<?= $category->term_id; ?>" >
            <summary class="title-with-arrow-icon white-arrow" >
                <div class="details-title">
                    <?= $category->name; ?>
                </div>
            </summary>
            <?php if($products): ?>
                <?php foreach($products as $key => $product): ?>
                    <div class="download-item">
                        <div class="download-item-title" >
                            <button class="clipboard-button" data-url="<?= esc_attr(get_permalink($product->ID)."?pdf"); ?>" >
                                <span class="clipboard-tooltip" 
                                    data-text="<?= esc_attr(LanguageController::translateStaticText("Copy to clipboard", "Copier dans le presse-papie")); ?>" 
                                    data-text-paste="<?= esc_attr(LanguageController::translateStaticText("URL PDF Copied", "URL PDF Copié")); ?>" >
                                        <?= LanguageController::translateStaticText("Copy to clipboard", "Copier dans le presse-papie"); ?>
                                </span>
                                <span class="text-ident" ><?= LanguageController::translateStaticText("Copy to clipboard", "Copier dans le presse-papie"); ?></span>
                            </button>
                            <a href="<?= esc_url(get_permalink($product->ID)); ?>" target="_blank">
                                <strong><?= $product->post_title; ?> :</strong>
                            </a>
                        </div>
                        <a href="<?= esc_url(get_permalink($product->ID)."?pdf"); ?>" rel="noopener external" target="_blank">
                            <?= LanguageController::translateStaticText("Technical specifications", "Fiche technique"); ?>
                        </a>
                        <?php if(ProductController::getFiles($product->ID, "manual")): ?>
                            <a href="<?= esc_url(ProductController::getFiles($product->ID, "manual")['url']); ?>" rel="noopener external" target="_blank">
                                <?= LanguageController::translateStaticText("User manual", "Manuel d'utilisation"); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </details>
    <?php endforeach; ?>
</div>
<?php endif; ?>