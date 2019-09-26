<?php

/**
 * IValidate
 * @author Dheo
 */
interface IValidate {

    /**
     * Verifica se a validacao passou
     */
    public function is_validate();

    /**
     * Validacao de dados
     * @param array $request
     */
    public function validateRequest($request);
}
