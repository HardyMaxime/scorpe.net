<?php
    $galleries = GalleryController::getGallery(0, GalleryController::getLimitAndMax(get_the_ID(),'max'), get_the_ID());
    $offset = GalleryController::getLimitAndMax(get_the_ID(),'max');
    $limit = GalleryController::getLimitAndMax(get_the_ID(),'limit');
?>
<section class="section-page section-gallery container overflow-x">
    <?php get_template_part('parts/page/heading', null, array(
        "title" => DefaultController::getPageHeading(get_the_ID(), 'title'),
        "description" => DefaultController::getPageHeading(get_the_ID(), 'description'),
        "class_title" => [''],
        "class_subtitle" => ["section-subtitle-full"],
    )); ?>
    <?php if(!empty($galleries)): ?>
        <div class="gallery-wrapper" data-id="<?= get_the_ID(); ?>" data-max="<?= $limit; ?>" data-offset="<?= $offset; ?>">
            <?php $index = 2; foreach($galleries as $key => $gallery): ?>
                <div class="reveal fixed-image gallery-wrapper-item">
                    <a href="<?= esc_url($gallery['url']); ?>" class="glightbox section-flex fade-in reveal-<?= $index; ?>" >
                        <img src="<?= esc_url($gallery['url']); ?>" width="670" height="420" 
                            alt="<?= esc_attr(LanguageController::getImageAlt($gallery)); ?>" loading="lazy" />
                    </a>
                </div>
            <?php $index++; endforeach; ?>
        </div>
        <?php if(count(GalleryController::getGallery(0, 0, get_the_ID())) > $offset): ?>
            <button type="button" id="show-more-gallery" class="link-with-arrow show-more-gallery" >
                <?= LanguageController::translateStaticText("Show more photos", "Voir plus de photos"); ?>
            </button>
        <?php endif; ?>
    <?php endif; ?>
</section>