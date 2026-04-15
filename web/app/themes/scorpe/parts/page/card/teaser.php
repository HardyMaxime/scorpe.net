<?php
    $categories = ProductController::getProductCategories();
    $term_id = $args['term_id'] ?? "";
?>
<?php if($categories > 0): ?>
<div class="teaser-cards reveal">
    <?php $index = 1; foreach($categories as $key => $category):
        if($category->term_id == 1 || $category->term_id == 19) continue;
        $sub_categories = ProductController::getProductCategories($category->term_id);
        $image = DefaultController::field_value("categ_thumb_tiny", "term_{$category->term_id}");
    ?>
    <div class="teaser-card reveal-translate reveal-<?= $index; ?>">
        <figure class="teaser-card-image">
            <img class="cover" src="<?= esc_url($image['url']); ?>" alt="<?= esc_attr($image['alt']); ?>" width="420" height="525" loading="lazy" />
        </figure>
        <h3 class="teaser-card-title"><?= $category->name; ?></h3>
        <div class="teaser-card-content">
            <?php if($sub_categories):?>
            <p class="teaser-card-title"><?= $category->name; ?></p>
            <ul class="teaser-card-list reset-list">
                <?php foreach($sub_categories as $key => $sub_category): ?>
                    <li class="teaser-card-list-item <?= $term_id == $sub_category->term_id ? 'active' : ''; ?>">
                        <a href="<?= esc_url(get_category_link($sub_category->term_id)); ?>" >
                            <?= $sub_category->name; ?>
                        </a>
                    </li>
                <?php endforeach;?>
            </ul>
            <?php endif; ?>
        </div>
    </div>
    <?php $index++; endforeach; ?>
</div>
<?php endif; ?>