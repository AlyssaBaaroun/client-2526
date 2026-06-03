<?php
/*
Template Name: Mentions légale template
*/

get_header(); ?>

    <section class="notices">

        <h2 role="heading" aria-level="2" id="title" data-showup="true"
            class="notices__title"><?= esc_html(get_field('title_noticies')) ?></h2>

        <?php if (have_rows('legal_noticies')): ?>

            <?php while (have_rows('legal_noticies')) : the_row(); ?>

                <article data-showup="true">
                    <h3 class="notices__sub-title"><?= esc_html(get_sub_field('sub_title')) ?></h3>
                    <div class="notices__text">
                        <?= wp_kses_post(get_sub_field('text_noticies')) ?>
                    </div>
                </article>

            <?php endwhile; ?>
        <?php endif; ?>
    </section>






<?php get_footer(); ?>