<?php
$falc = isset($_GET['falc']) ? sanitize_text_field($_GET['falc']) : '';
?>

<?php $falc === 'true'
    ? get_template_part('templates/components/stage/parts/stage-falc')
    : get_template_part('templates/components/stage/parts/stage');
?>
