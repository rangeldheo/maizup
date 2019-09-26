<?php

/**
 * CadastroController
 * @author Dheo
 */
class CadastroController {

    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function cadastrar($dataSet) {
        return $this->user->add($dataSet);
    }

}
