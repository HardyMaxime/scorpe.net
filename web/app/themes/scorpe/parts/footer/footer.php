<?php 
    // Cacher footer
    $hide_footer = false;
    if(is_page('mentions-legales') || is_page('contact') || is_page(140)) {
        $hide_footer = true;
    }

    $secondary_menu = MenuController::getSecondaryMenu();
?>
<footer class="footer section-dark reveal">
    <?php if(!$hide_footer): ?>
        <?php get_template_part('parts/footer/content'); ?>
    <?php endif; ?>
    <section class="footer-navigation-wrapper container">
        <?php if(!empty($secondary_menu)): ?>
            <nav class="reset-list footer-navigation" >
                <ul>
                    <?php foreach($secondary_menu as $index => $item): ?>
                        <li class="footer-navigation-item">
                            <a href="<?= esc_url($item->url); ?>" class="<?= implode(" ", $item->classes);  ?> footer-navigation-item-link" >
                                <?= $item->title; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        <?php endif; ?>
        <?php get_template_part("parts/social_networks/index"); ?>
    </section>
    <section class="footer-rgpd-text container">
        <?= LanguageController::get_field_value_by_context("rgpd_sentence", DefaultController::getFrontID()); ?>
    </section>
</footer>