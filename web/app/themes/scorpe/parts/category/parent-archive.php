<?php 
    $cat = get_queried_object();
    $cat_id = $cat->term_id;
    $childrens = get_terms(['taxonomy'=>'category','parent'=> $cat_id]) ?? null;
?>
<?php get_template_part('parts/category/header', null, array(
        "cat" => $cat,
        "title" => single_cat_title( '', false ),
        "description" => (category_description( $cat_id )),
        "banner" => DefaultController::field_value("categ_thumb", "term_{$cat_id}")
)); ?>
<section class="section-page section flex-grow section-white overflow-x no-padding-bottom no-padding-top">
    <?php if(!empty($childrens)): ?>
        <div class="pills">
            <?php foreach($childrens as $key => $child): ?>
                <a href="<?= get_category_link($child); ?>" title="<?= esc_attr($child->name); ?>" class="pills-item">
                    <figure class="pills-item-background">
                        <?php if((DefaultController::field_value("categ_thumb", "term_{$child->term_id}"))): ?>
                            <img src="<?= esc_url(DefaultController::field_value("categ_thumb", "term_{$child->term_id}")['url']); ?>" width="1920" height="720" 
                                alt="Scorpe Technologies - <?= esc_attr($child->name); ?>" loading="lazy" />
                        <?php else: ?>
                            <img src="<?= get_template_directory_uri(); ?>/assets/banner.jpg" width="1920" height="720" 
                                alt="Scorpe Technologies - <?= esc_attr($child->name); ?>" loading="lazy" />
                        <?php endif; ?>
                    </figure>
                    <div class="pill-item-body">
                        <h2 class="pill-item-body-title">
                            <?= $child->name; ?>
                        </h2>
                        <?php
                        if(!empty($child->description)): ?>
                        <div class="pill-item-body-description">
                            <p>
                                <?= $child->description; ?>
                            </p>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="pill-item-body-more"></div>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>