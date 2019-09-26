<?php

$objWidget = WidgetCreate::getInstance();
/*
  |-----------------------------------------------------------------------------
  | Widget Banner
  |-----------------------------------------------------------------------------
 */
$widgetBanners = null;
$objBanner = new Banners();
if ($objBanner->getSlides()):
    $objWidget->createWidget('widget.banners')
            ->setWidgetTemplate('home/widget.banners')
            ->setWidgetConfig([
                'base' => BASE
            ])
            ->setData($objBanner->getResult());
    $widgetBanners = $objWidget->getWidget('widget.banners');
endif;

/*
  |-----------------------------------------------------------------------------
  | Widget Categorias populares
  |-----------------------------------------------------------------------------
 */
$configs = [
    'base' => BASE,
    'include_path' => INCLUDE_PATH,
];
$dataSetCat = [
    array('imagem' => '01', 'name' => 'ddtank-337'),
    array('imagem' => '02', 'name' => 'ddtank-mobile'),
    array('imagem' => '03', 'name' => 'league-of-legends'),
    array('imagem' => '04', 'name' => 'clash-of-clans'),
    array('imagem' => '05', 'name' => 'clash-royale'),
    array('imagem' => '06', 'name' => 'tibia'),
    array('imagem' => '07', 'name' => 'crossfire-al'),
    array('imagem' => '08', 'name' => 'dofus'),
];
$objWidget->createWidget('widget.categorias.populares')
        ->setWidgetTemplate('home/widget.categorias.populares')
        ->setWidgetConfig(
                $configs
        )
        ->setData($dataSetCat);
$widgetCategoriasPopulares = $objWidget->getWidget('widget.categorias.populares');

/*
  |-----------------------------------------------------------------------------
  | Widget avaliacoes
  |-----------------------------------------------------------------------------
 */
$widgetQualificacoes = null;
$objQualificacao = new Qualificacao();
if ($objQualificacao->getQualificacoesPositivas()):
    $objWidget->createWidget('widget.qualificacoes')
            ->setWidgetTemplate('home/widget.qualificacoes')
            ->setWidgetConfig([
                'base' => BASE,
                'include_path' => INCLUDE_PATH,
                'paginacao' => null
            ])
            ->setData($objQualificacao->getResult());
    $widgetQualificacoes = $objWidget->getWidget('widget.qualificacoes');
endif;
/*
  |-----------------------------------------------------------------------------
  | APP HOME
  |-----------------------------------------------------------------------------
 */
$objAnuncioController = new AnuncioController();
$widgetAnunciosPatrocinados = $objAnuncioController->getAnunciosPatrocinados(4, 1);

$objWidget->createWidget('app.home')
        ->setWidgetTemplate('home/app.home')
        ->setWidgetConfig([
            'base' => BASE,
            'widget.banners' => $widgetBanners,
            'widget.anuncios.patrocinados' => $widgetAnunciosPatrocinados,
            'widget.categorias.populares' => $widgetCategoriasPopulares,
            'widget.qualificacoes' => $widgetQualificacoes,
            'base' => BASE,
        ]);
echo $objWidget->getWidget();