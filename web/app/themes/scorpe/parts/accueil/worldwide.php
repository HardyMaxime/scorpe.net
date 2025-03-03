<?php 
    $contents = HomeController::getSectionInterContent();
    if(!empty($contents)):
?>
<section class="section section-accueil section-worldwide stripe-lines-section has-hero-slider">
    <section class="stripe-lines-wrapper container">
        <div class="stripe-line"></div>
        <div class="stripe-line"></div>
    </section>
    <section class="hero-content-wrapper"  >
        <div class="splide hero-slider-content strech-slider" itemscope itemtype="https://schema.org/ItemList" id="slider-worldwide-text">
            <div class="splide__track">
                <div class="splide__list">
                    <?php foreach($contents as $key => $content): ?>
                    <div class="splide__slide hero-content-wrapper-item"  itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <meta itemprop="position" content="<?= $key; ?>" />
                        <hgroup class="hero-slider-title container">
                            <h2 itemprop="name">
                                <?= $content['title']; ?>
                            </h2>
                            <p class="hero-slider-title-description" >
                                <?= $content['subtitle']; ?>
                            </p>
                        </hgroup>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <aside class="hero-aside-controls container" >
            <div class="hero-slider-pagination">
                <?php foreach($contents as $key => $content): ?>
                    <div class="hero-slider-pagination-item<?= ($key == 0 ? " is-active" : ""); ?>">
                        <div class="hero-slider-pagination-item-progress">
                            <div class="hero-slider-pagination-item-progress-bar"></div>
                        </div>
                        <div class="hero-slider-pagination-item-text">
                            <?= $content['label_pagination']; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </aside>
    </section>
    <section id="slider-worldwide-background" class="worldwide-background hero-slider-backgrounds splide strech-slider" >
        <div class="splide__track">
            <div class="splide__list">
                <?php foreach($contents as $key => $content): ?>
                    <figure class="splide__slide hero-background-figure" >
                        <img class="" src="<?= esc_url($content['background']['url']); ?>" 
                            width="1920" height="1080" alt="<?= esc_attr(LanguageController::getImageAlt($content['background'])); ?>" loading="lazy" />
                    </figure>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</section>
<?php endif; ?>