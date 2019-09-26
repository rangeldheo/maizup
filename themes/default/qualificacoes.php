<?php

/*
  |-----------------------------------------------------------------------------
  | widget avaliacoes
  |-----------------------------------------------------------------------------
 */
$Page = (!empty($URL[1]) ? $URL[1] : 1);
$Pager = new Pager(BASE . "/qualificacoes/", "<<", ">>", 15);
$Pager->ExePager($Page,15);
$Pager->ExePaginator('qualificacoes', 'WHERE qualificacao_tipo = :tipo', "tipo=positivo");

$widgetQualificacoes = null;
$objQualificacao = new Qualificacao();
if ($objQualificacao->getQualificacoesPositivas($Pager->getLimit(),$Pager->getOffset())):
    $objWidget->createWidget('widget.qualificacoes')
            ->setWidgetTemplate('home/widget.qualificacoes')
            ->setWidgetConfig([
                'base' => BASE,
                'include_path' => INCLUDE_PATH,
                'paginacao'=>$Pager->getPaginator()
            ])
            ->setData($objQualificacao->getResult());
    $widgetQualificacoes = $objWidget->getWidget('widget.qualificacoes');
    echo $widgetQualificacoes;
endif;