<?php
    // full-title   ==> H1
    // section-subtitle-full ==> subtitle
    $title = $args['title'];
    $description = $args['description'] ?? "";
    $class_title = $args['class_title'] ?? [];
    $class_subtitle = $args['class_subtitle'] ?? [];
?>
<hgroup class="section-heading<?= (!empty($class_title) ? " ".implode(" ", $class_title) : ""); ?> reveal">
    <h1 class="section-title title-secondary slide-out-in reveal-2">
        <?= $title; ?>
    </h1>
    <?php if(!empty($description)): ?>
        <div class="section-subtitle<?= (!empty($class_subtitle) ? " ".implode(" ", $class_subtitle) : "");?> slide-in-out reveal-4">
            <?= $description; ?>
        </div>
    <?php endif; ?>
</hgroup>