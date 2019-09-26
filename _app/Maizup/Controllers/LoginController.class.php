<?php

/**
 * LoginController
 * @author Dheo
 */
class LoginController {
    private $model,
            $views;
    public function __construct() {
        $this->model = new Login();
        $this->views = null;
    }

}
