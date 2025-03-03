<?php
    $content = HomeController::getFrenchMarketContent();

    if(!empty($content)):
?>
<div class="section-content section-french-market container">
    <hgroup class="reveal" >
        <h2 class="title-secondary title-secondary-tiny fade-in reveal-1">
            <?= $content['title']; ?>
        </h2>
        <?php if(!empty($content['description'])): ?>
            <p class="section-content-text">
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem
            </p>
        <?php endif; ?>
    </hgroup>
    <?php if(!empty($content['listing'])): ?>
    <div class="french-market-companies ">
        <?php foreach($content['listing'] as $key => $company): ?>
            <div class="french-market-company reveal">
                <h3 class="title-with-arrow-icon fade-in reveal-2">
                    <?= $company['name']; ?>
                </h3>
                <div class="french-market-company-content reveal">
                    <div class="fade-in reveal-3" >
                        <p class="section-online-information-text" >
                            <?= $company['content']; ?>
                        </p>
                    </div>
                    <?php if(!empty($company['links'])): ?>
                        <div class="french-market-company-link fade-in reveal-3">
                            <?php foreach($company['links'] as $link): ?>
                                <a href="<?= esc_url($link['url']); ?>" rel="" target="_blank" class="link-with-arrow" ><?= $link['name']; ?></a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>