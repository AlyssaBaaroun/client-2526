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
?>
<?php if ($title || $text || $image): ?>
    <div class="backGroundPinkStageSchool">
        <section class="singleSensi" data-showup="true">
            <?php if ($image): ?>
                <?= wp_get_attachment_image($image['id'], 'square-medium', false, [
                        'alt' => $image['alt'],
                        'class' => 'singleSensi__image',
                        'loading' => true,
                ]); ?>
            <?php endif; ?>

            <article class="singleSensi__text-container" data-showup="true">
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
            </article>
        </section>
    </div>

    <section class="explains">
        <h3 class="explains__title" data-showup="true"><?= get_field('second_title') ?></h3>
        <div class="explains__desc" data-showup="true"><?= wp_kses_post(get_field('sensi_desc')) ?></div>
    </section>


    <section class="signes">
        <h2 class="signes__title" data-showup="true"><?= get_field('third_signes') ?></h2>
        <div class="signes__content" >
            <?php if (have_rows('all_signes')): ?>
                <div class="signes__cards">
                    <?php while (have_rows('all_signes')) :
                        the_row(); ?>
                        <article class="signes__item" data-showup="true">
                            <h3 class="sro">Les signes à repérer du plai</h3>
                            <p class="signes__text"><?= esc_html(get_sub_field('signes')) ?></p>
                        </article>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="adjustments">
        <h2 class="adjustments__title" data-showup="true"><?= get_field('fourth_title') ?></h2>
        <div class="adjustments__content">

            <?php if (have_rows('all_adjustments')): ?>

                <div class="adjustments__cards">

                    <?php while (have_rows('all_adjustments')) : the_row(); ?>

                        <article class="adjustments__item--other" data-showup="true">
                            <h3 class="sro">Les aménagements à repérer du plai</h3>
                            <p class="adjustments__text"><?= esc_html(get_sub_field('adjustments')) ?>
                            </p>
                        </article>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

<?php endif; ?>

<section class="remember" data-showup="true">
    <h3 class="remember__title"><?= get_field('remember_title') ?></h3>
    <div class="remember__text  mySchool__warning-text"><?= wp_kses_post(get_field('remember_text')) ?></div>
</section>


<?php get_footer(); ?>

