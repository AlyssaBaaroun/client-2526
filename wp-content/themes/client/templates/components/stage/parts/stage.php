<?php
$title = get_field('stage_title');
$text = get_field('stage_text');
$image = get_field('stage_image');
$btn_enseignant = get_field('link_to_connexion');
?>
<?php if ($title || $text || $image): ?>
    <div class="backGroundPink">
        <section class="hero" data-showup="true">
            <article class="hero__text-container">
                <?php if ($title): ?>
                    <h2 class="hero__title">
                        <?= $title ?>
                    </h2>
                <?php endif; ?>
                <?php if ($text): ?>
                    <div class="hero__text">
                        <?= $text ?>
                    </div>
                <?php endif; ?>

                <div class="hero__Seconde">
                    <h2 class="hero__title"><?= get_field('title_link') ?></h2>
                    <div class="hero__text"><?= wp_kses_post(get_field('stage_text_link')) ?></div>
                    <a class="hero__sub-btn" href="<?= $btn_enseignant['url'] ?>"
                       title="vers la page de connexion pour enseignants"><?= esc_html($btn_enseignant['title']) ?></a>
                </div>

            </article>
            <?php if ($image): ?>
                <?= wp_get_attachment_image($image['id'], 'square-medium', false, [
                        'alt' => $image['alt'],
                        'class' => 'hero__image',
                        'loading' => 'lazy',
                ]); ?>
            <?php endif; ?>
        </section>
    </div>

    <section class="whoWeAre">
        <div class="whoWeAre__content">

            <article class="whoWeAre__left" data-showup="true">
                <h2 class="whoWeAre__title"><?= get_field('title_whoweare') ?></h2>
                <div class="whoWeAre__sub-text"><?= wp_kses_post(get_field('text_woweare')) ?></div>
            </article>

            <article class="whoWeAre__right" data-showup="true">
                <?php if (have_rows('plais_number')): ?>

                    <div class="whoWeAre__Number">

                        <?php while (have_rows('plais_number')) : the_row(); ?>

                            <article class="whoWeAre__item" data-showup="true">

                                <h3 class="sro">les chiffres du plai</h3>

                                <dl class="whoWeAre__text">
                                    <dt><?= esc_html(get_sub_field('number')) ?></dt>
                                    <dd><?= esc_html(get_sub_field('labels_number')) ?></dd>
                                </dl>
                            </article>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </article>
        </div>
    </section>

    <section class="missions">
        <h2 class="missions__title"><?= get_field('missions_title') ?></h2>
        <div class="missions__cards" data-showup="true">
            <div class="missions__sub-text"><?= wp_kses_post(get_field('missions_sub_text')) ?></div>

            <?php if (have_rows('all_missions')): ?>


            <?php while (have_rows('all_missions')) : the_row(); ?>

                <article class="missions__item" data-showup="true">

                    <h3 class="missions__item-title"><?= get_sub_field('missions_title') ?></h3>
                    <div class="missions__item-text"><?= wp_kses_post(get_sub_field('missions_text')) ?></div>
                </article>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
    </section>

    <section class="contactFp">

        <article class="contactFp__contenair" data-showup="true">
            <h2 class="contactFp__title"><?= get_field('title_contact_fp') ?></h2>
            <div class="contactFp__text"><?= wp_kses_post(get_field('text_whoscontacting')) ?></div>
        </article>
        <?php if ($image): ?>
            <?= wp_get_attachment_image($image['id'], 'square-medium', false, [
                    'alt' => $image['alt'],
                    'class' => 'contactFp__image',
                    'loading' => 'lazy',
            ]); ?>
        <?php endif; ?>
    </section>
<?php endif; ?>