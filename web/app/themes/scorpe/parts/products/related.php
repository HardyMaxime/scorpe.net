<?php
    $term_id = $args['term_id'] ?? "";
    $related_products = $args['related_products'] ?? [];
?>
<div class="splide__track">
    <ul class="splide__list">
        <?php while($related_products->have_posts()): $related_products->the_post(); ?>
            <li class="splide__slide">
                <a href="<?= esc_url(get_the_permalink()); ?>" class="product-crossselling-item" >
                    <figure class="product-listing-item-figure product-image-outline" >
                        <?php if(ProductController::getProductThumbnails(get_the_ID(), true)): ?>
                            <img src="<?= esc_url(ProductController::getProductThumbnails(get_the_ID(), "url")); ?>"
                                alt="<?= esc_attr(ProductController::getProductThumbnails(get_the_ID(),'alt')); ?>" width="330" height="135" loading="lazy" />
                        <?php else: ?>
                            <img src="<?= esc_url(ProductController::getDefautThumb()); ?>" alt="Scorpe Technologies - <?= esc_attr(get_the_title()); ?>" width="330" height="135" loading="lazy" />
                        <?php endif; ?>
                    </figure>
                    <h4 class="product-crossselling-item-name link-with-arrow" ><?= get_the_title(); ?></h4>
                </a>
            </li>
        <?php endwhile; wp_reset_postdata(); ?>
    </ul>
</div>