<?php 
    // obtenir le param term dans l'url
    $term_id = get_query_var('term') ?? "";
    $products = ProductController::getProducts($term_id, 12, false, true);
    $tmp_query = DefaultController::changeWpQuery($products);
?>
<?php get_template_part('parts/page/header', null, array(
        "title" => DefaultController::getPageHeading(get_the_ID(), 'title'),
        "description" => DefaultController::getPageHeading(get_the_ID(), 'description'),
        "banner" => DefaultController::getPostThumbnail(get_the_ID()),
        "class_title" => ['no-margin-bottom'],
        "class_subtitle" => [""],
)); ?>
<section class="section section-categories section-dark container-fluid pt-5 pb-5" id="products">
    <?php get_template_part('parts/page/card/teaser', null, array('current_url' => LanguageController::getProductURL())); ?>
</section>