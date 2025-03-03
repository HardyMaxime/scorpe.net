<?php
    $title = $args['title'];
    $description = $args['description'] ?? "";
    $banner = $args['banner'] ?? [];

    if(empty($banner))
    {
        $banner = [];
        $banner['url'] = DefaultController::assets("scorpe-technologies-defaut-thumb-video.jpg");
        $banner['alt'] = get_the_title();
    }

?>
<header class="header page-header">
    <figure class="header-background reveal" >
        <picture>
            <source srcset="<?= $banner['url']; ?>" media="(min-width:768px)" />
            <img src="<?= $banner['url']; ?>" alt="<?= esc_attr($banner['alt']); ?>" class="cover anime-scale"
                width="600" height="860" loading="lazy" />
        </picture>
    </figure>
    <div class="header-content reveal">
        <div class="header-content-inner slide-out-in reveal-4">
            <hgroup class="header-title">
                <h1 class="title">
                    <?= $title; ?>
                </h1>
                <a href="<?= esc_url(ProductController::getFiles(get_the_ID(), 'datasheet')['url']); ?>" target="_blank" class="button" >
                    <?= LanguageController::translateStaticText("Technical characteristics", "Caractéristiques techniques"); ?>
                </a>
            </hgroup>
        </div>
    </div>
</header>