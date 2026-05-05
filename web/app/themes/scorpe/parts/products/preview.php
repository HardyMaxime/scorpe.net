<?php
    $product_gallery = ProductController::getProductGallery(get_the_ID());
    $product_preview_decription = ProductController::getPreviewContent(get_the_id(), 'description');
?>
<section class="section product-preview section-dark mb-5">
    <div class="section-media reverse container reveal">
        <?php if($product_gallery): ?>
            <div class="section-content-figure figure-shape product-image-outline splide strech-slider">
                <div class="splide__track">
                    <div class="splide__list">
                        <?php foreach($product_gallery as $key => $image): ?>
                            <figure class="splide__slide" >
                                <img src="<?= esc_url($image['url']); ?>" class="cover" alt="" 
                                width="770" height="585" loading="lazy" />
                            </figure>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php if(count($product_gallery) > 1): ?>
                <div class="splide__arrows"></div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <div class="section-content">
            <hgroup class="heading separator mb-3">
                <h2 class="title">
                    <?= ProductController::getPreviewContent(get_the_id(), 'title'); ?>
                </h2>
                <?php if(!empty($product_preview_decription)): ?>
                    <p class="subtitle">
                        <?= $product_preview_decription; ?>
                    </p>
                <?php endif; ?>
            </hgroup>
            <p class="section-content-text mb-3">
                <?= ProductController::getProductContent(get_the_id(), 'advantages'); ?>
            </p>
            <a href="#details" class="button">
                <?= LanguageController::translateStaticText("Description", "En savoir plus"); ?>
            </a>
            <a href="<?= esc_url(home_url('contact')); ?>" class="button">
                <?= LanguageController::translateStaticText("Get in touch", "Contactez-nous."); ?>
            </a>
        </div>
    </div>
</section>