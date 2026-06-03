<?php
/*
Template Name: Ressources template
*/

get_header();
$image = get_field('img_intro');


?>
    <div class="backGroundPinkStageSchool">

        <section class="intro" data-showup="true">

            <article class="intro__content">
                <h2 class="intro__title"><?= get_field('intro_title') ?></h2>
                <div class="intro__text"><?= wp_kses_post(get_field('sub_desc_intro')) ?></div>
            </article>

            <?php if ($image): ?>
                <?= wp_get_attachment_image($image['id'], 'square-medium', false, [
                        'alt' => $image['alt'],
                        'class' => 'intro__image',
                        'loading' => 'lazy',
                ]); ?>
            <?php endif; ?>
        </section>
    </div>


    <section class="aiTools">
        <h2 class="aiTools__title" data-showup="true"><?= esc_html(get_field('first_title')) ?></h2>

        <div class="aiTools__wrapper">
            <article class="aiTools__container aiTools__container--help" data-showup="true">
                <?php if (have_rows('help_ai')): ?>
                    <h3 class="aiTools__sub-title"><?= get_field('sub_title_hepl_enseignement') ?></h3>
                    <ul class="aiTools__list">
                        <?php while (have_rows('help_ai')): the_row();
                            $link = get_sub_field('link_ressource_two');
                            $name_link = get_sub_field('link_nametwo');
                            ?>
                            <li class="aiTools__item" data-showup="true">
                                <a href="<?= esc_url($link['url']) ?>"
                                   title="<?= esc_attr($link['title']) ?>"
                                   target="<?= esc_attr($link['target']) ?>">
                                    <span class="help__name"><?= esc_html($name_link) ?></span>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </article>


            <article class="aiTools__container aiTools__container--didact" data-showup="true">
                <?php if (have_rows('didact_ai')): ?>
                    <h3 class="aiTools__sub-title"><?= get_field('sub_title_tools') ?></h3>
                    <ul class="aiTools__list">
                        <?php while (have_rows('didact_ai')): the_row();
                            $link = get_sub_field('link_ressource_tools');
                            $name_link = get_sub_field('link_name_tools');
                            ?>
                            <li class="aiTools__item" data-showup="true">
                                <a href="<?= esc_url($link['url']) ?>"
                                   title="<?= esc_attr($link['title']) ?>"
                                   target="<?= esc_attr($link['target']) ?>">
                                    <span class="aiTools__name"><?= esc_html($name_link) ?></span>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </article>


            <article class="aiTools__container aiTools__container--detect" data-showup="true">
                <?php if (have_rows('text_ai')): ?>
                    <h3 class="aiTools__sub-title"><?= get_field('sub_title_detect') ?></h3>
                    <ul class="aiTools__list">
                        <?php while (have_rows('text_ai')): the_row();
                            $link = get_sub_field('link_ressource_detect');
                            $name_link = get_sub_field('link_name_detect');
                            ?>
                            <li class="aiTools__item" data-showup="true">
                                <a href="<?= esc_url($link['url']) ?>"
                                   title="<?= esc_attr($link['title']) ?>"
                                   target="<?= esc_attr($link['target']) ?>">
                                    <span class="aiTools__name"><?= esc_html($name_link) ?></span>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </article>
        </div>

    </section>

    <section class="presentation">
        <h2 class="presentation__title" data-showup="true"><?= esc_html(get_field('second_title')) ?></h2>

        <div class="presentation__wrapper presentation__wrapper--pres ">

            <article class="presentation__container presentation__container--create" data-showup="true">
                <?php if (have_rows('pc_ressources')): ?>
                    <h3 class="presentation__sub-title"><?= get_field('sub_title_pc') ?></h3>
                    <ul class="presentation__list">
                        <?php while (have_rows('pc_ressources')): the_row();
                            $link = get_sub_field('link_ressource_pc');
                            $name_link = get_sub_field('link_name_pc');
                            ?>
                            <li class="presentation__item" data-showup="true">
                                <a href="<?= esc_url($link['url']) ?>"
                                   title="<?= esc_attr($link['title']) ?>"
                                   target="<?= esc_attr($link['target']) ?>">
                                    <span class="presentation__name"><?= esc_html($name_link) ?></span>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </article>


            <article class="presentation__container presentation__container--mind" data-showup="true">
                <?php if (have_rows('mind_ressources')): ?>
                    <h3 class="presentation__sub-title"><?= get_field('mind_title') ?></h3>
                    <ul class="presentation__list">
                        <?php while (have_rows('mind_ressources')): the_row();
                            $link = get_sub_field('link_ressource_mind');
                            $name_link = get_sub_field('link_name_mind');
                            ?>
                            <li class="presentation__item" data-showup="true">
                                <a href="<?= esc_url($link['url']) ?>"
                                   title="<?= esc_attr($link['title']) ?>"
                                   target="<?= esc_attr($link['target']) ?>">
                                    <span class="presentation__name"><?= esc_html($name_link) ?></span>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </article>
        </div>
    </section>


    <section class="useful">
        <h2 class="useful__title" data-showup="true"><?= esc_html(get_field('third_title')) ?></h2>

        <div class="useful__wrapper useful__wrapper--use ">

            <article class="useful__container useful__container--math">
                <?php if (have_rows('mh_ressources')): ?>
                    <h3 class="useful__sub-title" data-showup="true"><?= get_field('sub_title_math') ?></h3>
                    <ul class="useful__list">
                        <?php while (have_rows('mh_ressources')): the_row();
                            $link = get_sub_field('link_ressource_math');
                            $name_link = get_sub_field('link_name_math');
                            ?>
                            <li class="useful__item" data-showup="true">
                                <a href="<?= esc_url($link['url']) ?>"
                                   title="<?= esc_attr($link['title']) ?>"
                                   target="<?= esc_attr($link['target']) ?>">
                                    <span class="useful__name"><?= esc_html($name_link) ?></span>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </article>


            <article class="useful__container useful__container--fr">
                <?php if (have_rows('fr_ressources')): ?>
                    <h3 class="useful__sub-title" data-showup="true"><?= get_field('sub_title_fr') ?></h3>
                    <ul class="useful__list">
                        <?php while (have_rows('fr_ressources')): the_row();
                            $link = get_sub_field('link_ressource_fr');
                            $name_link = get_sub_field('link_name_fr');
                            ?>
                            <li class="useful__item" data-showup="true">
                                <a href="<?= esc_url($link['url']) ?>"
                                   title="<?= esc_attr($link['title']) ?>"
                                   target="<?= esc_attr($link['target']) ?>">
                                    <span class="useful__name"><?= esc_html($name_link) ?></span>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </article>

        </div>
    </section>


<?php
get_footer();
?>