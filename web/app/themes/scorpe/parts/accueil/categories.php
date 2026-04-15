<?php 
  $content = HomeController::getBusinessSectorContent();
?>
<section class="section section-accueil section-categories section-dark container-fluid" id="products">
    <hgroup class="heading-group reveal">
        <h2 class="title-secondary title-secondary-tiny slide-in-out reveal-4"><?= $content['title']; ?></h2>
        <p class="section-content-text container slide-out-in reveal-5">
            <?= $content['description']; ?>
        </p>
    </hgroup>
    <?php get_template_part('parts/page/card/teaser', null, array('current_url' => LanguageController::getProductURL())); ?>
    <a href="<?= esc_url(home_url('contact')); ?>" class="button center" >
        <?= LanguageController::translateStaticText("Get in touch", "Contactez-nous."); ?>
    </a>
</section>