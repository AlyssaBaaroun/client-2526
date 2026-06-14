<?php
/*
Template Name: Mon espace Enseignant template
*/
get_header();
$image = get_field('par_image');

?>
    <div class="backGroundPinkStageSchool">
        <section class="referent" data-showup="true" itemscope itemtype="https://schema.org/ContactPoint">

            <div class="referent__intro mySchool__intro">
                <h2 itemprop="contactType" class="referent__title"><?= get_field('referent_title') ?></h2>
                <div class="referent__text"><?= wp_kses_post(get_field('referent_intro')) ?></div>
            </div>
            <?php if (\wtl\Authentication::has_school_access()):
                \wtl\Helpers::setup_school_post_context(); ?>
                <div class="referent__ref mySchool__ref">
                    <h3 class="referent__referent-title  mySchool__referent-title"><?= \wtl\Helpers::get_field('mon_ref') ?></h3>
                    <p class="referent__referent-name mySchool__referent-name"
                       itemprop="name"><?= \wtl\Helpers::get_field('referent_prenom') ?></p>
                    <a class="referent__referent-contact  mySchool__referent-contact"
                       title="vers le mail de :<?= \wtl\Helpers::get_field('referent_email') ?>"
                       href="mailto:<?= \wtl\Helpers::get_field('referent_email') ?>"
                       itemprop="email"><?= \wtl\Helpers::get_field('referent_email') ?>
                    </a>
                </div>
                <?php \wtl\Helpers::reset_post_context(); ?>
            <?php endif; ?>
        </section>
    </div>

    <section class="fonctionnement">
        <h2 class="fonctionnement__title" data-showup="true"><?= esc_html(get_field('fonct_title')) ?></h2>
        <?php if (have_rows('etapes')): ?>
            <ul class="fonctionnement__container" data-showup="true" itemscope itemtype="https://schema.org/ItemList">
                <?php while (have_rows('etapes')) : the_row(); ?>
                    <li class="fonctionnement__text" itemprop="itemListElement"
                    ><?= esc_html(get_sub_field('etapes_repeteur')) ?></li>
                <?php endwhile; ?>
            </ul>
        <?php endif; ?>
    </section>

    <section class="team">
        <h2 class="team__title" data-showup="true"><?= esc_html(get_field('team_title')) ?></h2>
        <?php if (have_rows('equipes_cards')): ?>
            <div class="team__container" data-showup="true">
                <?php while (have_rows('equipes_cards')) : the_row(); ?>
                    <div class="team__text"
                         data-showup="true"><?= wp_kses_post(get_sub_field('card_content')) ?></div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </section>


    <section class="timeline" itemscope itemtype="https://schema.org/ItemList">
        <h2 class="timeline__title" data-showup="true"><?= esc_html(get_field('itin_title')) ?></h2>
        <?php if (have_rows('etapes_timeline')): ?>
            <div class="timeline__content">
                <?php while (have_rows('etapes_timeline')) : the_row(); ?>
                    <div class="timeline__item" data-showup="true" itemprop="itemListElement">
                        <dl class="timeline__text">
                            <dt><?= get_sub_field('step_timeline') ?></dt>
                            <dd><?= get_sub_field('step_desc') ?></dd>
                        </dl>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </section>

    <div class="backGroundPinkStageInterventions">
        <section class="interventions">
            <h2 class="interventions__title" data-showup="true"><?= esc_html(get_field('inter_title')) ?></h2>


            <?php if (have_rows('blocs_intervention')): ?>

                <div class="interventions__content">

                    <?php while (have_rows('blocs_intervention')) : the_row(); ?>

                        <dl class="interventions__text" data-showup="true">
                            <dt class="interventions__item-title"><?= esc_html(get_sub_field('inter_sub-title')) ?></dt>
                            <dd class="interventions__item-desc"><?= esc_html(get_sub_field('list_iterms')) ?>
                            </dd>
                        </dl>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </section>
    </div>


    <section class="par" itemscope itemtype="https://schema.org/HowTo">
        <h2 class="par__title" data-showup="true"><?= esc_html(get_field('par_title')) ?></h2>

        <div class="par__wrapper">

            <article class="par__contenair" data-showup="true">
                <div class="background-double">
                    <?php if (have_rows('par_etapes')): ?>

                        <h3 class="par__sub-title"><?= esc_html(get_field('par_procedure_title')) ?></h3>
                        <ul class="par__content" itemprop="step">
                            <?php while (have_rows('par_etapes')) : the_row(); ?>

                                <li class="par__text">
                                    <?= wp_kses_post(get_sub_field('par_mention_obligatoire')) ?>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                    <div class="par__desc">
                        <?= wp_kses_post(get_field('sub_texte_cards')) ?>
                    </div>
                </div>
            </article>
            <?= wp_get_attachment_image($image['id'], 'square-medium', false, [
                    'alt' => $image['alt'],
                    'class' => 'par__image',
                    'loading' => 'lazy',
            ]); ?>
        </div>
    </section>


<?php get_footer(); ?>