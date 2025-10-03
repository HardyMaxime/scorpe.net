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
                <?php if($description): ?>
                    <div class="subtitle">
                        <?= $description; ?>
                    </div>
                <?php endif; ?>
                <a href="<?= esc_url(home_url('contact')); ?>" class="button" >
                    <?= LanguageController::translateStaticText("Get in touch", "Contactez-nous."); ?>
                </a>
            </hgroup>
        </div>
    </div>
</header>