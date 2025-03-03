<?php
    $background = ContactController::getContactInfos("main_menu_background");
?>
<aside class="menu-wrapper is-hidden">
    <figure class="menu-background">
        <img src="<?= esc_url($background['url']); ?>" width="1200" height="1080"
            alt="<?= esc_attr(LanguageController::getImageAlt($background)); ?>" loading="lazy">
    </figure>
    <nav class="menu-navigation-wrapper reset-list" >
        <figure class="menu-navigation-background"></figure>
        <div class="menu-head">
            <div class="navbar-control navbar-control-search hide-min-mobile">
                <button type="button" class="navigation-link navbar-search-button open-search" arial-label="Open search">
                    <span>Open search bar</span>
                    <svg class="icon">
                        <use xlink:href="<?= get_template_directory_uri(); ?>/assets/ressources/images/sprite-search.svg#search"></use>
                    </svg>
                </button>
            </div>
            <div class="navbar-control hide-min-mobile">
                <?php LanguageController::generateSiwtcher(); ?>
            </div>
            <button type="button" class="menu-button-close" >
                <span>Fermer le menu</span>
            </button>
        </div>
        <?php get_template_part("parts/header/menu"); ?>
        <div class="menu-navigation-footer">
            <div class="menu-navigation-footer-item menu-fade-in menu-reveal-13">
                <?= ContactController::getContactInfos('address'); ?>
            </div>
            <div class="menu-navigation-footer-item menu-fade-in menu-reveal-14">
                <?= ContactController::getContactInfos('mail'); ?>
            </div>
            <div class="menu-fade-in menu-reveal-15">
                <?php get_template_part("parts/social_networks/index"); ?>
            </div>
        </div>
    </nav>
</aside>