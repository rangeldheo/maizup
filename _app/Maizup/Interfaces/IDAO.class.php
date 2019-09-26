<?php

/**
 * IDAO: Interface Data Acces Objetct
 * Classe responsável por padronizar as classes DAO do sistema
 * @author Dheo
 */
interface IDAO {

    /**
     * Cria um registro na Base de Dados
     * @param Array $resquest : Dados já validados para a inserção
     */
    public function create($request);
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
