<?php

/**
 * Description of SGWidgets
 * @author Dheo
 */
class WidgetCreate {

    public
            $tagLoop,
            $name,
            $path,
            $tpl,
            $tplLoad,
            $widgets;
    private static $instance;

    private function __construct($path) {
        $htmlDir = '/templates/';
        if (!empty($path)):
            $this->path = $path;
        else:
            $this->path = REQUIRE_PATH . $htmlDir;
        endif;

        //Se não encontrar a pasta
        if (!is_dir($this->path)):
            //Tenta carregar via ajax
            $this->path = "..{$htmlDir}";
        endif;
        $this->tagLoop = '<!--[loop]-->';
    }

    /**
     * @param type $path : caminho da pasta 
     * onde o template [.tpl.php] está armazenado
     */
    public static function getInstance($path = null) {
        if (!empty(self::$instance)):
            return self::$instance;
        else:
            return self::$instance = new WidgetCreate($path);
        endif;
    }

    /**
     * Cria o widget
     * @param type $name : String
     */
    public function createWidget($name) {
        if (!empty($this->widgets) && in_array($name, $this->widgets)):
            die("ERRO! Você já iniciou outro widget com esse nome <b>[{$this->name}]</b>");
        endif;
        $this->name = $name;
        $this->widgets[$this->name] = null;
        return $this;
    }

    /**
     * Carrega um template .tpl.php
     * @param type $tpl : caminho do arquivo .tpl.php com 
     * o template a ser carregado
     */
    public function setWidgetTemplate($tpl) {
        $this->tpl = $tpl;
        $this->tplLoad = $this->getTemplate();
        return $this;
    }

    /**
     * @param type $configs : array opcional
     * com configurações para o widget
     * @return \SGWidgets
     */
    public function setWidgetConfig($configs = ['base' => BASE, 'include_path' => INCLUDE_PATH]) {
        $this->tplLoad = $this->loadData($this->tplLoad, $configs);
        $this->widgets[$this->name] = $this->tplLoad;
        return $this;
    }

    public function setData($dataSet) {
        if (!empty($dataSet)):
            $templateDinamico = explode($this->tagLoop, $this->tplLoad);
            if (empty($templateDinamico[1])):
                die("ERRO! Seu template <b>[{$this->tpl}]</b> não contém a chave de loop : {$this->tagLoop} ");
            else:
                $this->assertData($dataSet, $templateDinamico);
            endif;
        else:
            die("ERRO no Widget <b>[{$this->name}]</b>. Seu dataSet está vazio!");
        endif;
        return $this;
    }

    /**
     * @param type $name : String => Nome do Widget
     * @return type STRING contento um HTML povoado
     */
    public function getWidget($name = null) {
        if (empty($name)):
            $name = $this->name;
        endif;
        return $this->widgets[$name];
    }

    /**
     * @param type $name : String => Nome do Widget
     * @return type echo contento um HTML povoado
     */
    public function renderWidget($name = null) {
        if (empty($name)):
            $name = $this->name;
        endif;
        echo (string) $this->widgets[$name];
    }

    /**
     * Carrega o template
     * @return type : string com o template carregado
     */
    private function getTemplate() {
        $tplLoading = file_get_contents($this->path . $this->tpl . '.tpl.php');
        if ($tplLoading):
            return (string) $tplLoading;
        else:
            die("ERRO no Widget <b>[{$this->name}]</b> : Seu template não foi carregado.");
        endif;
    }

    private function loadData($template, $dataSet) {
        $replaces = '{' . implode('}&{', array_keys($dataSet)) . '}';
        $render = str_replace(explode('&', $replaces), array_values($dataSet), $template);
        return (string) $render;
    }

    private function assertData($dataSet, $templateDinamico) {
        $a = array_sum(array_map('is_array', $dataSet));
        if ($a)://verifica se é um Array multidimensional
            $html[] = $templateDinamico[0];
            foreach ($dataSet as $key):
                $html[] = $this->loadData($templateDinamico[1], $key);
            endforeach;
            $html[] = $templateDinamico[2];
        else:
            die('ERRO no Widget  <b>[' . $this->name . ']</b>! Seu dataSet precisa ser associativo e bidimensional: $array = [ array("chave"=>"valor") ]');
        endif;
        $this->widgets[$this->name] = implode('', $html);
    }

}
