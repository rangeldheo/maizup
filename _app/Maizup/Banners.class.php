<?php

/**
 * Description of Banners
 *
 * @author Dheo
 */
class Banners extends AbsRetorno {

    private
            $table;

    public function __construct() {
        $this->table = DB_SLIDES;
    }

    public function getSlides() {
        $Read = new Read();
        $Read->ExeRead($this->table);
        if ($Read->getResult()):
            $this->Result = $Read->getResult();
            return true;
        else:
            $this->Erro = null;
            return false;
        endif;
    }

}
