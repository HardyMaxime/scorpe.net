<?php
    $banner = ProductController::getProductBanner(get_the_ID(), "background");
    $mobile = ProductController::getProductBanner(get_the_ID(), "mobile");
    $alt = ProductController::getProductBanner(get_the_ID(), "alt");
?>
<header class="header page-header">
    <figure class="header-background reveal" >
        <picture>
            <source srcset="<?= esc_url($banner); ?>" media="(min-width:768px)" />
            <img src="<?= esc_url($mobile); ?>" alt="<?= esc_attr($alt); ?>" class="cover anime-scale"
            width="600" height="860" loading="lazy" />
        </picture>
    </figure>
    <div class="header-content reveal">
        <div class="header-content-inner slide-out-in reveal-4">
            <?php get_template_part('parts/breadcrumb/breadcrumb', null, array(
                'post_id' => get_the_ID()
            )); ?>
            <hgroup class="header-title">
                <h1 class="title">
                    <?= the_title(); ?>
                </h1>
                <p class="subtitle">
                    <?= get_the_excerpt(); ?>
                </p>
            </hgroup>
            <div class="single-products-links">
                <?php if(ProductController::getFiles(get_the_ID(), 'datasheet')): ?>
                    <a href="<?= esc_url(ProductController::getFiles(get_the_ID(), 'datasheet')['url']); ?>" target="_blank" class="button" >
                        <?= LanguageController::translateStaticText("Technical characteristics", "Caractéristiques techniques"); ?>
                    </a>
                <?php endif; ?>
                <?php if(ProductController::getFiles(get_the_ID(), 'manual')): ?>
                    <a href="<?= esc_url(ProductController::getFiles(get_the_ID(), 'manual')['url']); ?>" target="_blank" class="button" >
                        <?= LanguageController::translateStaticText("User manual", "Manuel d'utilisation"); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>