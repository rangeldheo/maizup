<?php

/**
 * StaticSingleUser
 * @author Dheo
 */
class StaticSingleUser {

    public static function getUser($userId) {
        $objUser = new User();
        return $objUser->show($userId);
    }

    public static function getUserByUsername($userName) {
        $objUser = new User();
        return $objUser->showByUsuario($userName);
    }

}
