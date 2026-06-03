<?php

if (!\wtl\Authentication::is_logged_in()) {
    return;
}

if (\wtl\Authentication::has_school_access()) {
    return;
}

$current_email = \wtl\Authentication::email();
$current_fase  = \wtl\Authentication::entered_fase();
?>
<section class="session-alert" aria-labelledby="session-alert-title">
    <div class="session-alert__container">
        <div class="session-alert__content">
            <h2 id="session-alert-title" class="session-alert__title">
                Accès école indisponible
            </h2>

            <p class="session-alert__text">
                Vous êtes bien connecté<?php if ($current_email): ?> avec l’adresse
                    <strong><?= esc_html($current_email); ?></strong><?php endif; ?>,
                mais le numéro Fase renseigné
                <?php if ($current_fase): ?>
                    (<strong><?= esc_html((string) $current_fase); ?></strong>)
                <?php endif; ?>
                ne permet pas d’accéder à la page <strong>Mon école</strong>.
            </p>

            <form method="post" class="session-alert__form" action="">
                <?php wp_nonce_field('wls_update_fase', 'wls_update_fase_nonce'); ?>
                <input type="hidden" name="wls_action" value="update_fase">

                <div class="session-alert__field">
                    <label for="session-alert-fase" class="session-alert__label">
                        <span class="session-alert__label-text">Corriger mon numéro Fase</span>
                    </label>

                    <input
                        class="session-alert__input"
                        type="number"
                        id="session-alert-fase"
                        name="wls_fase"
                        min="1"
                        step="1"
                        required
                    >
                </div>

                <div class="session-alert__actions">
                    <button type="submit" class="session-alert__button">
                        Mettre à jour
                    </button>

                    <a
                        class="session-alert__link"
                        href="<?= esc_url(add_query_arg('wls_logout', '1', home_url('/'))); ?>"
                    >
                        Se déconnecter
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>
