<?php if(MenuController::getMainMenu()): ?>
<ul class="menu-primary">
    <?php foreach(MenuController::getMainMenu() as $index => $item): ?>
        <li class="menu-jump-in menu-reveal-<?= ($index + 5); ?>">
            <a href="<?= esc_url($item->url); ?>" class="link-with-arrow" ><?= $item->title; ?></a>
        </li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>