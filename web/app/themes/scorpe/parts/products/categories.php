<?php
    $categories = ProductController::getProductCategories();
    $term_id = $args['term_id'] ?? "";
?>
<?php if($categories > 0): ?>
<nav class="section-categories categories-listing">
    <?php $index = 3; foreach($categories as $key => $category):
            if($category->term_id == 1 || $category->term_id == 19) continue;
            $sub_categories = ProductController::getProductCategories($category->term_id);
        ?>
        <div class="category-item reveal">
            <a href="<?= esc_url(get_category_link($category->term_id)); ?>" title="<?= esc_attr($category->name); ?>" >
                <h3 class="category-item-title title-with-arrow-icon fade-in reveal-<?= $index; ?>">
                    <?= $category->name; ?>
                </h3>
            </a>
            <?php if($sub_categories):?>
                <ul class="reset-list category-item-list fade-in reveal-<?= ($index + 3); ?>">
                    <?php foreach($sub_categories as $key => $sub_category): ?>
                        <li data-term-id="<?= esc_attr($term_id) ?>" data-subterm-id="<?= esc_attr($sub_category->term_i) ?>">
                            <a href="<?= esc_url(get_category_link($sub_category->term_id)); ?>"
                                class="link-with-arrow<?= ((!empty($term_id) && $term_id == $sub_category->term_id) ? " active" : "" ); ?>">
                                <?= $sub_category->name; ?>
                            </a>
                        </li>
                    <?php endforeach;?>
                </ul>
            <?php endif; ?>
        </div>
    <?php $index++; endforeach; ?>
</nav>
<?php endif; ?>