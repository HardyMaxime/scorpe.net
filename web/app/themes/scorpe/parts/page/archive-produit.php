<?php 
    // obtenir le param term dans l'url
    $term_id = get_query_var('term') ?? "";
    $products = ProductController::getProducts($term_id, 12, false, true);
    $tmp_query = DefaultController::changeWpQuery($products);
?>
<section class="section-page section container section-white overflow-x">
    <?php get_template_part('parts/page/heading', null, array(
           "title" => DefaultController::getPageHeading(get_the_ID(), 'title'),
           "description" => DefaultController::getPageHeading(get_the_ID(), 'description'),
            "class_title" => ['no-margin-bottom'],
            "class_subtitle" => [""],
    )); ?>
    <?php get_template_part('parts/products/categories', null, array('term_id' => $term_id)); ?>
    <?php if($products->have_posts()): ?>
        <?php get_template_part("parts/products/listing", null, array('products' => $products)); ?>
        <?php
            DefaultController::clbs_pagination($paged);
            DefaultController::resetWpQuery($tmp_query);
            wp_reset_postdata();
        ?>
    <?php else: ?>
        <section class="no-result">
            <?= LanguageController::translateStaticText("No product found", "Aucun produit trouvé"); ?>
        </section>
    <?php endif; ?>
</section>