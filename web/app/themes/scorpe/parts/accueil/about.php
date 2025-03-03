<?php 
    $about = HomeController::getAboutSection();
    if(!empty($about)):
    $count = count($about);
?>
<section class="section section-accueil section-about section-content container">
    <?php foreach($about as $key => $content): ?>
    <div class="reveal">
        <h2 class="title-secondary slide-in-out reveal-2" ><?= $content['title']; ?></h2>
        <div class="section-text-content slide-out-in reveal-3<?= (($key % 2 === 0) ? " pull-right" : " semi-left" ); ?>">
            <?= $content['description']; ?>
        </div>
        <?php if(($key + 1) != $count): ?>
            <hr class="reveal-5" />
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
</section>
<?php endif; ?>