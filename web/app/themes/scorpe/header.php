<!DOCTYPE html>
<html <?php language_attributes(); ?> >
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo get_bloginfo('name'); ?></title>
        <?php /* GERER PAR YOAST SEO <meta name="description" content="<?php echo get_bloginfo('description'); ?>"> */ ?>
        <link rel="icon" type="<?= DefaultController::getFavicon("type"); ?>" href="<?= DefaultController::getFavicon("url"); ?>" />
        <?php site::generatePreload(); ?>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(DefaultController::generateBodyClass()); ?> >
        <div class="fix-overflow">
            <?php if(QRCodeController::getPageQRCode()): ?>
                <img src="<?= QRCodeController::getPageQRCode(); ?>" width="300" height="300" alt="" />
            <?php die(); endif; ?>
            <?php get_template_part('parts/header/navbar'); ?>
            <?php get_template_part('parts/header/aside'); ?>
            <?php get_template_part('parts/header/search-bar'); ?>
            <main role="main" class="main" >