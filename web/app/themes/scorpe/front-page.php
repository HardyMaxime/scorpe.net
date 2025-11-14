<?php get_header(); ?>
<div class="overflow-x">
    <?php get_template_part('parts/header/accueil'); ?>
    <?php get_template_part('parts/accueil/categories'); ?>
    <?php get_template_part('parts/accueil/madein-france'); ?>
    <?php if(LanguageController::currentLanguage() == "fr"): ?>
        <?php get_template_part('parts/accueil/french-market'); ?>
    <?php endif; ?>
    <?php get_template_part('parts/accueil/focus-product'); ?>
    <?php get_template_part('parts/accueil/worldwide'); ?>
    <?php get_template_part('parts/accueil/online'); ?>
    <?php get_template_part('parts/accueil/companies'); ?>
</div>
<?php get_footer(); ?>