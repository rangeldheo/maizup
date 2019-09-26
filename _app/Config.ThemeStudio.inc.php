<?php

if (!$WorkControlDefineConf):
    /*
      |-----------------------------------------------------------------------------
      | dados seguros evita erros de digitação e falta de coersão
      |-----------------------------------------------------------------------------
     */
    define('INSERT', 'insert');
    define('UPDATE', 'update');
    define('DELETE', 'delete');
    define('JSON', 'json');
    define('OBJECT', 'object');
    /*
      |-----------------------------------------------------------------------------
      | formato de datas
      |-----------------------------------------------------------------------------
     */
    define('TIMESTAMP', 'Y-m-d');
    define('TIMESTAMP_H', 'Y-m-d H:i:s');
    define('TIMESTAMP_PT', 'd/m/Y');
    define('TIMESTAMP_PT_H', 'd/m/Y H:i:s');
    /*
      |-----------------------------------------------------------------------------
      | Constantes para a lista de desejos
      |-----------------------------------------------------------------------------
     */
    define('LISTA_DESEJO', 'lista_desejos');
endif;

function themeStudioAutoLoad($Class) {
    $cDir = [
        'Maizup',
        'Maizup/Sql',
        'Maizup/Models',
        'Maizup/Controllers',
        'Maizup/Views',
        'Maizup/Repository',
        'Maizup/Interfaces',
        'Maizup/DAO',
        'Maizup/Abstracts',
        'Maizup/Structures',
        'Maizup/StaticSingles',
        'Maizup/Formatter',
    ];
    $iDir = null;

    foreach ($cDir as $dirName):
        if (!$iDir && file_exists(__DIR__ . '/' . $dirName . '/' . $Class . '.class.php') && !is_dir(__DIR__ . '/' . $dirName . '/' . $Class . '.class.php')):
            include_once(__DIR__ . '/' . $dirName . '/' . $Class . '.class.php');
            $iDir = true;
        endif;
    endforeach;
}

spl_autoload_register("themeStudioAutoLoad");

function getImgMedalha($patente) {
    $imagem = [
        '1' => '1.png',
        '2' => '2.png',
        '3' => '3.png',
        '4' => '4.png',
    ];
    if (!empty($patente)):
        return $imagem[$patente];
    else:
        return $patente;
    endif;
}
