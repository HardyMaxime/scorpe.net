<section class="section-place container">
    <hgroup class="section-heading reveal">
        <h1 class="section-title title-secondary reveal-translate reveal-2">
            <?= DefaultController::field_value("facilities_title", get_the_ID()); ?>
        </h1>
    </hgroup>
    <?php if(have_rows("facilities_listing", get_the_ID())): ?>
        <div class="default-grid">
            <?php $index=0; while(have_rows("facilities_listing", get_the_ID())): the_row(); ?>
                <div class="default-grid-item reveal">
                    <h3 class="default-grid-item-title title-with-arrow-icon white-icon white-arrow fade-in reveal-<?= $index; ?>">
                        <?= get_sub_field('name'); ?>
                    </h3>
                    <div class="default-grid-item-content fade-in reveal-<?= ($index + 2); ?>">
                        <?= get_sub_field('content'); ?>
                    </div>
                </div>
            <?php $index++; endwhile; ?>
    <?php endif; ?>
</section>