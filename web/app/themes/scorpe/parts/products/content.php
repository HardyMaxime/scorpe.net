<?php if(!empty(ProductController::getProductContent(get_the_id(), 'description'))): ?>
    <?php get_template_part('parts/products/detail/detail', null, array(
        'open' => true,
        'title' => 'Description',
        'content' => ProductController::getProductContent(get_the_id(), 'description')
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
         'title' => LanguageController::currentLanguage() == "en" ? "Advantages" : "Avantages",
         'content' => ProductController::getProductContent(get_the_id(), 'advantages')
    )); ?>
<?php endif; ?>
<?php if(!empty(ProductController::getProductAccessories(get_the_ID()))): ?>
    <?php get_template_part('parts/products/accessorie'); ?>
<?php endif; ?>