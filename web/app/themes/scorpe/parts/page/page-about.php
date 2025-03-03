<section class="section-page section-about overflow-x">
    <section class="section container flex-grow">
        <?php get_template_part('parts/page/heading', null, array(
            "title" => DefaultController::getPageHeading(get_the_ID(), 'title'),
            "description" => DefaultController::getPageHeading(get_the_ID(), 'description'),
            "class_title" => ['no-margin-bottom'],
            "class_subtitle" => ["section-subtitle-full"],
        )); ?>
    </section>
    <?php if(AboutController::getAboutBanners(get_the_ID(), 'top')): ?>
        <div class="section-about-hero section-hero" >
            <figure class="anime-scale">
                <img src="<?= esc_url(AboutController::getAboutBanners(get_the_ID(), 'top')['url']); ?>" class="hero-image" width="1920" height="840" loading="lazy"
                    data-speed="-2" data-smooth data-translate-start="10" data-translate-end="-10" 
                    alt="<?= esc_attr(LanguageController::getImageAlt(AboutController::getAboutBanners(get_the_ID(), 'top'))); ?>" />
            </figure> 
        </div>
    <?php endif; ?>
    <?php get_template_part("parts/page/about/philosophy"); ?>
    <?php get_template_part("parts/page/about/conception"); ?>
    <?php get_template_part("parts/page/about/facilities"); ?>
</section>
<?php if(AboutController::getAboutBanners(get_the_ID(), 'bottom')): ?>
    <div class="anime-scale">
        <figure class="section-about-hero no-margin no-padding section-hero">
            <img src="<?= esc_url(AboutController::getAboutBanners(get_the_ID(), 'bottom')['url']); ?>"
                class="hero-image" width="1920" height="840" loading="lazy" 
                alt="<?= esc_attr(LanguageController::getImageAlt(AboutController::getAboutBanners(get_the_ID(), 'bottom'))); ?>" />
        </figure>
    </div>
<?php endif; ?>