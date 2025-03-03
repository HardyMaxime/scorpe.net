<?php 
    //$lives = OnlineController::getLiveVideo();
?>
 <section class="section-page page-demo-online section-content container flex-grow">
    <?php get_template_part('parts/page/heading', null, array(
        "title" => DefaultController::getPageHeading(get_the_ID(), 'title'),
        "description" => DefaultController::getPageHeading(get_the_ID(), 'description'),
        "class_title" => ['full-title', 'no-margin-bottom'],
        "class_subtitle" => ["section-subtitle-full"],
    )); ?>
    <?php if(have_rows("page_sav_wrapper")): ?>
        <div class="section-online-content reveal">
            <?php $index = 2; while(have_rows("page_sav_wrapper")): the_row(); ?>
                <p class="fade-in reveal-<?= $index; ?>" >
                    <?= get_sub_field("text"); ?>
                </p>
            <?php $index++; endwhile; ?>
        </div>
    <?php endif; ?>
    <?php if(have_rows("page_sav_sav_gallery", get_the_ID())): ?>
        <div class="section-online-images">
            <?php $skey= 2; while(have_rows("page_sav_sav_gallery", get_the_ID())): the_row(); 
                $image = get_sub_field("thumb");
                $url = get_sub_field("url");
            ?>
                <div class="fixed-image reveal" >
                    <a href="<?= esc_url($image['url']); ?>" class="glightbox fade-in reveal-<?= $skey; ?>" target="_blank" >
                        <img src="<?= esc_url($image['url']); ?>"
                        width="670" height="420" alt="<?= esc_attr($image['alt']); ?>" class="section-online-image">
                    </a>
                </div>
            <?php $skey++; endwhile; ?>
        </div>
    <?php endif; ?>
</section>