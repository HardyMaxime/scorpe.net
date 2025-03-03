<?php
    get_header();
    // obtenir le param term dans l'url
    $term_id = get_query_var('term') ?? "";
    $products = ProductController::getProducts($term_id);
    $tmp_query = DefaultController::changeWpQuery($products);
?>
<p>
    A rediriger vers la page des produits selon la langue
</p>
<?php get_footer(); ?>