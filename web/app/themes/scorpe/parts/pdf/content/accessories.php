<?php 
    $product_accessories = ProductController::getProductAccessories($args['id']) ?: false;
    if($product_accessories): ?>
        <div id="pdf-accessories" class="pdf-section pdf-section-col-right" >
            <?php get_template_part('parts/pdf/content/secondary-title', null, array('title' => LanguageController::currentLanguage() == "en" ? "Accessories" : "Accessoires")); ?>
            <p class="pdf-content" >
                <ul style="list-style: none;" >
                    <?php foreach($product_accessories as $accessorie): ?>
                        <li>
                            - <?= $accessorie->post_title; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </p>
        </div>
<?php endif; ?>