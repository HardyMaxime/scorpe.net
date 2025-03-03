<?php get_header(); ?>
    <div class="section-page container">
        <section class="section container flex-grow">
            <?php get_template_part('parts/page/heading', null, array(
                "title" => DefaultController::getPageHeading(get_the_ID(), 'title'),
                "description" => DefaultController::getPageHeading(get_the_ID(), 'description'),
                "class_title" => ['full-title'],
                "class_subtitle" => ["section-subtitle-full"],
            )); ?>
            <div class="section-content mt-5">
                <div class="download-wrapper">
                    <h2>Technical specifications and user manuals</h2>
                    <?php get_template_part("parts/page/download/listing"); ?>
                </div>
            </div>
        </section>
    </div>
<?php get_footer(); ?>