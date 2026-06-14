<?php
if (!\wtl\Authentication::is_logged_in()) {
    wp_safe_redirect(home_url('/connexion/'));
    exit;
}

// Template Name: Single-Sensibilisation
?>
<?php get_header(); ?>

<?php
$title = get_field('sensi_title');
$text = get_field('sensi_recap');
$image = get_field('sensi_image');

$sensibilisations = \wtl\Helpers::get_field('sensibilisations');

$id_nonsuivies = array_map(function ($sensi) {
    return $sensi->ID;
}, $sensibilisations ?: []);

$non_suivies = get_posts([
        'post_type' => 'sensibilisation',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'exclude' => $id_nonsuivies,
        'post__not_in' => [get_the_ID()],

]);

if (!empty($non_suivies)) {
    $non_suivies = array_slice($non_suivies, 0, 3);
}
if (!empty($sensibilisations)) {
    $sensibilisations = array_slice($sensibilisations, 0, 3);
}
$page_id = get_queried_object_id();

?>
<?php if ($title || $text || $image): ?>
    <div class="backGroundPinkStageSchool">
        <section class="singleSensi" data-showup="true">
            <div class="singleSensi__text-container" data-showup="true">
                <?php if ($title): ?>
                    <h2 class="singleSensi__title">
                        <?= $title ?>
                    </h2>
                <?php endif; ?>
                <?php if ($text): ?>
                    <div class="singleSensi__text">
                        <?= $text ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php if ($image): ?>
                <?= wp_get_attachment_image($image['ID'], 'square-small', false, [
                        'alt' => $image['alt'],
                        'class' => 'singleSensi__image',
                        'loading' => 'lazy',
                ]); ?>
            <?php endif; ?>
        </section>
    </div>

    <section class="explains" itemscope itemtype="https://schema.org/MedicalCondition">
        <h3 class="explains__title" data-showup="true" itemprop="name"><?= get_field('second_title') ?></h3>
        <div class="explains__desc" data-showup="true"
             itemprop="cause"><?= wp_kses_post(get_field('sensi_desc')) ?></div>
    </section>


    <section class="signes">
        <h2 class="signes__title" data-showup="true"><?= get_field('third_signes') ?></h2>
        <div class="signes__content">
            <?php if (have_rows('all_signes')): ?>
                <ul class="signes__cards" itemscope itemtype="https://schema.org/ItemList">
                    <?php while (have_rows('all_signes')) :
                        the_row(); ?>
                        <li class="signes__item" data-showup="true" itemprop="itemListElement">
                            <p class="signes__text"><?= esc_html(get_sub_field('signes')) ?></p>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>
        </div>
    </section>

    <section class="adjustments">
        <h2 class="adjustments__title" data-showup="true"><?= get_field('fourth_title') ?></h2>
        <div class="adjustments__content">

            <?php if (have_rows('all_adjustments')): ?>

                <ul class="adjustments__cards" itemscope itemtype="https://schema.org/ItemList">

                    <?php while (have_rows('all_adjustments')) : the_row(); ?>

                        <li class="adjustments__item--other" data-showup="true" itemprop="itemListElement">
                            <p class="adjustments__text"><?= esc_html(get_sub_field('adjustments')) ?>
                            </p>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>
        </div>
    </section>

<?php endif; ?>

<section class="remember" data-showup="true">
    <h3 class="remember__title"><?= get_field('remember_title') ?></h3>
    <div class="remember__text  mySchool__warning-text"><?= wp_kses_post(get_field('remember_text')) ?></div>
</section>

<section class="suivies">

    <h3 class="suivies__subTitle"><?= get_field('othersensi_title', $page_id) ?></h3>
    <div class="suivies__container">
        <?php if ($sensibilisations) : ?>
            <?php foreach ($sensibilisations as $sensibilisation) : ?>
                <article class="card card--suivie" itemscope itemtype="https://schema.org/Course">
                    <div class="card__cardsText">
                        <h3 itemprop="name"><?= $sensibilisation->post_title ?></h3>

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
            <p class="suivies__none">Aucune sensibilisation</p>
        <?php endif; ?>
    </div>
</section>


<section class="nonSuivies" itemscope itemtype="https://schema.org/ItemList">
    <h2 class="sro">Sensibilisations non suivies</h2>
    <div class="nonSuivies__container">
        <?php if (!empty($non_suivies)) : ?>
            <?php foreach ($non_suivies as $non_suivie) : ?>
                <article class="card card--off" title="Sensibilisation non suivie par votre école"
                         itemprop="itemListElement">
                    <div class="card__cardsText">
                        <h3 itemprop="name"><?= $non_suivie->post_title ?></h3>

                        <div class="card__cardsLink--disabled"><?= get_field('details_false', $page_id) ?></div>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="nonSuivies__none">Si vous souhaitez en voir davantage, allez dans <a
                        href="<?= esc_url(home_url('/sensibilisations/')); ?>">vos sensibilisations.</a></p>
        <?php endif; ?>
    </div>
</section>


<?php if (empty($sensibilisations) && empty($non_suivies)) : ?>
    <p class="noOtherOne__none">Aucune autre sensibilisation disponible.</p>
<?php endif; ?>

<?php get_footer(); ?>

