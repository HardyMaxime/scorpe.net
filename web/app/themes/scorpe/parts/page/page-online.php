<?php 

    $lives = OnlineController::getLiveVideo();
?>
<section class="section-page page-demo-online section-content container flex-grow overflow-x">
    <?php get_template_part('parts/page/heading', null, array(
        "title" => DefaultController::getPageHeading(get_the_ID(), 'title'),
        "description" => DefaultController::getPageHeading(get_the_ID(), 'description'),
        "class_title" => ['full-title', 'no-margin-bottom'],
        "class_subtitle" => ["section-subtitle-full"],
    )); ?>
    <?php if(have_rows("page_online_wrapper")): ?>
        <div class="section-online-content reveal">
            <?php $index = 2; while(have_rows("page_online_wrapper")): the_row(); ?>
                <p class="fade-in reveal-<?= $index; ?>" >
                    <?= get_sub_field("text"); ?>
                </p>
            <?php $index++; endwhile; ?>
        </div>
    <?php endif; ?>
    <?php if(OnlineController::getGallery(get_the_ID())): ?>
        <div class="section-online-images">
            <?php $skey= 2; foreach(OnlineController::getGallery(get_the_ID()) as $image): ?>
                <div class="fixed-image reveal" >
                    <a href="<?= esc_url($image['url']); ?>" class="glightbox fade-in reveal-<?= $skey; ?>" >
                        <img src="<?= esc_url($image['url']); ?>"
                        width="670" height="420" alt="<?= esc_attr(LanguageController::getImageAlt($image)); ?>" class="section-online-image">
                    </a>
                </div>
            <?php $skey++; endforeach; ?>
        </div>
    <?php endif; ?>
    <div class="section-online-next-events" id="next-event" >
        <?php if($lives->have_posts()): ?>
            <h2><?= DefaultController::field_value("page_online_next_online_title", get_the_ID()); ?></h2>
            <?php $ckey = 2; while($lives->have_posts()): $lives->the_post(); ?>
                <div class="section-online-next-event reveal">
                    <?php if(LanguageController::currentLanguage() == "fr"): ?>
                        <h3 class="section-online-next-event-title title-with-arrow-icon white-arrow fade-in reveal-<?= $ckey; ?>">
                            <?= DefaultController::field_value("online_video_french_title", get_the_ID()); ?>
                        </h3>
                    <?php else: ?>
                        <h3 class="section-online-next-event-title title-with-arrow-icon white-arrow fade-in reveal-<?= $ckey; ?>">
                            <?= get_the_title(); ?>
                        </h3>
                    <?php endif; ?>
                    <p class="section-online-next-event-content fade-in reveal-<?= ($ckey + 2); ?>">
                        <?= LanguageController::get_field_value_by_context("online_video_description", get_the_ID()); ?>
                    </p>
                    <?php if(OnlineController::getLiveVideoContent(get_the_ID(), 'url')): ?>
                        <a href="<?= esc_url(OnlineController::getLiveVideoContent(get_the_ID(), 'url')); ?>" target="_blank" class="link-with-arrow fade-in reveal-<?= ($ckey + 4); ?>">
                            <?= LanguageController::translateStaticText("Take part in a live video", "Prendre part à ce live vidéo" ); ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php $ckey++; endwhile; ?>
        <?php else: ?>
            <h2>
                <?= LanguageController::translateStaticText("No events are planned at the moment", "Aucun événement n'est prévu pour le moment"); ?>
            </h2>
        <?php endif; wp_reset_postdata(); ?>
    </div>
</section>