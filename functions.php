<?php

function montheme_supports () {

    // Récupération des titres du thème dans l'onglet de navigation

    add_theme_support('title-tag');

    // Ajout de l'option d'ajout d'image à la une pour nos articles

    add_theme_support('post-thumbnails');

    // Ajout de l'option de support de menu

    add_theme_support('menu');

    // Enregistrement d'un menu du côtés Back

    register_nav_menu('header', 'En tête du menu');
    register_nav_menu('footer', 'Pied de page');

    // Définir une taille spécifique pour une image (true = cropper)

    add_image_size('card-header', 350, 215, true);
    
};

// Enregistre ma feuille de style CSS (Bootstrap)

function montheme_register_assets () {
    wp_register_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css', []);

    // Pour utiliser la partie JS, Popper, jQuerry de Bootstrap

    wp_register_script('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', ['popper', 'jquery'], false, true);
    wp_register_script('popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js', [], false, true);
    
    // Changement de jQuery actuel par celui de Bootstrap

    wp_deregister_script('jquery');

    //

    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.5.1.slim.min.js', [], false, true);

    // Pour utiliser le style

    wp_enqueue_style('bootstrap');

    // Il va uniquement charger Bootstrap avec les dépendances dans le bonne ordre

    wp_enqueue_script('bootstrap');
}


function montheme_title_separator () {
    return '|';
}

function montheme_menu_class($classes) {
    $classes[] = 'nav-item';
    return $classes;
}

function montheme_menu_link_class($attrs) {
    $attrs['class'] = 'nav-link';
    return $attrs;
}

// Système de pagination avec modification des class avec ceux de Bootstrap (active fonctionnel)

function montheme_pagination() {

    $pages = paginate_links(['type' => 'array']);

    // Dans le cas ou nous n'avons pas besoin d'une pagination (ça évite les erreurs)

    if ($pages === null) {
        return;
    }


    echo '<nav aria-label="Pagination" class="mt-4 mb-4">';
    echo '<ul class="pagination">';

    foreach($pages as $page) {
        $active = strpos($page, 'current') !== false;
        $class = 'page-item';
        if ($active) {
            $class .= ' active';
        }
        echo '<li class="' . $class . '">';
        echo str_replace('page-numbers', 'page-link', $page);
        echo '</li>';
    }

    echo '</ul>';
    echo '</nav>';

}

// Ajout d'une taxonomy (un lien entre un mot et un article ex: catégorie Sport)

function montheme_init() {

    // Ne pas utiliser une key déjà utilisé avec Wordpress (collision)

    register_taxonomy('formation', 'post', [
        'labels' => [
            'name' => 'Formation',
            'singular_name'     => 'Formation',
            'plural_name'       => 'Formations',
            'search_items'      => 'Rechercher les formations',
            'all_items'         => 'Toutes les formations',
            'edit_item'         => 'Editer la formation',
            'update_item'       => 'Mettre à jour la formation',
            'add_new_item'      => 'Ajouter une nouvelle formation',
            'new_item_name'     => 'Ajouter une nouvelle formation',
            'menu_name'         => 'Formation'
        ],
        'show_in_rest' => true, // Paramètre pour qu'elle soit accessible dans l'éditeur Wordpress
        'hierarchical' => true, // True = Checkbox
        'show_admin_column' => true,
    ]);

    // Ajout d'une nouvelle option dans le panel d'aministration de Wordpress

    register_post_type('mescours', [
        'label' => 'Mes cours',
        'public' => true,
        'menu_position' => 4,
        'menu_icon' => 'dashicons-book',
        'supports' => ['title', 'editor', 'thumbnail'],
        'show_in_rest' => true,
        'has_archive' => true,
    ]);
}

add_action('init', 'montheme_init');

// Ce hook est appelé à chaque chargement de page, après l'initialisation du thème.

add_action('after_setup_theme', 'montheme_supports');

// Se déclenche lorsque les scripts et les styles sont mis en file d'attente.

add_action('wp_enqueue_scripts', 'montheme_register_assets');

// Ici nous venons nous brancher sur le séparateur du titre afin d'en modifier sa valeur
add_filter('document_title_separator', 'montheme_title_separator');

// Ici nous venons nous brancher sur la liste de class du menu de navigation (hook/walker)

add_filter('nav_menu_class', 'montheme_menu_class');
add_filter('nav_menu_link_attributes', 'montheme_menu_link_class');

// Ajout d'une option dans la partie Réglage du panel admin de Wordpress

require_once('options/ecole.php');
EcoleMenuPage::register();

// Appel la classe SponsoMetaBox avec le chemin d'accès au fichier

require_once('metaboxes/sponso.php');
SponsoMetaBox::register();