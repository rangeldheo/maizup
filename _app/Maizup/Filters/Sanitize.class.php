<?php

/**
 * Sanitize
 * @author Dheo
 */
class Sanitize {

    public static function string($string) {
        $sanitized = trim(htmlspecialchars($string));
        return $sanitized;
    }

}
