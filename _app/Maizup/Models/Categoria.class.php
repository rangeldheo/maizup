<?php

/**
 * Categoria
 * @author Dheo
 */
class Categoria extends AbsModel {

    private $table, $repository;

    public function add($request) {
        unset($request);
    }

    public function __construct() {
        $this->table = BDTables::getCategoriaTable();
        $this->repository = new CategoriaRepository();
    }

    public function listing($limit = 10, $offset = 0) {
        return $this->repository->getList($limit, $offset);
    }

    public function show($id) {
        $idSet = (int) $id;
        return $this->repository->getById($idSet)[0];
    }

    /*
      |-------------------------------------------------------------------------
      | Metodos custom | Metodos especificos desta classe
      |-------------------------------------------------------------------------
     */

    /**
     * Retorna todas as categorias
     * @return array
     */
    public function getAll() {
        return $this->repository->getAll();
    }
    /**
     * Retorna uma categoria pelo name/slug
     * @param string $name
     * @return array
     */
    public function getByName($name){   
        return $this->repository->getByField(CategoriaStructure::getSlug(), $name)[0];
    }
    
    public function getFirstCategory(){
        return $this->repository->getFirst()[0];
    }
}
