<?php
    $products = $args['products'];
?>
<section class="product-listing">
    <?php while($products->have_posts()): $products->the_post(); ?>
    <a href="<?= esc_url(get_the_permalink()); ?>" class="product-listing-item" >
        <figure class="product-listing-item-figure product-image-outline" >
            <?php if(!empty(ProductController::getProductThumbnails(get_the_ID(), "url"))): ?>
                <img src="<?= esc_url(ProductController::getProductThumbnails(get_the_ID(), "url")); ?>"
                    width="330" height="200" alt="<?= esc_attr(ProductController::getProductThumbnails(get_the_id(), "alt")); ?>" loading="lazy" />
            <?php else: ?>
                <img src="<?= esc_url(ProductController::getDefautThumb()); ?>" 
                    width="330" height="200" alt="<?= "Scorpe Technologies - " . esc_attr(get_the_title()); ?>" loading="lazy" />
            <?php endif; ?>
        </figure>
        <h3 class="product-name link-with-arrow">
            <?= esc_html(get_the_title()); ?>
        </h3>
    </a>
    <?php endwhile; ?>
</section>