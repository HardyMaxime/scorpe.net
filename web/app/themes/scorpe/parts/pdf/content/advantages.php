<?php
    $content = $args['content'] ?: [];
?>

<div id="pdf-advantage" class="pdf-section pdf-section-col-left" >
    <?php get_template_part('parts/pdf/content/secondary-title', null, array('title' => LanguageController::currentLanguage() == "en" ? "Advantages" : "Avantages")); ?>
    <p class="pdf-content" > 
        <?= $content ?>
    </p>
</div>