<?php get_header();
    global $wp_query;
?>
    <section class="section-page section section-search container flex-grow">
        <hgroup>
            <hgroup class="section-heading">
                <h1 class="section-title title-secondary">
                    <?= LanguageController::translateStaticText("Search result", "Votre recherche"); ?>
                </h1>
                <?php if(LanguageController::currentLanguage() == "en"): ?>
                    <p class="section-subtitle section-subtitle-full section-subtitle-full-left text-align-left">
                        For your search <strong>« <?= get_search_query() ?> »</strong>, we found <?= $wp_query->found_posts; ?> result(s)
                    </p>
                <?php else: ?>
                    <p class="section-subtitle section-subtitle-full section-subtitle-full-left text-align-left">
                        Pour votre recherche <strong>« <?= get_search_query() ?> »</strong>, nous avons trouvé <?= $wp_query->found_posts; ?> résultat(s)
                    </p>
                <?php endif; ?>
            </hgroup>
        </hgroup>
        <?php if (have_posts()): ?>
            <section class="section-search-content">
                <div class="product-listing">
                    <?php while (have_posts()) : the_post();
                        $thumb = ProductController::getProductThumbnails(get_the_ID(), null, "listing");
                    ?>
                        <?php get_template_part('parts/products/listing_item', null, array(
                            'thumb' => $thumb,
                            'title' => get_the_title(),
                        )); ?>
                    <?php endwhile; ?>
                </div>
                <?= DefaultController::clbs_pagination($paged); ?>
            </section>
        <?php else: ?>
            <section class="section-search-content">
                <div class="no-result">
                    <button type="button" class="open-search link-with-arrow" >
                        <?= LanguageController::translateStaticText("Start a new search", "Lancer une nouvelle recherche"); ?>
                    </button>
                </div>
            </section>
        <?php endif; ?>
        <section class="section-search-categories" >
            <hgroup class="section-heading">
                <h2 class="section-title title-ternary">
                    <?= LanguageController::translateStaticText("Our products by category", "Nos produits par catégories"); ?>
                </h2>
                <?php if(LanguageController::currentLanguage() == "en"): ?>
                    <p class="section-subtitle section-subtitle-full section-subtitle-full-left">
                        To help you find the product you are looking for, we have classified our products by category
                    </p>
                <?php else: ?>
                    <p class="section-subtitle section-subtitle-full section-subtitle-full-left">
                        Pour vous aider à trouver le produit que vous cherchez, nous avons classé nos produits par catégorie
                    </p>
                <?php endif; ?>
            </hgroup>
            <?php get_template_part('parts/page/card/teaser', null, array('current_url' => LanguageController::getProductURL(), 'term_id' => null)); ?>
        </section>
    </section>
<?php get_footer(); ?>