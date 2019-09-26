<?php

$objWidget = WidgetCreate::getInstance();
/*
  |-----------------------------------------------------------------------------
  | App listagem de categorias | widget filtros | widget anuncios
  |-----------------------------------------------------------------------------
 */
$objCategory = new Categoria();

if (!empty($URL[1])):
    /*
      |-------------------------------------------------------------------------
      | Atraves do parametro passado na URL definimos qual categoria
      | carregaremos
      |-------------------------------------------------------------------------
     */
    $catName = htmlspecialchars($URL[1]);
    $Category = $objCategory->getByName($catName);
else:
    /*
      |-------------------------------------------------------------------------
      | Se nenhum parametro for passado  no link, carregamos a primeira
      | categoria
      |-------------------------------------------------------------------------
     */
    $Category = $objCategory->getFirstCategory();
    $catName = $objCategory->getResult()[CategoriaStructure::getName()];
endif;


/*
  |-----------------------------------------------------------------------------
  | Widget Filtros
  |-----------------------------------------------------------------------------
 */
$objFiltros = new Filtros($Category[CategoriaStructure::getId()]);
$widgetFiltros = $objFiltros->getWidgetFiltros($catName);

/*
  |-----------------------------------------------------------------------------
  | Plugin de Paginacao
  |-----------------------------------------------------------------------------
 */
$Page = (!empty($URL[2]) ? $URL[2] : 1);
$Pager = new Pager(BASE . "/categoria/{$catName}/", "<<", ">>", 6);
$Pager->ExePager($Page, 10);


$getInput = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$objAnuncioController = new AnuncioController();

//Filtro por termos
if (!empty($getInput)):

    /*$lista = implode(',', $getInput);

    $Pager->ExeFullPaginator(AnuncioSql::filteredList('anuncios', $lista), "catName={$catName}");
    $lista_anuncios = $objAnuncioController->listaFiltrada($catName, $getInput, $Pager->getLimit(), $Pager->getOffset());
*/
else:

    $Pager->ExePaginator('anuncios', 'WHERE status = 0 AND categoria = :cat', "cat={$Category[CategoriaStructure::getId()]}");
    //todos os anuncios da categoria
    $lista_anuncios = $objAnuncioController->getAnunciosByCatName($catName, $Pager->getLimit(), $Pager->getOffset());
endif;

$objWidget->createWidget('app.categorias')
        ->setWidgetTemplate('categorias/app.categoria')
        ->setWidgetConfig([
            'base' => BASE,
            'include_path' => INCLUDE_PATH,
            'category_name' => $Category[CategoriaStructure::getName()],
            'lista_anuncios' => $lista_anuncios,
            'filtros' => $widgetFiltros,
            'paginacao' => $Pager->getPaginator()
        ]);
$objWidget->renderWidget();
