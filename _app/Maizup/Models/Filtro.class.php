<?php
/**
 * Description of Filtro
 *
 * @author Dheo
 */
class Filtro {
    
    /**
     * Retorna um array com os dados dos filtros do anuncio
     * @param integer $id do anuncio
     * @return array
     */
    public static function getFiltrosAnuncioById($id) {
        $filtros = self::getFiltros($id);
        $filtrosItensJson = self::getFiltrosItens($id);
        $dataSet = null;
        $filtroAnuncio = null;
        foreach ($filtros as $filtro):
            $i = 0;
            foreach ($filtrosItensJson as $filtroItemJson):
                if ($filtroItemJson['id'] === $filtro['id_filtro']):
                    $filtroItem = (array) json_decode($filtroItemJson['value']);
                    $indice = array_search($filtro['value'], $filtroItem['value']);
                    if ($indice):
                        $filtroAnuncio[$i]['title'] = $filtroItemJson['title'];
                        $filtroAnuncio[$i]['value'] = $filtroItem['title'][$indice];
                    endif;
                endif;
                $i++;
            endforeach;
        endforeach;
        return $filtroAnuncio;
    }

    /*
     * Seleciona os ids dos filtros associados a um anuncio
     * na tablea FILTROS_ITENS
     */
    public static function getFiltrosItens($id) {
        $read = new Read();
        $read->FullRead('SELECT fi.id, fi.value,fi.title FROM anuncios_filtros af JOIN '
                . ' filtros_itens fi WHERE fi.id = af.id_filtro '
                . ' AND id_anuncio = :id', "id={$id}");
        if ($read->getResult()):
            return $read->getResult();
        else:
            return null;
        endif;
    }
    /**
     * 
     * @param type $id
     * @return type
     */
    public static function getFiltros($id) {
        $read = new Read();
        $read->FullRead('SELECT id_filtro,value FROM anuncios_filtros WHERE id_anuncio = :id', "id={$id}");
        if ($read->getResult()):
            return $read->getResult();
        else:
            return null;
        endif;
    }

}
