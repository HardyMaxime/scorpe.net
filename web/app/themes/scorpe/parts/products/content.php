<?php  $product_gallery = ProductController::getProductGallery(get_the_ID()); ?>

<?php if(!empty(DefaultController::field_value('product_short_description', get_the_id()))): ?>
<section class="section product-preview mb-5">
    <div class="reveal">
        <div class="product-description">
                <?= DefaultController::field_value('product_short_description', get_the_id()); ?>
            </div>
        </div>
    </section>
<?php endif; ?>
<section class="products-details" id="details">
    <?php if(!empty(ProductController::getProductContent(get_the_id(), 'description')) || !empty(DefaultController::field_value('product_characteristic_table', get_the_id())) || $product_gallery): ?>
        <?php get_template_part('parts/products/detail/detail', null, array(
             'open' => true,
             'title' => LanguageController::currentLanguage() == "en" ? "Description" : "Description",
             'content' => ProductController::getProductContent(get_the_id(), 'description'),
             'table' => DefaultController::field_value('description', get_the_id()),
             'gallery' => $product_gallery,
        )); ?>
    <?php endif; ?>
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