<?php

/**
 * AnuncioViews
 * @author Dheo
 */
class AnuncioViews extends AbstractViews {

    /**
     * Exibe os resultados dos anuncios passados no array
     * @param array $dataSet
     */
    public function index($dataSet) {
        return $this->widgetClass->createWidget('index')
                        ->setWidgetTemplate('anuncios/index')
                        ->setWidgetConfig([
                            'base' => BASE,
                            'include_path' => INCLUDE_PATH,
                        ])
                        ->setData(AnuncioFormatter::formatAnuncios($dataSet))
                        ->getWidget();
    }

    /**
     * Exibe os anuncios patrocinados
     * @param type $anunciosPatrocinados
     * @param type $tpl
     * @return type
     */
    public function anunciosPatrocinadosViews($anunciosPatrocinados, $tpl = 'home/widget.anuncios.patrocinados') {
        return $this->widgetClass->createWidget('widget.patrocinados')
                        ->setWidgetTemplate($tpl)
                        ->setWidgetConfig()
                        ->setData($anunciosPatrocinados)
                        ->getWidget();
    }

    public function get404() {
        return '404';
    }

}
