<?php

ob_start();
session_start();
require '../../../_app/Config.inc.php';

$getInput = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($getInput['action'])):
    /*
      |-----------------------------------------------------------------------------
      | Adiciona um anuncio da lista de desejos e retorna novos valores pra interface
      |-----------------------------------------------------------------------------
     */
    if ($getInput['action'] === 'add'):
        if (!in_array($getInput['id'], $_SESSION[LISTA_DESEJO])):
            $_SESSION[LISTA_DESEJO][] = $getInput['id'];
        endif;
        $jSON['add_lista'] = true;
        $jSON['action'] = 'remove';
        $jSON['img'] = 'https://img.icons8.com/material/35/2495ff/like.png';
    endif;
    /*
      |-----------------------------------------------------------------------------
      | Remove um anuncio da lista de desejos e retorna novos valores pra interface
      |-----------------------------------------------------------------------------
     */
    if ($getInput['action'] === 'remove'):
        $key = array_search($getInput['id'], $_SESSION[LISTA_DESEJO]);
        unset($_SESSION[LISTA_DESEJO][$key]);
        $jSON['add_lista'] = true;
        $jSON['action'] = 'add';
        $jSON['img'] = 'https://img.icons8.com/material-outlined/35/ffb70b/hearts-filled.png';
    endif;
else:
    $jSON['erro'] = 'Ação solicitada incorreta';
endif;

echo json_encode($jSON);
