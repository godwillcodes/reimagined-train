<?php
$terms = get_the_terms(get_the_ID(), 'template_style');
$slug  = $terms && !is_wp_error($terms) ? $terms[0]->slug : null;

switch ($slug) {
    case 'new':
        locate_template('components/industries/new.php', true);
        break;

    case 'old':
    default:
        locate_template('components/industries/old.php', true);
        break;
}
