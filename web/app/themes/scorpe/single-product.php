<?php
    DomPDFController::generatePageToPDF(get_the_ID());
    get_header();
    $term_id = get_the_terms(get_the_ID(), 'category')[0]->term_id ?? "";
    $hasVideo = (!empty(ProductController::hasVideo(get_the_ID())) ?? false);
?>
<?php get_template_part("parts/products/header"); ?>
<section class="section section-page section-content container overflow-x no-padding-top">
    <section class="section-content">
        <?php get_template_part("parts/products/preview"); ?>
        <section class="product-details-wrapper">
            <?php get_template_part('parts/products/content'); ?>
        </section>
        <section class="product-contact">
            <a href="<?= esc_url(home_url('contact')); ?>" class="button" >
                <?= LanguageController::translateStaticText("Call us for more informations", "Pour plus d'informations, contactez-nous."); ?>
            </a>
        </section>
        <?php if(!empty(ProductController::hasVideo(get_the_ID()))): ?>
            <?php get_template_part('parts/products/demonstration'); ?>
        <?php endif; ?>
        <?php if($term_id):
            $related_products = array();
            $related_products = ProductController::getProducts($term_id); ?>
            <section id="product-crossselling-slider" class="splide product-crossselling" aria-label="Basic Structure Example">
                <h3>OTHER PRODUCTS THAT MIGHT INTEREST YOU</h3>
                <?php get_template_part('parts/products/related', null, array('term_id' => $term_id, 'related_products' => $related_products)); ?>
            </section>
        <?php endif; ?>
    </section>
</section>
<?php get_footer(); ?>