<?php

/**
 * Essa classe mantém um padrao de
 * posíveis retornos de dados nas
 * classes extendidas
 *
 * @author Dheo
 */
abstract class AbsRetorno implements IReturn {

    protected
            $Result,
            $Erro;

    public function getErro() {
        return $this->Erro;
    }

    public function getResult() {
        return $this->Result;
    }

    public function getResultType($typeOfReturn) {
        return $this->type($typeOfReturn, $this->Result);
    }

    public function getRowCount() {
        if (is_array($this->Result)):
            return sizeof($this->Result);
        else:
            return '1';
        endif;
    }

    public function getErroType($typeOfReturn) {
        return $this->type($typeOfReturn, $this->Erro);
    }

    public function debug() {
        var_dump($this->getResult());
    }

    private function type($typeOfReturn, $return) {
        switch ($typeOfReturn):
            case JSON: $data = json_encode($return);
                break;
            case OBJECT: $data = (object) $return;
                break;
        endswitch;

        return $data;
    }

    /**
     * Retorna um valor padrao true/false da operacao que chama o retorno
     * É necessário passar um objeto instancia de uma das classes CRUD
     * Read | Update | Delete | Update como parametro
     * @param Object Of Crud Class $class
     * @return boolean
     */
    protected function defaultReturn($class) {
        if ($class->getResult()):
            $this->Result = $class->getResult();
            return $this->Result;
        else:
            return false;
        endif;
    }

}
