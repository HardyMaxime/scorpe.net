<?php 
    $logo_white = ContactController::getContactInfos("logo_white");
    $logo_black = ContactController::getContactInfos("logo_black");
?>
<aside class="navbar navbar-home" >
    <div class="navbar-background"></div>
    <div class="navbar-content container">
        <a href="<?= esc_url(home_url()); ?>" title="Retour à l'accueil" class="navbar-logo">
            <img src="<?= esc_url($logo_white['url']); ?>" class="light-logo" width="180" height="30" loading="lazy" alt="<?= esc_attr(LanguageController::getImageAlt($logo_white)); ?>">
        </a>
        <div class="navbar-controls">
            <div class="navbar-control navbar-control-search hide-max-mobile">
                <button type="button" class="navigation-link navbar-search-button open-search" arial-label="Open search">
                    <span>Open search bar</span>
                    <svg class="icon">
                        <use xlink:href="<?= get_template_directory_uri(); ?>/assets/ressources/images/sprite-search.svg#search"></use>
                    </svg>
                </button>
            </div>
            <div class="navbar-control hide-max-mobile">
                <?php LanguageController::generateSiwtcher(); ?>
            </div>
            <div class="navbar-control">
                <button type="button" class="navbar-menu-button" aria-label="Open menu" >
                    <span class="text-ident" >Open menu</span>
                    <span class="navbar-menu-button-trait"></span>
                </button>
            </div>
        </div>
    </div>
</aside>