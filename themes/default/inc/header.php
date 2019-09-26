<?php

$objWidget = WidgetCreate::getInstance();
/*
  |-----------------------------------------------------------------------------
  | Widget topbar desconectado
  |-----------------------------------------------------------------------------
 */

$objWidget->createWidget('widget.topbar')
        ->setWidgetTemplate('header/widget.topbar')
        ->setWidgetConfig([
            'base' => BASE,         
        ]);
$widgetTopbar = $objWidget->getWidget('widget.topbar');
/*
  |-----------------------------------------------------------------------------
  | Widget Categorias
  |-----------------------------------------------------------------------------
 */
$objCategorias = new Categoria();
$categorias = $objCategorias->getAll();
if ($categorias):
    $objWidget->createWidget('widget.categorias')
            ->setWidgetTemplate('header/widget.categorias')
            ->setWidgetConfig([
                'base' => BASE
            ])
            ->setData($categorias);
    $widgetCategorias = $objWidget->getWidget('widget.categorias');
else:
    $widgetCategorias = 'Nenhuma Categoria encontrada';
endif;

/*
  |-----------------------------------------------------------------------------
  | APP HEADER
  |-----------------------------------------------------------------------------
 */
$objWidget->createWidget('app.header')
        ->setWidgetTemplate('header/app.header')
        ->setWidgetConfig([
            'base' => BASE,
            'logo' => INCLUDE_PATH . '/assets/images/layout/logo-header.png',
            'widget.categorias' => $widgetCategorias,
            'widget.topbar' => $widgetTopbar,
        ]);
echo $objWidget->getWidget('app.header');
