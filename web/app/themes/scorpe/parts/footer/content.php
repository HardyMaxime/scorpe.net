<?php
    $logo_white = ContactController::getContactInfos("logo_white");
?>
<section class="footer-content container">
    <div class="footer-content-row footer-content-row-grow">
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
    <div class="footer-content-row">
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
    <div class="footer-content-row">
        <h2 class="footer-content-title">
            Contact
        </h2>
        <p>
            <?= ContactController::getContactInfos('address'); ?>
            <br /><br />
            <?= ContactController::getContactInfos('mail'); ?>
        </p>
    </div>
</section>