<?php
    $id = $args['product_id'] ?: null;
    $product_image_full_url = ProductController::getProductThumbnails($id, true)['url'] ?: [];
    if($product_image_full_url)
    {
        $parsed_url = parse_url($product_image_full_url);
        $relative_path = $parsed_url['path'];
        $base64_image = DomPDFController::convertToBase64($product_image_full_url);
    }

    $product_accessories = ProductController::getProductAccessories($id) ?: false;
    $product_content = ProductPDFController::getContent($id);
?>
<html>
    <head>
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">
        <style type="text/css">
            *
            {
                font-size: 10pt;
                color: #3c3c3c;
                padding: 0;
                margin: 0;
                box-sizing: border-box;
                font-family: 'IBM Plex Sans', serif;
            }

            @page {
                margin: 0cm 0cm;
            }

            body
            {
                background: #ffffff;
                margin-top: 20px;
                margin-left: .5cm;
                margin-right: .5cm;
                margin-bottom: 125px;
            }

            header
            {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 20px;
                padding-top: 5px;
                padding-right: 5px;
            }

            footer {
                position: fixed;
                bottom: 0cm;
                left: 0cm;
                right: 0cm;
                height: 125px;
                color: white;
            }

            #pdf-counter
            {
                display: block;
                text-align: right;
                font-size: 8pt;
                line-height: 8pt;
            }

            .page-number:before {
                font-size: 8pt;
                line-height: 8pt;
                content: counter(page);
            }

            #pdf-main
            {
                text-align: left;
                padding: 10px !important;
                margin: 0 auto;
                font-family: 'IBM Plex Sans', serif;
                font-weight: normal;
            }

            #pdf-title
            {
                font-size: 24pt;
                font-weight: bold;
                font-family: 'IBM Plex Sans', serif;
                line-height: 20pt;
                margin: 0;
                padding: 0;
            }

            #pdf-categorie
            {
                font-size: 24pt;
                font-weight: normal;
                font-family: 'IBM Plex Sans', serif;
                line-height: 20pt;
                margin: 0;
                padding: 0;
            }

            #pdf-image
            {
                max-width: 80%;
                margin: 10px auto;
            }

            #pdf-image img
            {
                display: block;
                max-height: 280px;
                max-width: 100%;
                width: auto;
                margin-left: auto;
                margin-right: auto;
            }

            .pdf-secondary-title
            {
                position: relative;
                font-family: serif;
                margin-bottom: 20px;
                font-size: 14pt;
                font-weight: bold;
                vertical-align: center;
                padding-left: 35px;
                line-height: 11pt;
            }

            .pdf-secondary-title-icon
            {
                position: absolute;
                top: 12px;
                left: 0;
                transform: translateY(-13px);
                display: block;
                width: 25px;
                height: 25px;
                background: transparent;
            }

            .pdf-content
            {
                font-size: 9pt;
                line-height: 12pt;
                font-weight: 400;
            }

            .pdf-content strong
            {
                text-transform: uppercase;
                font-size: 9pt;
            }

            .pdf-section
            {
                margin-top: 40px;
                page-break-inside: avoid;
            }

            .pdf-section-col
            {
                position: relative;
                width: 100%;
                page-break-inside: avoid;
            }

            .pdf-section-col .pdf-section-col-left
            {
                display: block;
                width: 65%;
                float: left
            }

            .pdf-section-col .pdf-section-col-right
            {
                display: block;
                width: 30%;
                float: right;
                page-break-inside: avoid;
                padding-left: 20px;
            }

            .clearfix
            {
                display: block;
                clear: both;
            }

            .table-wrapper
            {
                margin-top: 20px;
            }

            table
            {
                width: 100%;
                table-layout: fixed;
            }

            table, tr, th, td
            {
                border-collapse: collapse;
                text-align: center;
            }

            th
            {
                background-color: #97D246;
                color: #ffffff;
                font-weight: 500;
            }

            tr, td, th
            {
                border: solid #dfe4ea 1px;
                font-size: 7pt;
            }

            td
            {
                padding: 3px;
            }

            tr:nth-child(odd) {
                background-color: #f1f2f6;
            }

            img{
                width: 100%;
                height: auto;
                display: block;
            }
  
        </style>
    </head>
    <?php get_template_part('parts/pdf/content/footer'); ?>
    <header id="header" >
        <div id="pdf-counter">
            <span class="page-number"></span> / {N}
        </div>
    </header>
    <body id="pdf-body">
        <div id="pdf-main" >
            <div id="pdf-heading">
                <h2 id="pdf-categorie" ><?= ProductController::getCategoriesByProductId($id)[0]->name; ?></h2>
                <h1 id="pdf-title" ><?= get_the_title($id) ?></h1>
            </div>
            <div class="clearfix"></div>
            <?php if(!empty($product_image_full_url)): ?>
                <div id="pdf-image">
                    <img id="product-image" src="data:image/png;base64,<?= $base64_image ?>" width="300" height="200" alt="Image encodée en base64">
                </div>
            <?php endif; ?>
            <div id="pdf-description"  class="pdf-section">
                <?php get_template_part('parts/pdf/content/secondary-title', null, array('title' => LanguageController::currentLanguage() == "en" ? "Technical Information" : "Information Technique")); ?>
                <div>
                    <?= $product_content['carac_text']; ?>
                </div>
                <?php get_template_part('parts/pdf/content/table', null, array('table' => $product_content['carac_table'])); ?>
            </div>
            <div class="<?= ((!empty($product_accessories) && (!empty($product_content['avantages']))) ? 'pdf-section-col' : ''); ?>">
                <?php if(isset( $product_content['avantages']) && !empty($product_content['avantages'])): ?>
                    <?php get_template_part('parts/pdf/content/advantages', null, array('content' => $product_content['avantages'])); ?>
                <?php endif; ?>
                <?php get_template_part('parts/pdf/content/accessories', null, array('id' => $id)); ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </body>
</html>
