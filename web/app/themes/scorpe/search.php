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
                    <?php while (have_posts()) : the_post(); ?>
                        <a href="<?= get_the_permalink(); ?>" class="product-listing-item">
                            <?php if(ProductController::getProductThumbnails(get_the_ID(), true)): ?>
                                <img src="<?= esc_url(ProductController::getProductThumbnails(get_the_ID(), "url")); ?>" 
                                    width="330" height="200" alt="<?= esc_attr(ProductController::getProductThumbnails(get_the_id(),"alt")); ?>" loading="lazy" />
                            <?php else: ?>
                                <img src="<?= esc_url(ProductController::getDefautThumb()); ?>" 
                                    width="330" height="200" alt="<?= "Scorpe Technologies - " . esc_attr(get_the_title()); ?>" loading="lazy" />
                            <?php endif; ?>
                            <h3 class="product-name link-with-arrow">
                                <?= esc_html(get_the_title()); ?>
                            </h3>
                        </a>
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
            <?php get_template_part('parts/products/categories', null, array('current_url' => get_permalink(12), 'term_id' => null)); ?>
        </section>
    </section>
<?php get_footer(); ?>