<?php 
    $networks = ContactController::getContactInfos("social_networks");
    if(!empty($networks)):
?>
<ul class="networks-list reset-list">
    <?php foreach($networks as $name => $url): ?>
        <li>
            <a href="<?= esc_url($url); ?>" rel="noopener external" title="Follow us on <?= esc_attr($name); ?>" target="_blank" class="network-item" >
                <?= ucfirst($name); ?>
                <svg class="icon">
                    <use xlink:href="<?= get_template_directory_uri(); ?>/assets/ressources/images/networks.svg#<?= esc_attr($name); ?>"></use>
                </svg>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>