<section class="search-wrapper">
    <div class="search-wrapper-content" itemscope itemtype="https://schema.org/WebSite">
        <meta itemprop="url" content="<?= esc_url(pll_home_url()); ?>"/>
        <button class="search-bar-button-close" type="button" aria-label="fermer la bar de recherche" id="close-search">
            <svg class="icon">
                <use xlink:href="<?= get_template_directory_uri() ;?>/assets/ressources/images/sprite-close.svg#close"></use>
            </svg>
        </button>
        <form class="search-bar-form" data-action-ajax="<?= admin_url( 'admin-ajax.php' ); ?>" 
                action="<?= esc_url(pll_home_url()) ?>" autocomplete="off"
                itemprop="potential
                Action" itemscope itemtype="https://schema.org/SearchAction"
                >
            <meta itemprop="target" content="<?= esc_url(pll_home_url()); ?>search?s={s}"/>
            <input class="search-bar-input" type="text" name="s" itemprop="query-input"
                placeholder="Search for a product" aria-label="Search" id="input-search" value="<?= get_search_query() ?>" />
                <button class="search-bar-button-start" type="submit" id="start-search">
                    <svg class="icon">
                        <use xlink:href="<?= get_template_directory_uri() ;?>/assets/ressources/images/sprite-search.svg#search"></use>
                    </svg>
                </button>
        </form>
        <nav id="search-results" class="search-bar-results reset-list show">
            <div class="search-bar-results-info">
                <p>
                    Quick suggestion(s) for your search.
                </p>
            </div>
            <ul id="search-results-list">
                <li>
                    <span>Currently researching...</span>
                </li>
            </ul>
        </nav>
    </div>
</section>