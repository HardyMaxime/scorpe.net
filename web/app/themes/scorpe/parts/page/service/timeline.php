<?php  if(have_rows("section_service_timeline_service", get_the_ID())): ?>
<section class="service-timeline" id="services">
    <?php while(have_rows("section_service_timeline_service", get_the_ID())): the_row(); ?>
        <div class="service-timeline-item ">
            <div class="service-timeline-progress-wrapper">
                <div class="service-timeline-progress">
                    <div class="service-timeline-progress-bar"></div>
                </div>
            </div>
            <h3 class="service-timeline-title hide-max-mobile" >
                <span><?= get_sub_field("title"); ?></span>
            </h3>
            <div class="service-timeline-content-wrapper">
                <h3 class="service-timeline-title hide-min-mobile" ><?= get_sub_field("title"); ?></h3>
                <div class="service-timeline-content">
                    <div>
                        <?= get_sub_field("content"); ?>
                    </div>
                    <?php if(!empty(get_sub_field('image'))): 
                        $image = get_sub_field('image');
                        ?>
                        <img src="<?= esc_url($image['url']); ?>" 
                            width="470" height="270" alt="<?= esc_attr(LanguageController::getImageAlt($image)); ?>" loading="lazy" />
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</section>
<?php endif; ?>