<?php
/*
Template Name: Mes sensibilisations
*/
// Je viens définir mon tableau d'arguments pour constituer ma QUERY
$args = [
        'post_type' => 'sensibilisation',
];

$sensibilisations = new WP_Query($args);
?>

<?php get_header();

if (!\wtl\Authentication::is_logged_in()) {
    wp_safe_redirect(home_url('/connexion/'));
    exit;
}

if (!\wtl\Authentication::has_school_access()) {
    wp_safe_redirect(home_url('/mon-espace/'));
    exit;
}

$page_id = get_queried_object_id();

if (!\wtl\Helpers::setup_school_post_context()) {
    echo '<p>Aucune école disponible.</p>';
    get_footer();
    return;
}

$sensibilisations = \wtl\Helpers::get_field('sensibilisations');

$id_nonsuivies = array_map(function ($sensi) {
    return $sensi->ID;
}, $sensibilisations ?: []);

$non_suivies = get_posts([
        'post_type' => 'sensibilisation',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'exclude' => $id_nonsuivies

]);

$image = get_field('rep_image', $page_id);


?>
    <div class="backGroundPinkStageSchool">
        <section class="sensibilisation">
            <article class="sensibilisation__content">
                <h2 class="sensibilisation__title"><?= get_field('title_sensi', $page_id) ?></h2>
                <div class="sensibilisation__desc"><?= wp_kses_post(get_field('desc_sensi', $page_id)) ?></div>
            </article>


            <?php if ($image): ?>
                <?= wp_get_attachment_image($image['id'], 'square-medium', false, [
                        'alt' => $image['alt'],
                        'class' => 'sensibilisation__image',
                        'loading' => 'lazy',
                ]); ?>
            <?php endif; ?>

        </section>
    </div>

    <section class="suivies">

        <h3 class="suivies__subTitle"><?= get_field('donesensi_title', $page_id) ?></h3>
        <div class="suivies__container">
            <?php if ($sensibilisations) : ?>
                <?php foreach ($sensibilisations as $sensibilisation) : ?>
                    <article class="card card--suivie">
                        <div class="card__cardsText">
                            <h3> <?= $sensibilisation->post_title ?></h3>

                            <?php $lien = get_permalink($sensibilisation->ID) ?>
                            <?php if ($lien): ?>
                                <a href="<?= esc_url($lien) ?>" class="card__cardsLink"
                                   title="lien vers la sensibilisation : <?= esc_attr(get_the_title($sensibilisation->ID)) ?>"><?= get_field('details', $page_id) ?></a>

                            <?php else: ?>

                                <div class="card__cardsLink--disabled"><?= get_field('details_false', $page_id) ?></div>
                            <?php endif; ?>
                            <span class="card__badge">Suivie</span>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Aucune sensibilisation</p>
            <?php endif; ?>
        </div>
    </section>


    <section class="nonSuivies">

        <h3 class="nonSuivies__subTitle"><?= get_field('notdonesensi_title', $page_id) ?></h3>
        <div class="nonSuivies__container">
            <?php if ($non_suivies) : ?>
                <?php foreach ($non_suivies as $non_suivie) : ?>
                    <article class="card card--off" title="Sensibilisation non suivie par votre école">
                        <div class="card__cardsText">
                            <h3> <?= $non_suivie->post_title ?></h3>

                            <div class="card__cardsLink--disabled"><?= get_field('details_false', $page_id) ?></div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Aucune sensibilisation</p>
            <?php endif; ?>
        </div>
    </section>

    <section class="more   mySchool__warning">
        <div class=" more__warning-text   mySchool__warning-text"><?= wp_kses_post(get_field('expl_text', $page_id)) ?></div>
    </section>


<?php
\wtl\Helpers::reset_post_context();
get_footer();
?>