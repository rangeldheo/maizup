<?php

/**
 * SQLHelper
 * @author Dheo
 */
class SQLHelper {


    public static function _where() {   
            return ' WHERE ';
    }
    public static function _and() {   
            return ' AND ';
    }

    /**
     * Retorna a sintaxe de busca por todos os registros da tabela
     * @param string $table
     * @return string
     */
    public static function getFullTable($table) {
        return "SELECT * FROM {$table} ";
    }

    public static function getStatus() {
        return ' status = :status';
    }

    public static function getLimit() {
        return ' LIMIT :limit ';
    }

    public static function getOffset() {
        return ' OFFSET :offset ';
    }

    /**
     * Retorna a Sintaxe Limit e Offset
     * @return string
     */
    public static function getLimiter() {
        return self::getLimit() . self::getOffset();
    }

    /**
     * Seta o limit e Offset
     * @param integer $limit
     * @param integer $offset
     * @return String
     */
    public static function setLimiter($limit, $offset) {
        return "limit={$limit}&offset={$offset}";
    }

    /**
     * Retorna a Sintaxe by Id
     * @return string
     */
    public static function byId() {
        return  ' id = :id ';
    }

    /**
     * Retorna a sintaxe de busca pelo nome de um campo
     * @param string $fieldName
     * @return string
     */
    public static function byName($fieldName) {
        return  " {$fieldName} = :{$fieldName} ";
    }

    /**
     * Retorna a sintaxe para recuperar o primeiro registro de uma tabela
     * @return string
     */
    public static function getFirst() {
        return " ORDER BY id ASC LIMIT 1  ";
    }

    /**
     * Retorna o ultimo registro de uma tabela
     * @return string
     */
    public static function getLast() {
        return " LIMIT 1 DESC ";
    }

    /**
     * Retorna a sintaxe de resultados randomicos
     * @return string
     */
    public static function orderByRand() {
        return ' ORDER BY RAND() ';
    }

    public static function notNull($field) {
        return " {$field} IS NOT NULL or {$field} <> '' ";
    }

}
