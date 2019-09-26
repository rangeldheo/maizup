<?php

/**
 * FiltrosViews
 * @author Dheo
 */
class FiltrosViews {
    /**
     * Apresenta uma UL com os filtros de um alista de anuncio ou de um anuncio
     * especificado pela Controller
     * @param array $dataSet
     * @return string HTML
     */
    public static function listOfFilterValue($dataSet) {       
        if (!empty($dataSet)):
            $objViews = new WidgetCreate();
            return $objViews->createWidget('lista')
                            ->setWidgetTemplate('anuncios/lista.filtros')
                            ->setData($dataSet)
                            ->getWidget();
        else:
            return null;
        endif;
    }

}
