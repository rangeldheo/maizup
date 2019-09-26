<?php

/**
 * CategoriaStructure
 * @author Dheo
 */
class CategoriaStructure {

    public static
            $id, $name, $slug, $visits, $child;

    public static function getId() {
        return self::$id = 'id';
    }

    public static function getName() {
        return self::$name = 'name';
    }

    public static function getSlug() {
        return self::$slug = 'slug';
    }

    public static function getVisits() {
        return self::$visits = 'visits';
    }

    public static function getChild() {
        return self::$child = 'child';
    }

}
