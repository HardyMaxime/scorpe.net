<?php
    $cat = get_queried_object();
    $cat_id = $cat->term_id;
    $products = ProductController::getProducts($cat_id, -1);
    $tmp_query = DefaultController::changeWpQuery($products);
    $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
?>
<?php get_template_part('parts/category/header', null, array(
        "cat" => $cat,
        "title" => single_cat_title( '', false ),
        "description" => (category_description( $cat_id )),
        "banner" => DefaultController::field_value("categ_thumb", "term_{$cat_id}")
)); ?>
<section class="section-page section container section-white overflow-x">
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