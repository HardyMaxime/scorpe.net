<?php 
    $category = $args['category'] ?? null;
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
        <?php if($category): ?>
            <li class="active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <span itemprop="name"><?= $category->name; ?></span>
                <meta itemprop="position" content="4" />
            </li>
        <?php endif; ?>
    </ol>
</nav>