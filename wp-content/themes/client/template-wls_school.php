<?php
/*
 * Template Name: School template
 */

get_header(); // c'est la page mon école, sensibilasition, referent, plus nom de l'ecole

if (!\wtl\Authentication::is_logged_in()) {
    wp_safe_redirect(home_url('/connexion/'));
    exit;
}

if (!\wtl\Authentication::has_school_access()) {
    wp_safe_redirect(home_url('/mon-espace/'));
    exit;
}

// Injection du contexte école
if (!\wtl\Helpers::setup_school_post_context()) {
    echo '<p>Aucune école disponible.</p>';
    get_footer();
    return;
}
?>

<?= get_the_title(); ?>
    <p><?= \wtl\Helpers::get_field('referent_prenom') ?></p>
    <p><?= \wtl\Helpers::get_field('referent_email') ?></p>
    <p><?= \wtl\Helpers::get_field('address_school') ?></p>
<?php get_template_part('templates/components/fase/fase-warning'); ?>

<?php
\wtl\Helpers::reset_post_context();
get_footer(); ?>