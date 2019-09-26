<?php

/**
 * AnuncioSql
 * @author Dheo
 */
class AnuncioSql {

    /**
     * Sql para retornar todos os anuncios de uma categoria informada
     * e com paginacao
     * @return string
     */
    public static function all($table) {
        return "SELECT a.id as 'idAnuncio', a.*,m.* "
                . " FROM {$table} a JOIN membros m JOIN categorias c WHERE "
                . " a.id_membro = m.id AND "
                . " a.categoria = c.id AND c.slug = :catName "
                . " ORDER BY a.id DESC ";
    }

    public static function filteredList($table,$lista) {
        return "SELECT a.id as 'idAnuncio', a.*,m.* "
                . " FROM {$table} a JOIN membros m JOIN categorias c "
                . " JOIN anuncios_filtros af "
                . " WHERE a.id_membro = m.id AND "
                . " a.categoria = c.id "
                . " AND a.id = af.id_anuncio "
                . " AND c.slug = :catName "
                . " AND value in('{$lista}') "
                . " ORDER BY a.id DESC ";
    }

    /**
     * Sql: retornar uma anuncio pelo name/slug
     * @return string
     */
    public static function byName($table) {
        return "SELECT * FROM {$table} WHERE name = :name";
    }

    /**
     * Sql: retorna um anuncio pelo id
     * @return string
     */
    public static function byId($table) {
        return "SELECT * FROM {$table} WHERE id = :id";
    }

    public static function Limiter() {
        return SQLHelper::getLimiter();
    }

}
