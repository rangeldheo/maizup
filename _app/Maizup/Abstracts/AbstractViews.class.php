<?php

/**
 * AbstractViews
 * @author Dheo
 */
abstract class AbstractViews {

    protected $widgetClass;

    /**
     * Cria sempre a instancia unica do WidgetCreate
     */
    public function __construct() {
        $this->widgetClass = WidgetCreate::getInstance();
    }

}
