<?php
    get_header();
    // Page des catégories
    $cat_id = get_queried_object()->term_id;
    $is_parent_cat = (get_term_children($cat_id, 'category') ?? false);
?>
<?php 
    // SI la catégorie est une catégorie parente
    if ($is_parent_cat) {
        // On affiche la page parente
        get_template_part('parts/category/parent-archive');
    } else {
        // On affiche la page enfant
        // On affiche un fil d'ariane, à modifier car deja présent dans le parent-archive
        get_template_part('parts/category/child-archive');
    }
    get_footer();
?>