<?php

/**
 * @author Dheo
 */
class Categorias extends AbsRetorno {

    private
            $table;

    public function __construct() {
        $this->table = 'categorias';
    }

    public function getCategorias() {
        $Read = new Read();
        $Read->ExeRead($this->table);
        if ($Read->getResult()):
            $this->Result = $Read->getResult();
            return true;
        else:
            $this->Erro = 'Nenhuma categoria encontrada';
            return false;
        endif;
    }
    public function getCategoriaByName($name) {
        $Read = new Read();
        $Read->ExeRead($this->table,'WHERE slug = :slug LIMIT 1',"slug={$name}");
        if ($Read->getResult()):
            $this->Result = $Read->getResult()[0];
            return true;
        else:
            $this->Erro = 'Nenhuma categoria encontrada';
            return false;
        endif;
    }
    public function getFirstCategoria() {
        $Read = new Read();
        $Read->ExeRead($this->table,'ORDER BY id DESC LIMIT 1');
        if ($Read->getResult()):
            $this->Result = $Read->getResult()[0];
            return true;
        else:
            $this->Erro = 'Nenhuma categoria encontrada';
            return false;
        endif;
    }

}
