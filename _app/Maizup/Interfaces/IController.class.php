<?php

/**
 * Description of IController
 *
 * @author Dheo
 */
interface IController {

    /**
     * Exibe todos os registros. Paginação abordo
     * @param integer $limit quantidade de registros da paginacao
     * @param integer $offset inicio dos registros da paginacao 
     */
    public function allRegisters($limit = 10, $offset = 0);

    /**
     * Exibe um resultado pelo id do registro passado
     * @param integer $id do registro
     */
    public function showSingle($id);

    /**
     * Exibe um registro pelo name/slug passado por parametro
     * @param string $name slug identificador do registro
     */
    public function showByName($name);

    /**
     * Executa um insert na Base de Dados
     * @param Array $request : Dados validados para inserção
     */
    public function add($request);

    /**
     * Excuta um update no registro informado pelo id
     * @param array $request dados a serem atualizados
     * @param integer $id do registro a ser atualizado
     */
    public function update($request, $id);

    /**
     * Exclui permanentemente um registro.
     * @param integer $id do registro
     */
    public function destroy($id);
}
