<?php

/**
 * Description of Anuncios
 * @author Dheo
 */
class Anuncios extends AbsRetorno {

    private
            $table,
            $tableImg;

    public function __construct() {
        $this->table = 'anuncios';
        $this->tableImg = 'anuncios_img';
    }

    public function getAnunciosByFilters($category, $filters, $values, $limit = 6, $offset = 0) {
        $filtros = implode(',', $filters);
        $valores = implode(',', $values);
        $Query = 'SELECT * FROM anuncios_filtros af JOIN anuncios a '
                . " WHERE af.id_anuncio = a.id AND af.value in ({$valores}) "
                . ' ORDER BY a.id DESC LIMIT :limit OFFSET :offset';
        $read = new Read();
        $read->FullRead($Query, "limit={$limit}&offset={$offset}");        
        $anuncios = $read->getResult();
                     
        foreach ($anuncios as $anuncio):
            $anuncio['cover'] = $this->readImageCover($anuncio['id']);
            $user = StaticSingleUser::getUser($anuncio['id_membro']);
            $anuncio['nome'] = $user['nome'];
            $anuncio['patente'] = $user['patente'];
            $dataSet[] = $anuncio;
        endforeach;
        $this->Result = $this->configAnuncios($dataSet);
    }

    public function getAnuncios($limit = 4, $offset = 0, $category = null) {
        if ($this->readAnuncios($limit, $offset, $category)):
            $anuncios = $this->getResult();
            foreach ($anuncios as $anuncio):
                $anuncio['cover'] = $this->readImageCover($anuncio['id']);
                $user = StaticSingleUser::getUser($anuncio['id_membro']);
                $anuncio['nome'] = $user['nome'];
                $anuncio['patente'] = $user['patente'];
                $dataSet[] = $anuncio;
            endforeach;
            $this->Result = $this->configAnuncios($dataSet);
            return true;
        else:
            return false;
        endif;
    }

    public function getListaDesejos($lista) {
        $inList = implode(',', $lista);
        $Read = new Read();
        $Read->ExeRead($this->table, "WHERE id in ($inList)");
        if ($Read->getResult()):
            $this->Result = $this->formatarDadosAnuncio($Read->getResult());
            return true;
        else:
            $this->Erro = null;
            return false;
        endif;
    }

    private function configAnuncios($dataSet) {
        foreach ($dataSet as $anuncio):
            if ($this->naListaDesejos($anuncio['id'])):
                $anuncio['action'] = 'add';
                $anuncio['img'] = 'https://img.icons8.com/material-outlined/35/ffb70b/hearts-filled.png';
            else:
                $anuncio['action'] = 'remove';
                $anuncio['img'] = 'https://img.icons8.com/material/35/2495ff/like.png';
            endif;
            $anuncio['img_medalha'] = getImgMedalha($anuncio['patente']);      
            $dataSet2[] = $anuncio;
        endforeach;
        return $dataSet2;
    }

    private function readAnuncios($limit, $offset = 0, $category = null) {
        $Read = new Read();
        if ($category):
            $Read->ExeRead($this->table, 'WHERE categoria = :cat AND status = 0 '
                    . ' ORDER BY id DESC LIMIT :limit OFFSET :offset', "limit={$limit}&offset={$offset}&cat={$category}");
        else:
            $Read->ExeRead($this->table, 'WHERE status = 0 ORDER BY id DESC LIMIT :limit', "limit={$limit}");
        endif;
        if ($Read->getResult()):
            $this->Result = $this->formatarDadosAnuncio($Read->getResult());
            return true;
        else:
            $this->Erro = null;
            return false;
        endif;
    }

    private function readImageCover($idAnuncio) {
        $Read = new Read();
        $Read->FullRead("SELECT src FROM {$this->tableImg} WHERE anuncio_id = :id LIMIT 1", "id={$idAnuncio}");
        if ($Read->getResult() && file_exists($Read->getResult()[0]['src'])):
            return $Read->getResult()[0]['src'];
        else:
            return REQUIRE_PATH . '/assets/images/layout/imagem.jpg';
        endif;
    }

    private function readImageGallery($idAnuncio) {
        $Read = new Read();
        $Read->ExeRead($this->tableImg, 'WHERE anuncio_id = :id', "id={$idAnuncio}");
        if ($Read->getResult()):
            return $Read->getResult();
        else:
            return null;
        endif;
    }

    private function naListaDesejos($id) {
        if (!empty($_SESSION[LISTA_DESEJO])):
            if (in_array($id, $_SESSION[LISTA_DESEJO])):
                return true;
            else:
                return false;
            endif;
        else:
            return false;
        endif;
    }

    private function formatarDadosAnuncio($lista) {
        $dataSet = false;
        foreach ($lista as $prod):
            $parcela = $prod['valor'] / 12;
            $prod['parcelamento'] = '12 x R$' . number_format($parcela, 2, ',', '.');
            $prod['valor'] = number_format($prod['valor'], 2, ',', '.');
            $dataSet[] = $prod;
        endforeach;
        return $dataSet;
    }

}
