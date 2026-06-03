<?php
$social_media = portfolio_get_navigation_links('social-media');
$footer = portfolio_get_navigation_links('footer');
$utils = portfolio_get_navigation_links('utils');
$phone_number = get_field('phone_number', 'option');
$contact_mail = get_field('contact_mail', 'option');
?>
</main>
<footer class="footer">
    <div class="backGroundPinkFooter">
        <div class="footer__container">
            <div class="footer__top">
                <div class="footer__brand">
                    <a href="<?= \wtl\Authentication::is_logged_in() ? home_url('/mon-ecole') : home_url('/') ?>"
                       class="footer__logo-link" title="Retour à l'accueil">
                        <img class="footer__plaiFooter" src="/wp-content/themes/client/assets/icons/LOGO-PLAI.svg"
                             alt="logo du plai">
                    </a>
                </div>

                <nav class="footer__nav" aria-labelledby="footer-nav-title">
                    <h2 class="footer__title" id="footer-nav-title">Navigation</h2>
                    <ul class="footer__list">
                        <?php if (\wtl\Authentication::is_logged_in()) : ?>

                            <?php foreach (portfolio_get_navigation_links('header-connecte') as $link) : ?>
                                <li class="navigation__list-item">
                                    <a class="navigation__link" href="<?= $link->href ?>"><?= $link->label ?></a>
                                </li>
                            <?php endforeach; ?>
                            <li class="navigation__list-item">
                                <a class="navigation__link"
                                   href="<?= esc_url(add_query_arg('wls_logout', '1', home_url('/'))) ?>">Déconnexion</a>
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
            </div>

            <div class="footer__bottom">
                <ul class="footer__legal">
                    <li class="footer__legal-item">
                        <a class="footer__legal-link" href="/mentions-legale/">Mentions légales</a>
                    </li>
                </ul>

                <p class="footer__copyright">
                    <strong>©2026</strong> Alyssa Baaroun. Tous droits réservés.
                </p>
            </div>
        </div>
    </div>
</footer>

</body>
</html>
