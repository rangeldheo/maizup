<?php

/**
 * CreateStructure
 * @author Dheo
 */
class CreateStructure {

    private $className, $table, $fields;

    public function __construct($name, $table) {
        $this->className = $name;
        $this->table = $table;
        $this->getAttributes($table);
    }

    public function getClass() {
        return $this->createClass();
    }

    private function createClass() {
        return "class {$this->className} { {$this->createFields()} {$this->createMethods()} }";
    }

    private function getAttributes($table) {
        $read = new Read();
        $read->FullRead("SHOW COLUMNS FROM {$table}");
        if ($read->getResult()) {
            foreach ($read->getResult() as $attr) {
                $this->fields[] = $attr['Field'];
            }
        }
    }

    private function createFields() {
        if (!empty($this->fields)) {
            return 'public static ';
            foreach ($this->fields as $attr) {
                return $attr . ',';
            }
        }
    }

    private function createMethods() {
        if (!empty($this->fields)):
            foreach ($this->fields as $value) {
                $metName = ucfirst($value);
                return "public static function get{$metName} { return self::{$value} = '{$value}'}"."<br />";
            }
        endif;
    }

}
