<section class="section-page page-service flex-grow overflow-x">
    <section class="section-content container ">
        <?php get_template_part('parts/page/heading', null, array(
            "title" => DefaultController::getPageHeading(get_the_ID(), 'title'),
            "description" => DefaultController::getPageHeading(get_the_ID(), 'description'),
            "class_title" => ['full-title'],
            "class_subtitle" => ["section-subtitle-full"],
        )); ?>
       <?php get_template_part("parts/page/service/training"); ?>
    </section>
    <?php if(!empty(ServiceController::getTrainingPartContent(get_the_ID(), "hero"))): ?>
        <figure class="section-service-hero section-hero">
            <img src="<?= esc_url(ServiceController::getTrainingPartContent(get_the_ID(), "hero")['url']); ?>"
                data-speed="-2" data-smooth data-translate-start="10" data-translate-end="-10" 
                class="hero-image" width="1920" height="640" loading="lazy" alt="<?= LanguageController::getImageAlt(ServiceController::getTrainingPartContent(get_the_ID(), "hero")); ?>">
        </figure>
    <?php endif; ?>
    <section class="section-content container">
        <?php get_template_part("parts/page/service/service"); ?>
        <?php get_template_part("parts/page/service/timeline"); ?>
    </section>
</section>