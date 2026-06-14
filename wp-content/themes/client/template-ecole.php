<?php
/*
Template Name: Mon ecole template
*/

get_header();

if (!\wtl\Authentication::is_logged_in()) {
    wp_safe_redirect(home_url('/connexion/'));
    exit;
}
?>
<?php get_template_part('templates/components/fase/fase-warning');
?>

<?php if (\wtl\Authentication::has_school_access()) : ?>

    <div class="backGroundPinkStageSchool">
        <section class="mySchool" data-showup="true" itemscope itemtype="https://schema.org/Service">
            <div class="mySchool__intro">
                <h2 class="mySchool__title" itemprop="name"><?= get_field('title') ?></h2>
                <div class="mySchool__text" itemprop="description"><?= wp_kses_post(get_field('intervention_text')) ?></div>
            </div>

            <div class="mySchool__ref" itemscope itemtype="https://schema.org/Person">
                <h3 class="mySchool__referent-title"><?= \wtl\Helpers::get_field('mon_ref') ?></h3>
                <p class="mySchool__referent-name" itemprop="affiliation"><?= \wtl\Helpers::get_field('referent_prenom') ?></p>
                <a class="mySchool__referent-contact" itemprop="email"
                   href="mailto:<?= \wtl\Helpers::get_field('referent_email') ?>"><?= \wtl\Helpers::get_field('referent_email') ?>
                </a>
            </div>
        </section>
    </div>

    <section class="mySchool__warning" data-showup="true">
        <h2 class="sro">Pas de demandes individuelles</h2>
        <div class="mySchool__warning-text"><?= wp_kses_post(get_field('explicatifs_dmd')) ?></div>
    </section>
    <?php \wtl\Helpers::reset_post_context(); ?>

<?php endif; ?>
<?php
get_footer();
?>
