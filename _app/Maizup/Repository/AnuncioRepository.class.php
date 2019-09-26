<?php

/**
 * AnuncioRepository 
 * @author Dheo
 */
class AnuncioRepository extends AbsRepository {

    public function __construct() {
        parent::__construct(BDTables::getAnunciosTable());
    }

    public function anunciosPatrocinados($limit, $status = 1) {
        $this->read->ExeRead($this->table,
                  SQLHelper::_where()
                . SQLHelper::notNull('descricao')
                . SQLHelper::_and()
                . SQLHelper::getStatus()
                . SQLHelper::orderByRand()
                . SQLHelper::getLimit(), "limit={$limit}&status={$status}");
        return $this->defaultReturn($this->read);
    }

    public function anunciosPorCategoria($catId, $limit, $offset) {
        $this->read->ExeRead($this->table,
                SQLHelper::_where() . ' categoria = :cat ' . SQLHelper::getLimiter(),
                SQLHelper::setLimiter($limit, $offset) . "&cat={$catId}");
        return $this->defaultReturn($this->read);
    }

}
