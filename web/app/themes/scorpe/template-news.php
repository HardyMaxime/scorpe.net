<?php
/**
 * Template Name: Nouveautés
 * Template Post Type: page
 */

$background = get_field('template-news-background');
$surtitle   = get_field('template-news-surtitle');
$title      = get_field('template-news-title');
$description = get_field('template-news-description');

get_header(); ?>
<header class="archive-header">
    <?php if ($background) : ?>
    <figure class="archive-header-background">
        <img src="<?php echo esc_url($background['url']); ?>"
             alt="<?php echo esc_attr($background['alt']); ?>"
             class="cover is_background"
             width="<?php echo esc_attr($background['width']); ?>"
             height="<?php echo esc_attr($background['height']); ?>"
             loading="lazy" />
    </figure>
    <?php endif; ?>
    <div class="archive-header-content container reveal">
        <?php if ($surtitle) : ?>
        <h2 class="archive-subtitle reveal-translate reveal-2">
            <?php echo esc_html($surtitle); ?>
        </h2>
        <?php endif; ?>
        <?php if ($title) : ?>
        <h1 class="archive-title reveal-translate reveal-3">
            <?php echo $title; ?>
        </h1>
        <?php endif; ?>
    </div>
</header>
<div class="section-page archive-content container">
    <?php if ($description) : ?>
    <div class="section-content archive-content reveal">
        <div class="reveal-translate reveal-2">
            <?php echo $description; ?>
        </div>
    </div>
    <?php endif; ?>
    <?php if (have_rows('template-news-listing')) : ?>
    <div class="archive-listing">
        <?php while (have_rows('template-news-listing')) : the_row(); ?>
            <?php if (get_row_layout() === 'item') :
                $images  = get_sub_field('images');
                $content = get_sub_field('content');
                $first_image = !empty($images) ? $images[0] : null;
            ?>
            <article class="archive-listing-item reveal">
                <?php if ($first_image) : ?>
                <figure class="archive-listing-item-image fade-in reveal-2">
                    <img src="<?php echo esc_url($first_image['url']); ?>"
                         alt="<?php echo esc_attr($first_image['alt']); ?>"
                         width="<?php echo esc_attr($first_image['width']); ?>"
                         height="<?php echo esc_attr($first_image['height']); ?>"
                         loading="lazy"
                         class="cover" />
                </figure>
                <?php endif; ?>
                <div class="archive-listing-item-content reveal-translate reveal-3">
                    <?php if (!empty($content['title'])) : ?>
                    <h2 class="archive-listing-item-title">
                        <?php echo $content['title']; ?>
                    </h2>
                    <?php endif; ?>
                    <?php if (!empty($content['description'])) : ?>
                    <div class="archive-listing-item-description">
                        <?php echo $content['description']; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </article>
            <?php endif; ?>
        <?php endwhile; ?>
    </div>
    <?php endif; ?>
</div>
<?php get_footer(); ?>
