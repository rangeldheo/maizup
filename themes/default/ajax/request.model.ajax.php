<?php

ob_start();
session_start();
require '../../../_app/Config.inc.php';

$getInput = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($getInput['action'])):
    $jSON['return'] = '';
else:
    $jSON['erro'] = 'Ação solicitada incorreta';
endif;

echo json_encode($jSON);