<?php  $product_gallery = ProductController::getProductGallery(get_the_ID()); ?>

<section class="section product-preview mb-5">
    <div class="section-media reverse reveal">
            <?php if($product_gallery): ?>
                <div class="section-content-figure figure-shape product-image-outline splide strech-slider">
                    <div class="splide__track">
                        <div class="splide__list">
                            <?php foreach($product_gallery as $key => $image): ?>
                                <figure class="splide__slide product-image-inner" >
                                    <a href="<?= esc_url($image['url']); ?>" class="glightbox">
                                        <img src="<?= esc_url($image['url']); ?>" class="contain" alt="" 
                                            width="770" height="585" loading="lazy" />
                                    </a>
                                </figure>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php if(count($product_gallery) > 1): ?>
                    <div class="splide__arrows"></div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <div class="section-content product-description">
            <?php if(!empty(ProductController::getProductContent(get_the_id(), 'description'))): ?>
                <?= ProductController::getProductContent(get_the_id(), 'description'); ?>
            <?php endif; ?>
        </div>
    </div>
</section>
<section class="products-details">
    <?php if(!empty(ProductController::getProductContent(get_the_id(), 'characteristic')) || !empty(DefaultController::field_value('product_characteristic_table', get_the_id()))): ?>
        <?php get_template_part('parts/products/detail/detail', null, array(
             'open' => true,
             'title' => LanguageController::currentLanguage() == "en" ? "Characteristics" : "Caractéristiques",
             'content' => ProductController::getProductContent(get_the_id(), 'characteristic'),
             'table' => DefaultController::field_value('product_characteristic_table', get_the_id()),
        )); ?>
    <?php endif; ?>
    <?php if(!empty(ProductController::getProductContent(get_the_id(), 'advantages'))): ?>
        <?php get_template_part('parts/products/detail/detail', null, array(
            'open' => true,
            'title' =>  LanguageController::currentLanguage() == "en" ? "Advantages" : "Avantages",
            'content' => ProductController::getProductContent(get_the_id(), 'advantages')
        )); ?>
    <?php endif; ?>
    <?php if(!empty(ProductController::getProductAccessories(get_the_ID()))): ?>
        <?php get_template_part('parts/products/accessorie'); ?>
    <?php endif; ?>
</section>