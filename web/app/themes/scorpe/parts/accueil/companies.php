<?php 
    $companies = HomeController::getGroupCompaniesContent();
    if( $companies ):
?>
<section class="section section-accueil section-group-companies section-dark" >
    <div class="section-content container">
        <hgroup class="section-heading section-heading-row align-end reveal">
            <h2 class="section-heading-title title-secondary slide-out-in reveal-2">
                <?= $companies['title']; ?>
            </h2>
            <p class="section-heading-text  slide-in-out reveal-2" >
                <?= $companies['content']; ?>
            </p>
        </hgroup>
        <section id="partner-slider" class="partner-slider splide slider-overflow-visible" aria-label="Liste de nos partenaires">
            <div class="splide__track">
                <ul class="splide__list partner-listing">
                    <?php foreach($companies['listing'] as $key => $company): 
                            $name = $company['content']['name'];
                            $website = $company['content']['website' ] ?? false;
                            $logo = $company['logo'];
                            $alt = (LanguageController::getImageAlt($logo) ?? $name );
                        ?>
                        <li class="splide__slide partner-list-item">
                            <?php if($website): ?>
                                <a href="<?= esc_url($website); ?>" rel="noopener external" target="_blank" title="<?= esc_attr($name); ?>" class="partner-list-item-link">
                                    <img class="partner-logo" src="<?= esc_url($logo['url']); ?>" title="<?= esc_attr($alt); ?>" 
                                        width="200" height="50" alt="<?= esc_attr($alt); ?>" loading="lazy">
                                </a>
                            <?php else: ?>
                                <figure class="partner-list-item-link">
                                    <img class="partner-logo" src="<?= esc_url($logo['url']); ?>" title="<?= esc_attr($alt); ?>" 
                                        width="200" height="50" alt="<?= esc_attr($alt); ?>" loading="lazy">
                                </figure>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </section>
    </div>
</section>
<?php endif; ?>