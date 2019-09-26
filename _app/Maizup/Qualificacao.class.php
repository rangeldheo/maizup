<?php

/**
 * Description of Qualificacao
 * @author Dheo
 */
class Qualificacao extends AbsRetorno {

    private
            $table;

    public function __construct() {
        $this->table = 'qualificacoes';
    }

    public function getQualificacoesPositivas($limit = 6,$offset = 0) {
        return $this->getQualificacoes('positivo',$limit,$offset);
    }
    public function getQualificacoesNegativas($limit = 6,$offset = 0) {
        return $this->getQualificacoes('negativo',$limit,$offset);
    }
    public function getQualificacoesNeutras($limit = 6,$offset = 0) {
        return $this->getQualificacoes('neutro',$limit,$offset);
    }

    private function getQualificacoes($tipo, $limit = 6,$offset = 0) {
        $Read = new Read();
        $Read->FullRead(
                'SELECT '
                . ' a.titulo ,m.nome, q.*, q.*, date_format(q.created,"%d/%m/%Y %H:%i:%s") as data_pt'
                . ' FROM qualificacoes q JOIN '
                . ' membros m  JOIN anuncios a WHERE q.id_membro = m.id AND '
                . ' q.anuncio_id = a.id AND qualificacao_tipo = :tipo LIMIT :limit OFFSET :offset',
                "tipo={$tipo}&limit={$limit}&offset={$offset}"
                );
        if ($Read->getResult()):
            $this->Result = $Read->getResult();
            return true;
        else:
            return false;
        endif;
    }

}
