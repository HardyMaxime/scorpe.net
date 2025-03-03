<section class="section-page section-faq container overflow-x" id="faq">
    <?php get_template_part('parts/page/heading', null, array(
        "title" => DefaultController::getPageHeading(get_the_ID(), 'title'),
        "description" => DefaultController::getPageHeading(get_the_ID(), 'description'),
        "class_title" => ['no-margin-bottom'],
        "class_subtitle" => ["section-subtitle-full"],
    )); ?>
    <?php if(have_rows("page_faq_listing", get_the_ID())): ?>
        <div class="faq-linsting">
            <?php $index= 0; while(have_rows("page_faq_listing", get_the_ID())): the_row(); ?>
                <div class="faq-item reveal" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                    <h2 itemprop="name" class="faq-item-title title-with-arrow-icon white-arrow fade-in reveal-<?= $index; ?>">
                        <?php the_sub_field("title"); ?>
                    </h2>
                    <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" >
                        <div itemprop="text" class="faq-item-content fade-in reveal-<?= ($index + 2); ?>">
                            <?php the_sub_field("response"); ?>
                        </div>
                    </div>
                </div>
            <?php $index++; endwhile; ?>
        </div>
    <?php endif; ?>
</section>