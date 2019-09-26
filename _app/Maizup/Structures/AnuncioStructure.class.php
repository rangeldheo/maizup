<?php

/**
 * AnuncioStructure
 * @author Dheo
 */
class AnuncioStructure {

    public static
            $id,
            $titulo,
            $slug,
            $id_membro,
            $situacao,
            $categoria,
            $subcategoria,
            $valor,
            $descricao,
            $status,
            $garantia,
            $created,
            $prazo_entrega,
            $quantidade;

    public static function getId() {
        return self::$id = 'id';
    }

    public static function getTitulo() {
        return self::$titulo = 'titulo';
    }

    public static function getSlug() {
        return self::$slug = 'slug';
    }

    public static function getId_membro() {
        return self::$id_membro = 'id_membro';
    }

    public static function getSituacao() {
        return self::$situacao = 'situacao';
    }

    public static function getCategoria() {
        return self::$categoria = 'categoria';
    }

    public static function getSubcategoria() {
        return self::$subcategoria = 'subcategoria';
    }

    public static function getValor() {
        return self::$valor = 'valor';
    }

    public static function getDescricao() {
        return self::$descricao = 'descricao';
    }

    public static function getStatus() {
        return self::$status = 'status';
    }

    public static function getGarantia() {
        return self::$garantia = 'garantia';
    }

    public static function getCreated() {
        return self::$created = 'created';
    }

    public static function getPrazo_entrega() {
        return self::$prazo_entrega = 'prazo_entrega';
    }

    public static function getQuantidade() {
        return self::$quantidade = 'quantidade';
    }

}
