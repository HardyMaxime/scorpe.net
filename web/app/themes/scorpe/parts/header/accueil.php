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
                            <hgroup class="header-group-title" >
                                <?php if($surtitle): ?>
                                    <p class="header-backgrounds-surtitle" ><?= ($surtitle); ?></p>
                                <?php endif; ?>
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
    </section>
    <ul id="header-slider-pagination" class="header-slider-pagination container reset-list">
        <?php $slide_index = 0; while(have_rows("home_header", get_the_ID())): the_row();
            $slide_name = get_sub_field("label") ?: "Slide " . ($slide_index + 1);
        ?>
        <li class="header-slider-pagination-item" role="button" data-index="<?= $slide_index; ?>">
            <div class="header-slider-pagination-item-progress">
                <div class="header-slider-pagination-item-progress-bar"></div>
            </div>
            <?= esc_html($slide_name); ?>
        </li>
        <?php $slide_index++; endwhile; ?>
    </ul>
    <?php endif; ?>
</header>