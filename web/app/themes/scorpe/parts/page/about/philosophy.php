
<section class="section-philosophy container">
    <hgroup class="section-heading reveal">
        <h1 class="section-title title-secondary reveal-translate reveal-2">
            <?= DefaultController::field_value("page_history_philosophy_title", get_the_ID()); ?>
        </h1>
    </hgroup>
    <?php if(have_rows("page_history_philosophy_content")): ?>
        <div class="section-about-philophy-content reveal">
            <h2 class="title-with-arrow-icon white-arrow fade-in reveal-4">
                <?= DefaultController::field_value("page_history_philosophy_subtitle", get_the_ID()); ?>
            </h2>
            <?php $index =4; while(have_rows("page_history_philosophy_content")): the_row(); ?>
                <p class="fade-in reveal-<?= $index; ?>" >
                    <?= get_sub_field('text'); ?>
                </p>
            <?php $index++; endwhile; ?>
        </div>
    <?php endif; ?>
</section>