<?php

$objWidget = WidgetCreate::getInstance();
$objWidget->createWidget('footer')
        ->setWidgetTemplate('footer/footer')
        ->setWidgetConfig([
            'base' => BASE
        ]);
$objWidget->renderWidget();
