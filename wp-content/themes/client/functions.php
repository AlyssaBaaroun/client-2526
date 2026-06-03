<?php
include('core/theme/configuration.php');

register_nav_menu('header', 'Le menu qui se trouve dans le header parents');
register_nav_menu('footer', 'Le menu qui se trouve dans le footer');
register_nav_menu('header-connecte', 'Le menu pour les enseignants connectés');
//register_nav_menu('social-media', 'Le menu qui regroupe nos réseaux sociaux');

function portfolio_get_navigation_links(string $menu_name): array
{
  // Récupérer l'objet WP pour le menu à la location $location
  $all_menus = get_nav_menu_locations();

  if (!isset($all_menus[$menu_name])) {
    return [];
  }

  // Je récupère l'id de mon menu
  $nav_id = $all_menus[$menu_name];

  $items_menu = wp_get_nav_menu_items($nav_id);
  $links = [];

  foreach ($items_menu as $item) {
    $link = new stdClass();
    $link->href = $item->url;
    $link->label = $item->title;
    $link->title = $item->attr_title;

    $links[] = $link;
  }

  return $links;
}

portfolio_get_navigation_links('header');

function dw_asset(string $filename): string
{
  $manifest_path = get_theme_file_path('public/.vite/manifest.json');

  if (file_exists($manifest_path)) {
    $manifest = json_decode(file_get_contents($manifest_path), true);

    if (isset($manifest['wp-content/themes/client/assets/css/styles.scss']) && $filename === 'css') {
      return get_theme_file_uri('public/' . $manifest['wp-content/themes/client/assets/css/styles.scss']['file']);
    }

    if (isset($manifest['wp-content/themes/client/assets/js/main.js']) && $filename === 'js') {
      return get_theme_file_uri('public/' . $manifest['wp-content/themes/client/assets/js/main.js']['file']);
    }
  }

  return '';
}

//charger les traductions existantes
load_theme_textdomain('hepl-trad', get_template_directory() . '/locales');

// Fonction pour les chaînes de traduction personnalisées
function __hepl(string $translation): ?string
{
  return __($translation, 'hepl-trad');
}

register_post_type('sensibilisation', [
    'label' => 'Sensibilisations',
    'description' => 'Les sensibilisations présentes sur mon site web',
    'menu_position' => 2,
    'menu_icon' => 'dashicons-welcome-view-site',
    'public' => true,
    'has_archive' => false,
    'supports' => ['title'],
    'rewrite' => [
        'slug' => 'sensibilisations'
    ],
]);

function my_own_mime_types( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'my_own_mime_types' );

// quand c'est a true WP recadre 'crop' mon img et quand c'est false il redimensionne proportionnellement sans me la couper
add_image_size('square-small', 400, 400, true);
add_image_size('square-medium', 800, 800, true);
add_image_size('square-large', 1200, 1200, true);







