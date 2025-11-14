<?php 
    $backgrounds = DefaultController::field_value("header_gallery");
?>
<header class="header reveal">
    <section class="header-content-wrapper">
        <div class="header-group-title container reveal">
            <h1 class="header-title reveal-translate reveal-2" ><?= DefaultController::field_value("header_main_title", get_the_id()); ?></h1>
            <h2 class="header-subtitle fade-in reveal-4">
                <?= DefaultController::field_value("header_subtitle", get_the_id()); ?>
            </h2>
            <div class="fade-in reveal-6" >
                <a href="#products" class="button" >
                    <?= LanguageController::translateStaticText("Explore Our Products", "DÉCOUVRIR NOS PRODUITS"); ?>
                </a>
            </div>
        </div>
    </section>
    <section id="sliderBackgrounds" class="header-backgrounds splide strech-slider" >
        <div class="splide__track">
            <div class="splide__list">
                <?php foreach($backgrounds as $key => $background): ?>
                    <figure class="splide__slide hero-background-figure" >
                        <img class="" src="<?= esc_url($background['url']); ?>"
                            width="1920" height="1080" alt="<?= esc_attr(LanguageController::getImageAlt($background)); ?>" 
                            loading="lazy" />
                    </figure>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</header>