<?php

$objCategory = new Categoria();
$objWidget = WidgetCreate::getInstance();
$objWidget->createWidget('app.lista.de.categorias')
        ->setWidgetTemplate('categorias/app.categorias')
        ->setWidgetConfig([
            'base' => BASE
        ])
        ->setData($objCategory->getAll());
$objWidget->renderWidget();
