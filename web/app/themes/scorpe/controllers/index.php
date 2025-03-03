<?php

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) )
    require __DIR__ . '/vendor/autoload.php';


require_once('includes/DefaultController.php');
require_once('includes/HomeController.php');
require_once('includes/ProductController.php');
require_once('includes/MenuController.php');
require_once('includes/SearchController.php');
require_once('includes/LanguageController.php');
require_once('includes/ContactController.php');
require_once('includes/FAQController.php');
require_once('includes/GalleryController.php');
require_once('includes/OnlineController.php');
require_once('includes/ServiceController.php');
require_once('includes/AboutController.php');
require_once('includes/SAVController.php');
require_once('includes/QRCodeController.php');
require_once('includes/DomPDFController.php');
require_once('includes/ProductPDFController.php');

DefaultController::getInstance();
HomeController::getInstance();
ProductController::getInstance();
MenuController::getInstance();
SearchController::getInstance();
LanguageController::getInstance();
ContactController::getInstance();
FAQController::getInstance();
GalleryController::getInstance();
OnlineController::getInstance();
ServiceController::getInstance();
AboutController::getInstance();
SAVController::getInstance();
QRCodeController::getInstance();
DomPDFController::getInstance();
ProductPDFController::getInstance();