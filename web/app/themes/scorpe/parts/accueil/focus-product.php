<?php 
    $focus_title = DefaultController::field_value("focus_product_title");
    $focus_description = DefaultController::field_value("focus_product_description");
    $focus_image = DefaultController::field_value("focus_product_image");

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
    <?php if(!empty($focus_image)): ?>
        <div class="section-content">
            <figure class="section-focus-product-image">
                <img src="<?= esc_url($focus_image['url']); ?>" alt="<?= esc_attr($focus_image['alt']); ?>" 
                width="1215" height="360" loading="lazy" />
            </figure>
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