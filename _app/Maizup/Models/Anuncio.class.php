<?php

/**
 * Description of Anuncio 
 * @author Dheo
 */
class Anuncio extends AbsModel {

    private $table, $repository;

    public function __construct() {
        $this->table = BDtables::getMembrosTable();
        $this->repository = new AnuncioRepository();
    }

    /**
     * Criacao de um registro
     * @param array $request : dados para serem salvos
     */
    public function add($request) {
        parent::create($request);
    }

    public function remove($id) {
        parent::destroy($id);
    }

    public function listing($limit = 10, $offset = 0) {
        return $this->repository->getList($limit, $offset);
    }

    public function show($id) {
        $idSet = (int) $id;
        return $this->repository->getById($idSet);
    }

    public function showByName($name) {
        $slug = Sanitize::string($name);
        return $this->repository->getByField('slug', $slug);
    }

    /*
      |-------------------------------------------------------------------------
      | Metodos custom | Metodos especificos desta classe
      |-------------------------------------------------------------------------
     */

    public function getAnunciosPatrocinados($limit, $status) {
        return $this->repository->anunciosPatrocinados($limit, $status);
    }

    /**
     * Retorna um array com os anuncios e os dados do membro proprietario já
     * formatados para a exibição
     * @param Integer $limit
     * @return Array : Lista de anuncios
     */
    public function getAnunciosPatrocinadosFull($limit = 4, $status = 1) {
        return AnuncioFormatter::formatAnuncios($this->getAnunciosPatrocinados($limit, $status));
    }

    public function getAnunciosByCatName($catName, $limit, $offset) {
        $objCategoria = new Categoria();
        $categoria = $objCategoria->getByName($catName);

        if ($categoria) {
            return AnuncioFormatter::formatAnuncios(
                            $this->repository->anunciosPorCategoria(
                                    $categoria[CategoriaStructure::getId()], $limit, $offset
                            )
            );
        } else {
            return null;
        }
    }

}
