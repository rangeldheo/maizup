<?php

ob_start();
session_start();
require '../../../_app/Config.inc.php';

/*
  |-----------------------------------------------------------------------------
  | Widget Lista de desejos
  |-----------------------------------------------------------------------------
 */
$objWidget = new Widget();

if (!empty($_SESSION[LISTA_DESEJO])):
    $objAnuncios = new Anuncios();
    $objAnuncios->getListaDesejos($_SESSION[LISTA_DESEJO]);
    $objWidget->createWidget('widget.lista.desejos')
            ->setWidgetTemplate('home/widget.lista.desejos')
            ->setWidgetConfig([
                'base' => BASE,
                'id_modal' => '#lista',
            ])
            ->setData($objAnuncios->getResult());
    $widgetListaDesejos = $objWidget->getWidget('widget.lista.desejos');
else:
    $objWidget->createWidget('widget.lista.desejos')
            ->setWidgetTemplate('home/widget.empty.lista.desejos')
            ->setWidgetConfig([
                'base' => BASE,
                'id_modal' => '#lista',
    ]);
    $widgetListaDesejos = $objWidget->getWidget('widget.lista.desejos');
endif;
/*
  |-----------------------------------------------------------------------------
  | Inclue o Modal
  |-----------------------------------------------------------------------------
 */
$objWidget->createWidget('modal')
        ->setWidgetTemplate('widget/widget.modal')
        ->setWidgetConfig([
            'widget' => $widgetListaDesejos,
            'id_modal' => 'lista',
        ]);
$jSON['lista_desejos'] = $objWidget->getWidget('modal');
echo json_encode($jSON);
