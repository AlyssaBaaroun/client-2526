<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="PLAI">
    <meta name="description"
          content="Le PLAI accompagne les écoles, les enseignants et les équipes éducatives pour offrir à chaque élève les outils et le soutien dont il a besoin. Parce que chaque enfant mérite une chance égale de réussir.">
    <meta name="keywords"
          content="PLAI, school, SEO, search engine optimization, web accessibility, students, help, teacher">
    <meta property="og:description"
          content="Site réalisé pour le Plai, pour offrir à chaque élève les outils et le soutien dont il a besoin.">
    <meta property="og:image" content="<?= get_template_directory_uri() ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= home_url() ?>">
    <meta property="og:site_name" content="<?= get_bloginfo('name') ?>">
    <meta property="og:locale" content="fr_FR">
    <link rel="icon" href="/wp-content/themes/client/assets/icons/LOGO-PLAI.svg">
    <title><?= get_the_title() ?> - PLAI></title>
    <link rel="stylesheet" type="text/css" href="<?= dw_asset('css'); ?>">
    <script src="<?= dw_asset('js') ?>" defer></script>
</head>
<body>

<header>


    <h1 class="sro"><?= get_the_title() ?></h1>

    <nav class="navigation">
        <h2 class="navigation__title sro">Menu de navigation custom</h2>

        <a href="<?= \wtl\Authentication::is_logged_in() ? home_url('/mon-ecole') : home_url('/') ?>"
           class="navigation__logo-link" title="Retour à l'accueil">
            <img class="navigation__logo-plai" src="/wp-content/themes/client/assets/icons/LOGO-PLAI.svg"
                 alt="logo du plai">
        </a>

        <button class="hamburger-menu js-menu-toggle-btn"
                aria-label="Ouvrir le menu mobile"
                aria-expanded="false"
                aria-controls="main-menu"
        ><span class="hamburger-menu__line"></span>
        </button>

        <ul class="navigation__list">

            <?php if (\wtl\Authentication::is_logged_in()) : ?>

                <?php foreach (portfolio_get_navigation_links('header-connecte') as $link) : ?>
                    <li class="navigation__list-item">
                        <a class="navigation__link" href="<?= $link->href ?>"><?= $link->label ?></a>
                    </li>
                <?php endforeach; ?>
                <li class="navigation__list-item">
                    <a class="navigation__link" href="<?= esc_url(add_query_arg('wls_logout', '1', home_url('/'))) ?>">Déconnexion</a>
                </li>
            <?php else : ?>
                <!--        utilisateur non connecté-->

                <?php foreach (portfolio_get_navigation_links('header') as $link) : ?>
                    <li class="navigation__list-item">
                        <a class="navigation__link" href="<?= $link->href ?>"><?= $link->label ?></a>
                    </li>
                <?php endforeach; ?>

                <li class="navigation__list-item">
                    <a class="navigation__link" href="/connexion">Je suis enseignant</a>
                </li>
                <?php
                if (is_front_page()):
                    $falc = isset($_GET['falc']) ? sanitize_text_field($_GET['falc']) : '';
                    ?>
                    <li class="navigation__list-item">
                        <a class="navigation__link"
                           href="<?= $falc === 'true' ? '/' : '/?falc=true' ?>"><?= $falc === 'true' ? 'Mode normal' : 'Mode falc' ?></a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>


        </ul>
    </nav>
</header>
<main class="contenu">
