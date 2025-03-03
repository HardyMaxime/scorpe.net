<section class="section-page section-mentions flex-grow overflow-x">
    <section class="section container">
        <?php get_template_part('parts/page/heading', null, array(
            "title" => DefaultController::getPageHeading(get_the_ID(), 'title'),
            "description" => DefaultController::getPageHeading(get_the_ID(), 'description'),
            "class_title" => ['full-title', 'no-margin-bottom'],
            "class_subtitle" => ["section-subtitle-full"],
        )); ?>
        <?php if(have_rows("mentions_colonnes", get_the_ID())): ?>
        <div class="section-default-layout reset-list">
            <?php while(have_rows('mentions_colonnes', get_the_ID())): the_row(); ?>
                <div class="section-default-layout-col" >
                    <?= the_sub_field("mentions_colonne_content", false); ?>
                </div>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
        <?php if(have_rows("mentions_paragraphes", get_the_ID())): ?>
            <?php while(have_rows('mentions_paragraphes', get_the_ID())): the_row(); ?>
                <div class="section-mentions-paragraphe">
                    <?= the_sub_field("mentions_paragraphe_text"); ?>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </section>
</section>