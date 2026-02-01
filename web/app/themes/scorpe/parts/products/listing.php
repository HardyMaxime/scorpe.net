<?php
    $products = $args['products'];
?>
<section class="product-listing">
    <?php while($products->have_posts()): $products->the_post();
        $thumb = ProductController::getProductThumbnails(get_the_ID(), null, "listing");
        $variations = ProductController::getVariations(get_the_ID());
        if(!$variations):
    ?>
        <?php get_template_part("parts/products/listing_item", null, [
            "thumb" => $thumb,
            "title" => get_the_title()
        ]); ?>
    <?php else: ?>
        <?php foreach($variations as $variation): 
                $infos = ProductController::getVariationInfos(get_the_ID(),$variation['id']);
            ?>
            <?php get_template_part("parts/products/listing_item", null, [
                "thumb" => $infos['image'],
                "title" => $infos['name']
            ]); ?>
        <?php endforeach; ?>
    <?php endif; endwhile; ?>
</section>