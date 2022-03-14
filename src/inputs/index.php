<?php
$root = $_SERVER['DOCUMENT_ROOT'];

$system_inputs = glob($root . '/src/inputs/system' . '/*.php');

$custom_inputs = glob($root . '/src/inputs/custom' . '/*.php');


function fillInputs($files): array {
    $merged = [];
    foreach ($files as $file) {
        $inputs = require($file);
        $merged = array_merge($merged, $inputs);
    }
    return $merged;
}

return $all_inputs = array_merge(fillInputs($system_inputs), fillInputs($custom_inputs));

