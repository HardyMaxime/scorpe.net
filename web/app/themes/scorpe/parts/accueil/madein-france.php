<?php 
    $gallery = DefaultController::field_value("FR_madein_france_gallery");
?>
<section class="section section-accueil section-madein-france section-dark container">
    <figure class="french-flag">
        <span class="text-ident"><?= LanguageController::translateStaticText("Our products are made in France.", "Nos produits sont fabriqués en France."); ?></span>
    </figure>
    <hgroup class="heading-group text-center reveal">
        <h2 class="title-secondary title-secondary-tiny slide-in-out reveal-4">
            <?= DefaultController::field_value("FR_madein_france_title"); ?>
        </h2>
    </hgroup>
    <div class="section-content">
        <div class="section-contect-text">
            <?= DefaultController::field_value("FR_madein_france_content"); ?>
        </div>
        <?php if($gallery): ?>
            <div class="section-contect-figure figure-shape product-image-outline splide strech-slider">
                <div class="splide__track">
                    <div class="splide__list">
                        <?php foreach($gallery as $key => $image): ?>
                            <figure class="splide__slide" >
                                <img src="<?= esc_url($image['url']); ?>" class="cover" alt="" 
                                width="770" height="585" loading="lazy" />
                            </figure>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>