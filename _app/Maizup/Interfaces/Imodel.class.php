<?php

/**
 * Imodel
 * Contrato para implementação basica de MODELS
 * @author Dheo
 */
interface Imodel extends IDAO {

    /**
     * Exibe uma lista de registros paginados
     * @param integer $limit quantidade de registros da paginacao
     * @param integer $offset inicio dos registros da paginacao 
     */
    public function listing($limit = 10, $offset = 0);

    /**
     * Insere um novo registro ao conjunto de dados na base
     * @param Array $request : Dados Validados para insercao
     */
    public function add($request);
    /**
     * Lista um registro pelo seu id
     * @param Primary_key $id
     */
    public function show($id);
}
