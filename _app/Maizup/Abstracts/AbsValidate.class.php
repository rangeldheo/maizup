<?php

/**
 * AbsValidate
 * @author Dheo
 */
abstract class AbsValidate extends AbsRetorno implements IValidate {

    protected $is_validate, $erros;

    public function __construct() {
        $this->is_validate = true;
    }

    public function is_validate() {
        if ($this->is_validate):
            return true;
        else:
            return false;
        endif;
    }

    /**
     * Solicita que a classe filha implelemente o metodo validateRequest
     */
    public abstract function validateRequest($request);
}
