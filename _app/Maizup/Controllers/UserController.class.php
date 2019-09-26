<?php

/**
 * Description of UserController
 * @author Dheo
 */
class UserController implements IController {

    private $model, $views;

    public function __construct() {
        $this->model = new User();
        $this->views = new UserViews();
    }

    public function add($request) {
        if ($this->model->add($request)):
        //criou o registro
        else:
        //nao criou o registro
        endif;
    }

    public function allRegisters($limit = 10, $offset = 0) {
        $dataSet = $this->model->listing($limit, $offset);
        if ($dataSet):
            return $dataSet;
        else:
            return null;
        endif;
    }

    public function destroy($id) {
        if ($this->model->destroy($id)):
        //excluiu
        else:
        //nao excluiu
        endif;
    }

    public function showByName($name) {
        $singleByName = $this->model->showByName($singleByName);
        if ($singleByName):
        //retornou um resultado
        else:
        //nao retornou resultado
        endif;
    }

    public function showSingle($id) {
        $single = $this->model->show($id);
        if ($single):
        //retornou um resultado
        else:
        //nao retornou resultado
        endif;
    }

    public function update($request, $id) {
        $confirm = $this->model->update($request, $id);
        if ($confirm):
        //atualizou
        else:
        //nao atualizou
        endif;
    }

}
