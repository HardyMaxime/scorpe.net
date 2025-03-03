<section class="section-conception" id="product-design">
    <div class="container">
        <hrgroup class="reveal">
            <h2 class="title-with-arrow-icon reveal-translate reveal-1">
                <?= DefaultController::field_value("product_conception_title", get_the_ID()); ?>
            </h2>
            <?php if(!empty(DefaultController::field_value("product_conception_description", get_the_ID()))): ?>
                <div class="fade-in reveal-2">
                    <?= DefaultController::field_value("product_conception_description", get_the_ID()); ?>
                </div>
            <?php endif; ?>
        </hrgroup>
        <?php  if(have_rows("product_conception_milestone", get_the_ID())): ?>
            <div class="conception-steps">
                <?php $index=0; while(have_rows("product_conception_milestone", get_the_ID())): the_row(); ?>
                    <div data-index="<?= esc_attr($index); ?>" class="conception-step reveal<?= (($index % 2) == 0 ? " image-first" : "") ?>">
                        <?php if(get_sub_field("image")): $image = get_sub_field("image"); ?>
                            <a href="<?= esc_url($image['url']);?>" class="glightbox conception-image fade-in reveal-2">
                                <img src="<?= esc_url($image['url']);?>"
                                    width="980" height="565" alt="<?= esc_attr(LanguageController::getImageAlt($image)); ?>" loading="lazy" />
                            </a>
                        <?php endif; ?>
                        <div class="conception-step-content">
                            <h3 class="reveal-translate reveal-2" ><?= get_sub_field('title'); ?></h3>
                            <p class="fade-in reveal-4" >
                                <?= get_sub_field('description'); ?>
                            </p>
                        </div>
                    </div>
                <?php $index++; endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>