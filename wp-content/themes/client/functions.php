<?php
// Démarrer le système de sessions pour pouvoir afficher des messages de feedback
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// Charger les fichiers des fonctionnalités extraites dans des classes.
require_once(__DIR__ . '/core/controllers/ContactForm.php');

include('core/theme/configuration.php');

register_nav_menu('header', 'Le menu qui se trouve dans le header');
register_nav_menu('footer', 'Le menu qui se trouve dans le footer');
register_nav_menu('social-media', 'Le menu qui regroupe nos réseaux sociaux');

function dw_get_navigation_links(string $menu_name): array
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

dw_get_navigation_links('header');

function dw_asset(string $filename): string
{
  $manifest_path = get_theme_file_path('public/.vite/manifest.json');

  if (file_exists($manifest_path)) {
    $manifest = json_decode(file_get_contents($manifest_path), true);

    if (isset($manifest['wp-content/themes/dw/assets/css/styles.scss']) && $filename === 'css') {
      return get_theme_file_uri('public/' . $manifest['wp-content/themes/dw/assets/css/styles.scss']['file']);
    }

    if (isset($manifest['wp-content/themes/dw/assets/js/main.js']) && $filename === 'js') {
      return get_theme_file_uri('public/' . $manifest['wp-content/themes/dw/assets/js/main.js']['file']);
    }
  }

  return '';
}

register_post_type('formation', [
  'label' => 'Formations',
  'description' => 'Les formations présentes sur mon site web',
  'menu_position' => 2,
  'menu_icon' => 'dashicons-welcome-learn-more',
  'public' => true,
  'has_archive' => true,
  'supports' => ['title', 'excerpt', 'thumbnail'],
  'rewrite' => [
    'slug' => 'formations'
  ],
]);

register_post_type('contact_message', [
  'label' => 'Mes messages de contact',
  'description' => 'Mes messages de contact',
  'menu_position' => 3,
  'menu_icon' => 'dashicons-welcome-learn-more',
  'public' => false,
  'show_ui' => true,
  'has_archive' => false,
  'supports' => ['title', 'editor'],
]);

register_taxonomy('difficulty', 'formation', [
  'hierarchical' => true,
  'labels' => [
    'name' => 'Le level des formations'
  ],
  'show_ui' => true,
  'show_admin_column' => true,
  'query_var' => true,
]);

add_action('admin_post_nopriv_hepl_contact_form', 'hepl_execute_contact_form');
add_action('admin_post_hepl_contact_form', 'hepl_execute_contact_form');

function hepl_execute_contact_form(): void
{
  $config = [
    'nonce_field' => 'contact_nonce',
    'nonce_identifier' => 'hepl_contact_form'
  ];

  (new ContactForm($config, $_POST))
    ->sanitize([ // nettoyer les données
      'name' => 'text_field', // Je lancerai sanitize_text_field()
      'email' => 'email',  // Je lancerai sanitize_email()
      'object' => 'text_field',  // Je lancerai sanitize_text_field()
      'message' => 'textarea_field',  // Je lancerai sanitize_textarea_field()
    ])
    ->validate([ // valider les données
      'name' => ['required'],
      // Je définis la règle de validation required que j'exécuterai plus tard
      'email' => ['email', 'required'],
      // Je définis les règles de validation required et email que j'exécuterai plus tard
      'object' => [],
      //
      'message' => ['required'],
      // Je définis la règle de validation required que j'exécuterai plus tard
    ])
    ->save( // sauvegarder les données dans un CPT -> message de contact
      title: fn($data) => $data['name'] . ' - ' . $data['email'] . ' - ' . $data['object'],
      // John Doe - johndoe@example.com - Mon objet
      content: fn($data) => $data['message'],
    )
    ->send( // J'envoie les données à mon administrateur du site
      title: fn($data) => 'Nouveau message de ' . $data['name'], // John Doe - johndoe@example.com - Mon objet
      content: fn($data
      ) => 'Nom complet: ' . $data['name'] . PHP_EOL . 'Adresse mail: ' . $data['email'] . PHP_EOL . 'Objet: ' . $data['object'] . PHP_EOL . 'Message: ' . $data['message'],
    )
    ->feedback();
}

function hepl_session_flash($key, $value): void
{
  if (!isset($_SESSION['hepl_flash'])) {
    $_SESSION['hepl_flash'] = [];
  }

  $_SESSION['hepl_flash'][$key] = $value;
}

function hepl_session_get(string $key)
{
  if (isset($_SESSION['hepl_flash']) && array_key_exists($key, $_SESSION['hepl_flash'])) {
    // 1. Récupérer la donnée qui a été flash
    $value = $_SESSION['hepl_flash'][$key];
    // 2. Supprimer la donnée de la session
    unset($_SESSION['hepl_flash'][$key]);
    // 3. Retourner ma donnée récupérée
    return $value;
  }

  return null;
}

//charger les traductions existantes
load_theme_textdomain('hepl-trad', get_template_directory() . '/locales');

// Fonction pour les chaînes de traduction personnalisées
function __hepl(string $translation): ?string
{
  return __($translation, 'hepl-trad');
}













