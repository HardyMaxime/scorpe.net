<?php
    $content = HomeController::getDemoLiveContent();
    if(!empty($content)):
?>
<section class="section section-accueil section-online-demo section-content container">
    <hgroup class="section-heading section-heading-row align-center reveal">
        <h2 class="section-heading-title title-secondary title-secondary-tiny slide-out-in reveal-2">
            <?= $content['title']; ?>
        </h2>
        <p class="section-heading-text slide-in-out reveal-2" >
            <?= $content['description']; ?>
        </p>
    </hgroup>
    <div class="section-online-informations reveal">
        <?php foreach($content['listing'] as $key => $item): ?>
            <div class="section-online-information fade-in reveal-<?= ($key + 2); ?>">
                <h3 class="title-with-arrow-icon white-arrow">
                    <?= $item['title']; ?>
                </h3>
                <p class="section-online-information-text" >
                    <?= $item['content']; ?>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>