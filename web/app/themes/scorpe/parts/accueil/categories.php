<?php 
  $content = HomeController::getBusinessSectorContent();
?>
<section class="section section-accueil section-categories section-dark">
    <div class="section-content container">
        <hgroup class="reveal">
            <h2 class="title-secondary title-secondary-tiny slide-in-out reveal-4"><?= $content['title']; ?></h2>
            <p class="section-content-text  slide-out-in reveal-5">
                <?= $content['description']; ?>
            </p>
        </hgroup>
        <?php get_template_part('parts/products/categories', null, array('current_url' => LanguageController::getProductURL())); ?>
    </div>
    <?php if(LanguageController::currentLanguage() == "fr"): ?>
        <?php get_template_part('parts/accueil/french-market'); ?>
    <?php endif; ?>
</section>