<?php

/**
 * User
 * @author Dheo
 * AbsModel implementa a Interface <b>Imodel</b>
 * AbsModel extend a Classe Abstrata <b>AbsRetorno</b>
 */
class User extends AbsModel {

    private $table, $repository;

    public function __construct() {
        $this->table = BDtables::getMembrosTable();
        $this->repository = new UserRepository();
    }

    public function add($request) {
        $objValidate = new UserValidate();
        if ($objValidate->validateRequest($request)):
            $this->create($request);
        else:
            $this->Erro = $objValidate->getErro();
            return false;
        endif;
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

    public function showByName($name) {
        return $this->repository->getByField(UserStructure::getNome(), $name);
    }

    public function showByUsuario($name) {
        return $this->repository->getByField(UserStructure::getUsuario(), $name);
    }

}
