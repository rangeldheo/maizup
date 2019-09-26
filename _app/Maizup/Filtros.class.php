<?php

/**
 * @author Dheo
 */
class Filtros extends AbsRetorno {

    private
            $read,
            $categoria,
            $filtros;

    /**
     * Retorna os filtros da categoria 
     * @param primary_key $categoria : Chave primaria da categoria
     */
    public function __construct($categoria) {
        $this->read = new Read();
        $this->categoria = (int) $categoria;
        $this->exeFiltros();
    }

    public function getFiltros() {
        $this->filtros = null;
        $aux = null;
        if (!empty($this->getResult())):
            foreach ($this->getResult() as $filtro) {
                unset($aux);
                $servs = json_decode($filtro['value']);
                $aux['id_filtro'] = $filtro['id_filtro'];
                $aux['id'] = $filtro['id'];
                $aux['name'] = $filtro['title'];
                $i = 0;
                foreach ($servs->title as $value):
                    $aux['data'][] = [
                        'text' => "{$servs->title[$i]}",
                        'val' => "{$servs->value[$i]}",
                    ];
                    $i++;
                endforeach;
                $this->filtros[] = $aux;
            }
            return $this->filtros;
        else:
            return null;
        endif;
    }

    public function getWidgetFiltros($categoryName = null, $template = 'widget/cbx.filtros') {
        $dataSet = $this->getFiltros();
        if (!empty($dataSet)):
            $objWidget = WidgetCreate::getInstance();
            $html = null;
            foreach ($dataSet as $filtro):
                $objWidget->createWidget($filtro['name'])
                        ->setWidgetTemplate($template)
                        ->setWidgetConfig([
                            'id' => $filtro['id'], //id itens_filtro
                            'id_filtro' => $filtro['id_filtro'], //id do filtro
                            'label' => $filtro['name'],
                        ])
                        ->setData($filtro['data']);
                $html[] = $objWidget->getWidget();
            endforeach;

            $filtros = implode('', $html);

            $objWidget->createWidget('filtros')
                    ->setWidgetTemplate('filtros')
                    ->setWidgetConfig([
                        'include_path' => INCLUDE_PATH,
                        'cbx.filtros' => $filtros,
                        'end.point' => BASE . "/categoria/{$categoryName}"
            ]);
            return $objWidget->getWidget();
        else:
            return 'Nenhum filtro encontrado para essa categoria';
        endif;
    }

    private function exeFiltros() {
        $Query = 'SELECT f.id, fi.* FROM filtros f JOIN filtros_itens fi '
                . 'WHERE fi.id_filtro = f.id AND f.cat = :cat';
        $this->read->FullRead($Query, "cat={$this->categoria}");
        
        if ($this->read->getResult()):
            $this->Result = $this->read->getResult();
        else:
            $this->Result = null;
        endif;
    }

}
