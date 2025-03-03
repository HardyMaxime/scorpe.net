<?php
    $post_id = $args['post_id'] ?? "";
    $terms = ProductController::buildProductBreadcrumb($post_id);
    $last_title = get_the_title();
    if(empty($last_title))
    {
        if(is_category() && !empty(single_cat_title("", false)))
        {
            $last_title = single_cat_title("", false);
        }
    }
?>
<nav class="breadcrumb" >
    <ol class="breadcrumb-list reset-list" itemscope itemtype="https://schema.org/BreadcrumbList">
        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <a title="Back to our products" href="<?= esc_url(LanguageController::getProductListingURL()); ?>" itemprop="item">
                <?php if(LanguageController::currentLanguage() == "en"): ?>
                    <span itemprop="name">Our products</span>
                <?php else: ?>
                    <span itemprop="name">Nos produits</span>
                <?php endif; ?>
            </a>
            <meta itemprop="position" content="1" />
        </li>
        <?php if($terms):
                foreach($terms as $term):
                    $term_id = $term->term_id;
                    $term_name = $term->name;
                    $term_link = get_term_link($term_id);
                    $has_parent = $term->parent ? true : false;
                    $position = 2;
            ?>
            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a href="<?= esc_url($term_link); ?>" itemprop="item">
                    <span itemprop="name"><?= $term_name; ?></span>
                </a>
                <meta itemprop="position" content="<?= $position; ?>" />
            </li>
        <?php $position++; endforeach; endif; ?>
        <?php if(!empty($last_title)): ?>
            <li class="active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <span itemprop="name"><?= $last_title; ?></span>
                <meta itemprop="position" content="4" />
            </li>
        <?php endif; ?>
    </ol>
</nav>