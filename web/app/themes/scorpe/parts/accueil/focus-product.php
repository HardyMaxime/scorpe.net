<?php 
    $focus_title = DefaultController::field_value("focus_product_title");
    $focus_description = DefaultController::field_value("focus_product_description");
    $focus_image = DefaultController::field_value("focus_product_image");
    $focus_video = DefaultController::field_value("focus_product_video");
    //$focus_video = true;

    $focus_detail_title = DefaultController::field_value("focus_details_product_title");
    $focus_detail_description = DefaultController::field_value("focus_details_product_description");

    if(!empty($focus_title) && !empty($focus_image)):
?>
<section class="section section-accueil section-focus-product section-dark container hr">
    <hgroup class="heading-group text-center reveal">
        <h2 class="title-secondary title-secondary-tiny slide-in-out reveal-4">
            <?= $focus_title; ?>
        </h2>
        <?php if(!empty($focus_title)): ?>
            <p class="section-content-text container slide-out-in reveal-5">
                <?= $focus_description; ?>
            </p>
        <?php endif; ?>
    </hgroup>

    <?php if(!empty($focus_image) && empty($focus_video)): ?>
        <div class="section-content">
            <figure class="section-focus-product-image">
                <img src="<?= esc_url($focus_image['url']); ?>" alt="<?= esc_attr($focus_image['alt']); ?>" 
                width="1215" height="360" loading="lazy" />
            </figure>
        </div>
    <?php endif; ?>

    <?php if(!empty($focus_video)): ?>
        <div class="section-content reveal">
            <div class="section-focus-product-video-wrapper">
                <video id="focus-product-video" class="section-focus-product-video reveal-translate reveal-2" muted loop poster="<?= esc_url($focus_image['url']); ?>">
                    <source src="<?= esc_url($focus_video); ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <div class="focus-product-video-controls">
                    <button class="focus-product-video-btn is-paused" aria-label="Lire la vidéo">
                        <svg class="icon-pause" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
                            <rect x="5" y="3" width="4" height="18" rx="1"/>
                            <rect x="15" y="3" width="4" height="18" rx="1"/>
                        </svg>
                        <svg class="icon-play" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
                            <polygon points="5,3 19,12 5,21"/>
                        </svg>
                    </button>
                    <button class="focus-product-video-btn focus-product-fullscreen-btn" aria-label="Plein écran">
                        <svg class="icon-fullscreen" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M3 3h6v2H5v4H3V3zm12 0h6v6h-2V5h-4V3zM3 15h2v4h4v2H3v-6zm16 4h-4v2h6v-6h-2v4z"/>
                        </svg>
                        <svg class="icon-exit-fullscreen" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M9 3H7v4H3v2h6V3zm6 0h2v4h4v2h-6V3zM3 15h4v4h2v-6H3v2zm14 4v-4h4v-2h-6v6h2z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if(!empty($focus_detail_title)): ?>
        <hgroup class="heading-group text-center reveal">
            <h2 class="title-secondary title-secondary-tiny slide-in-out reveal-4">
                <?= $focus_detail_title; ?>
            </h2>
            <?php if(!empty($focus_title)): ?>
                <p class="section-content-text container slide-out-in reveal-5">
                    <?= $focus_detail_description; ?>
                </p>
            <?php endif; ?>
        </hgroup>
    <?php endif; ?>
    <div class="section-content">
        <?php if(have_rows("focus_detail_listing", get_the_id())): ?>
            <ul class="product-focus-listing">
                <?php while(have_rows("focus_detail_listing", get_the_id())): the_row(); ?>
                    <li class="product-focus-listing-item" >
                        <figure class="product-focus-listing-item-image">
                            <img src="<?= esc_url(get_sub_field('image')['url']); ?>" alt="<?= esc_attr(get_sub_field('image')['alt']); ?>" class="cover"
                            width="400" height="280" loading="lazy" />
                        </figure>
                        <h3 class="product-focus-listing-item-title product-name">
                            <?= get_sub_field("title"); ?>
                        </h3>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php endif; ?>
        <a href="<?= esc_url(home_url('contact')); ?>" class="button center" >
            <?= LanguageController::translateStaticText("Get in touch", "Contactez-nous."); ?>
        </a>
    </div>
</section>
<?php endif; ?>