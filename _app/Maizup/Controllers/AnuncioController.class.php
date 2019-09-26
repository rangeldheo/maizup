<?php

/**
 * Description of AnuncioController
 * @author Dheo
 */
class AnuncioController implements IController {

    private $model,
            $view;

    public function __construct() {
        $this->model = new Anuncio();
        $this->view = new AnuncioViews();
    }

    public function add($request) {
        $this->model->add($request);
    }

    public function allRegisters($limit = 10, $offset = 0) {
        return$this->model->listing($limit, $offset);
    }

    public function destroy($id) {
        return$this->model->destroy($id);
    }

    public function showByName($name) {
        return$this->model->showByName($name);
    }

    public function showSingle($id) {
        return$this->model->show($id);
    }

    public function update($request, $id) {
        //Corrigir implementacao
        $this->model->update($request, $id);
    }

    /**
     * Retorna uma lista de anuncios de uma categoria 
     * @param type $catName
     * @param type $limit
     * @param type $offset
     * @return string
     */
    public function getAnunciosByCatName($catName, $limit, $offset) {
        $dataSet = $this->model->getAnunciosByCatName($catName, $limit, $offset);
        if ($dataSet) {
            return$this->view->index($dataSet);
        } else {
            return 'Nenhum anúncio encontrado!';
        }
    }

    /**
     * Retorna uma lista de anuncios
     * @param integer $limit
     * @param integer $status
     * @return array-multi
     */
    public function getAnunciosPatrocinados($limit, $status = 1) {
        $anunciosPatrocinados = $this->model->getAnunciosPatrocinadosFull($limit, $status);
        if ($anunciosPatrocinados):
            return $this->view->anunciosPatrocinadosViews($anunciosPatrocinados);
        else:
            return null;
        endif;
    }

}
