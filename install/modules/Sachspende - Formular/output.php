<?php
$out = '';
$step = rex_request('step','int',1);
$fragment = new rex_fragment();

if (1 == $step) {
    $out = $fragment->parse('sachspende_step_1.php');
} elseif (2 == $step) {
    $out = $fragment->parse('sachspende_step_2.php');
} elseif (3 == $step) {
    $out = $fragment->parse('sachspende_step_3.php');
}

?>

<div class="uk-section uk-padding-remove-top">
    <?= $out ?>
</div>