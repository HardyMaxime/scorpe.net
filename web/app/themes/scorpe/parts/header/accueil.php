<header class="header reveal">
    <?php if(have_rows("home_header", get_the_id())): ?>
    <section id="sliderBackgrounds" class="header-backgrounds splide strech-slider" >
        <div class="splide__track">
            <div class="splide__list">
                <?php $index=0; while(have_rows("home_header", get_the_id())): the_row(); 
                    $image = get_sub_field("image");
                    $title = get_sub_field("title");
                    $description = get_sub_field("description");
                    $surtitle = get_sub_field("surtitle");
                ?>
                    <div class="splide__slide header-background-item" >
                        <figure class="hero-background-figure" >
                            <img class="" src="<?= esc_url($image['url']); ?>"
                                width="1920" height="1080" alt="<?= esc_attr(LanguageController::getImageAlt($image)); ?>" 
                                loading="lazy" />
                        </figure>
                        <div class="header-backgrounds-content container" >
                            <?php if($surtitle): ?>
                                <p class="badges" ><?= ($surtitle); ?></p>
                            <?php endif; ?>
                            <hgroup class="header-group-title" >
                                <?php if($index === 0): ?>
                                    <h1 class="header-backgrounds-title header-title" ><?= ($title); ?></h1>
                                <?php else: ?>
                                    <h2 class="header-backgrounds-title header-title" ><?= ($title); ?></h2>
                                <?php endif; ?>
                                <p class="header-backgrounds-description header-description" ><?= ($description); ?></p>
                            </hgroup>
                        </div>
                    </div>
                <?php $index++; endwhile; ?>
            </div>
        </div>
        <ul class="splide__pagination"></ul>
    </section>
    <?php endif; ?>
</header>