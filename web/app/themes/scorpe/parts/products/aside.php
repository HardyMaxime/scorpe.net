<aside class="product-preview-aside">
    <div class="product-preview-aside-line">
        <?php if(ProductController::getFiles(get_the_ID(), 'datasheet')): ?>
            <a href="<?= esc_url(ProductController::getFiles(get_the_ID(), 'datasheet')['url']); ?>" target="_blank" class="link-with-arrow" >
                <?= LanguageController::translateStaticText("Technical characteristics", "Caractéristiques techniques"); ?>
            </a>
        <?php endif; ?>
        <?php if(ProductController::getFiles(get_the_ID(), 'manual')): ?>
            <a href="<?= esc_url(ProductController::getFiles(get_the_ID(), 'manual')['url']); ?>" target="_blank" class="link-with-arrow" >
                <?= LanguageController::translateStaticText("User manual", "Manuel d'utilisation"); ?>
            </a>
        <?php endif; ?>
        <?php if(ProductController::hasVideo(get_the_ID())): ?>
            <a href="#demontration" class="link-with-arrow" >
                <?= LanguageController::translateStaticText("Demonstration", "Démonstration"); ?>
            </a>
        <?php endif; ?>
        <a href="<?= esc_url(home_url('contact')); ?>" class="link-with-arrow link-contact" >
            <?= LanguageController::translateStaticText("Call us for more informations", "Contactez-nous"); ?>
        </a>
    </div>
</aside>