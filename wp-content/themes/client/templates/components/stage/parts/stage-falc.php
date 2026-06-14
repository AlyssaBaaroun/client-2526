<?php
$title = get_field('stage_title_falc');
$text = get_field('stage_text_falc');
$image = get_field('stage_image_falc');
?>

<?php if ($title || $text || $image): ?>
    <section class="heroFalc" itemscope itemtype="https://schema.org/Service">

        <div class="heroFalc__text-container" data-showup="true">
            <?php if ($title): ?>
                <h2 class="heroFalc__title" itemprop="name">
                    <?= $title ?>
                </h2>
            <?php endif; ?>
            <?php if ($text): ?>
                <div class="heroFalc__text" itemprop="description">
                    <?= $text ?>
                </div>
            <?php endif; ?>
        </div>
        <?php if ($image): ?>
            <?= wp_get_attachment_image($image['ID'], 'square-medium', false, [
                    'alt' => $image['alt'],
                    'class' => 'heroFalc__imagefalc',
                    'loading' => 'lazy',
            ]); ?>
        <?php endif; ?>
    </section>
<?php endif; ?>


<section class="whoWeAreFalc" itemscope itemtype="https://schema.org/Organization">
    <div class="whoWeAreFalc__content">

        <div class="whoWeAreFalc__left" data-showup="true">
            <h2 class="whoWeAreFalc__title"><?= get_field('title_whoweare_falc') ?></h2>
            <div class="whoWeAreFalc__sub-text" itemprop="member"><?= wp_kses_post(get_field('text_woweare_falc')) ?></div>
        </div>

        <article class="whoWeAreFalc__right" data-showup="true">
            <?php if (have_rows('plais_number_falc')): ?>

                <div class="whoWeAreFalc__Number" itemprop="agentInteractionStatistic">

                    <?php while (have_rows('plais_number_falc')) : the_row(); ?>

                        <div class="whoWeAreFalc__item" data-showup="true">

                            <h3 class="sro">les chiffres du plai</h3>

                            <dl class="whoWeAreFalc__text">
                                <dt><?= esc_html(get_sub_field('number')) ?></dt>
                                <dd><?= esc_html(get_sub_field('labels_number')) ?></dd>
                            </dl>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
            <?php if ($image): ?>
                <?= wp_get_attachment_image($image['ID'], 'square-medium', false, [
                        'alt' => $image['alt'],
                        'class' => 'whoWeAreFalc__imagefalc',
                        'loading' => 'lazy',
                ]); ?>
            <?php endif; ?>
        </article>

    </div>
</section>

<section class="missionsFalc" data-showup="true" itemscope itemtype="https://schema.org/Service">


    <h2 class="missionsFalc__title"><?= get_field('missions_title_falc') ?></h2>
    <div class="missionsFalc__cards">
        <div class="missionsFalc__sub-text"><?= wp_kses_post(get_field('missions_sub_text_falc')) ?></div>

        <?php if (have_rows('all_missions_falc')): ?>


            <?php while (have_rows('all_missions_falc')) : the_row(); ?>

                <article class="missionsFalc__item" data-showup="true">

                    <h3 class="missionsFalc__item-title" itemprop="offers"><?= get_sub_field('missions_title_falc') ?></h3>
                    <div class="missionsFalc__item-text"><?= wp_kses_post(get_sub_field('missions_text_falc')) ?></div>
                </article>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</section>

<section class="contactFpFalc" itemscope itemtype="https://schema.org/Audience">

    <div class="contactFpFalc__contenair" data-showup="true">
        <h2 class="contactFpFalc__title"><?= get_field('title_contact_falc') ?></h2>
        <div class="contactFpFalc__text" itemprop="audienceType"><?= wp_kses_post(get_field('text_whoscontacting_falc')) ?></div>
    </div>
    <?php if ($image): ?>
        <?= wp_get_attachment_image($image['ID'], 'square-medium', false, [
                'alt' => $image['alt'],
                'class' => 'contactFpFalc__imagefalc',
                'loading' => 'lazy',
        ]); ?>
    <?php endif; ?>
</section>
