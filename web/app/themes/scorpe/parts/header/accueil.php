<?php 
    $header_content = HomeController::getHomeHeader();
?>
<header class="header reveal stripe-lines-section has-hero-slider">
    <section class="stripe-lines-wrapper container">
        <div class="stripe-line"></div>
        <div class="stripe-line"></div>
    </section>
    <?php if(!empty($header_content)): ?>
    <section class="header-content-wrapper hero-slider-wrapper">
        <div class="splide header-slider-content hero-slider-content strech-slider" itemscope itemtype="https://schema.org/ItemList" id="sliderHeader" aria-label="Scorpe Technologies - Activities">
            <div class="splide__track">
                <div class="splide__list">
                    <?php foreach($header_content as $key => $value): ?>
                        <div class="splide__slide header-content-wrapper-item"  itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <meta itemprop="position" content="<?= $key; ?>" />
                            <hgroup class="header-group-title container">
                                <?php if($key == "0"): ?>
                                    <h1 class="header-title" itemprop="name" ><?= $value['title']; ?></h1>
                                <?php else: ?>
                                    <h2 class="header-title" itemprop="name" ><?= $value['title']; ?></h2>
                                <?php endif; ?>
                                <p class="header-subtitle" ><?= $value['subtitle']; ?></p>
                            </hgroup>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <aside class="hero-aside-controls container" >
            <div id="header-slider-pagination" class="hero-slider-pagination">
                <?php foreach($header_content as $key => $value):
                        $is_link = $value['url_pagination'] ?: "";
                        if($is_link):
                    ?>
                    <a href="<?= esc_url($is_link); ?>" class="hero-slider-pagination-item<?= ($key == 0 ? " is-active" : ""); ?>">
                        <div class="hero-slider-pagination-item-progress">
                            <div class="hero-slider-pagination-item-progress-bar"></div>
                        </div>
                        <div class="hero-slider-pagination-item-text">
                            <?= $value['label_pagination']; ?>
                        </div>
                    </a>
                    <?php else: ?>
                        <div class="hero-slider-pagination-item<?= ($key == 0 ? " is-active" : ""); ?>">
                            <div class="hero-slider-pagination-item-progress">
                                <div class="hero-slider-pagination-item-progress-bar"></div>
                            </div>
                            <div class="hero-slider-pagination-item-text">
                                <?= $value['label_pagination']; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </aside>
    </section>
    <section id="sliderBackgrounds" class="header-backgrounds hero-slider-backgrounds splide strech-slider" >
        <div class="splide__track">
            <div class="splide__list">
                <?php foreach($header_content as $key => $value):
                    $desktop = $value['background']['desktop'];
                    $mobile = $value['background']['mobile'] ?? $desktop;
                    ?>
                    <figure class="splide__slide hero-background-figure" >
                        <img class="" src="<?= esc_url($desktop['url']); ?>"
                            srcset="<?= esc_url($mobile['url']); ?> 768w, <?= esc_url($desktop['url']); ?> 1920w"
                            width="1920" height="1080" alt="<?= esc_attr(LanguageController::getImageAlt($desktop)); ?>" 
                            loading="lazy" />
                    </figure>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>
</header>