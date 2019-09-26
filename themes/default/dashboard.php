<?php
/**
 * Identifica a página a ser carrega pela url
 * O ideal para a segurança é criar um vetor com 
 * as páginas permitidas e fazer uma verificação se 
 * a pagina informada na URL pode ser carregada
 */
if(!empty($URL[1])):
    $pagina = $URL[1];
else:
    $pagina = 'index';
endif;

require REQUIRE_PATH . '/dashboard/index.php';

