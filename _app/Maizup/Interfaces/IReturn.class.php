<?php

/**
 * <b>IReturn: Interface</b>
 * Padroniza o retorno dos resultados
 * Esse padrão facilita a curva de aprendizado
 * de desenvolvedores na manutenção do sistema
 * @author Dheo
 */
interface IReturn
{
    /**
     * @return type: Array. Uma lista com os erros disparados pela
     * CLASSE que implementa o metodo.
     */
    public function getErro();//:array
    /**
     * <b>getResult: Metodo adaptativo a classe evocadora</b>
     * @return type: Definido pelo metodo imediatamente anterior
     * a chamada de getResult
     * @example    : 1 - Se vc chamar um metodo que o retorno esperado é
     * TRUE ou FALSE então ::getResult() retornará TRUE ou FALSE
     * @example    : 2 - Se vc chamar um metodo que retornará um objeto ou NULL
     * então ::getResut() retornará um objeto ou null
     */
    public function getResult();//:array
    /**
     * <b>É uma extensão do metodo ::getResult()</b>
     * Tipifica o retorn esperado.
     * @param  type: $typeOfReturn = [Codificação de retorno]
     * @example    : JSON,OBJECT,ARRAY
     */
    public function getResultType($typeOfReturn);//:object || array 
    /**
     * Retorna o número de registro encontrado por ::getResul()
     * @return type: integer. 
     */
    public function getRowCount();//:int
    /**
     * <b>É uma extensão do metodo ::getErro()</b>
     * Tipifica a lista de erros retornada por ::getErro();
     * @param  type: $typeOfReturn = [Codificação de retorno]
     * @example    : JSON,OBJECT,ARRAY    
     */
    public function getErroType($typeOfReturn);//:object || array
}
