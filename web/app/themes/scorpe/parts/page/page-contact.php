<?php
    $logo_white = ContactController::getContactInfos("logo_white");
    $background = ContactController::getContactBackdround();
?>
<section class="flex-grow p_relative section-page-contact">
    <figure class="background-section">
        <img src="<?= esc_url($background['url']); ?>" 
            width="1920" height="1080" loading="lazy" alt="<?= esc_attr(LanguageController::getImageAlt($background)); ?>" />
    </figure>
    <?php get_template_part("parts/page/contact/form"); ?>
    <div class="section-content stripe-lines-section section-contact-content container flex-grow p_relative overflow-x">
        <div class="section-contact-content-item">
            <?php if(!empty(ContactController::getKeywodsList())): ?>
                <p class="footer-keywords">
                    <?php foreach(ContactController::getKeywodsList() as $index => $item): ?>
                        <?= $item['keyword']; ?> <?= $index < count(ContactController::getKeywodsList()) - 1 ? ' <br />' : ''; ?>
                    <?php endforeach; ?>
                </p>
            <?php endif; ?>
            <a href="<?= esc_url(pll_home_url()); ?>" class="footer-logo">
                <img src="<?= esc_url($logo_white['url']); ?>" class="" width="207" height="37" loading="lazy" alt="<?= esc_attr(LanguageController::getImageAlt($logo_white)); ?>">
            </a>
        </div>
        <div class="section-contact-content-item">
            <div class="wrapper">
                <h2 class="footer-content-title">
                    Menu
                </h2>
                <?php if(MenuController::getMainMenu()): ?>
                    <ul class="footer-menu reset-list">
                        <?php foreach(MenuController::getMainMenu() as $index => $item): ?>
                            <li>
                                <a href="<?= esc_url($item->url); ?>" ><?= $item->title; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
        <div class="section-contact-content-item">
            <h2 class="footer-content-title">
                <?= LanguageController::translateStaticText("Contact Us", "Nous contacter"); ?>
            </h2>
            <p>
                <?= ContactController::getContactInfos('address'); ?>
                <br /><br />
                <?= ContactController::getContactInfos('mail'); ?>
            </p>
        </div>
    </div>
</section>