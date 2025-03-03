<div class="form-wrapper container">
    <h1 class="contact-title">
        <?= get_the_title(); ?>
    </h1>
    <?php if(LanguageController::currentLanguage() === "fr"): ?>
        <?= do_shortcode('[contact-form-7 id="5a8ed0d" title="Formulaire de contact FR"]'); ?>
    <?php else: ?>
        <?= do_shortcode('[contact-form-7 id="15ffa96" title="Formulaire de contact EN"]'); ?>
    <?php endif; ?>
</div>