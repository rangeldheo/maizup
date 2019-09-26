<?php

/**
 * Description of AbsRepository
 *
 * @author Dheo
 */
abstract class AbsRepository extends AbsRetorno implements IRepository {

    protected $read, $table;

    public function __construct($table) {
        $this->read = new Read();
        $this->table = $table;
    }

    public function getAll() {
        $this->read->ExeRead($this->table);
        return $this->defaultReturn($this->read);
    }

    public function getList($limit = 10, $offset = 0) {
        $this->read->ExeRead($this->table, SQLHelper::getLimiter(), SQLHelper::setLimiter($limit, $offset));
        return $this->defaultReturn($this->read);
    }

    public function getById($id) {
        $this->read->ExeRead($this->table, SQLHelper::_where() . SQLHelper::byId(), "id={$id}");
        return $this->defaultReturn($this->read);
    }

    public function getByField($fieldName, $value) {
        $this->read->ExeRead($this->table, SQLHelper::_where() . SQLHelper::byName($fieldName), "{$fieldName}={$value}");
        return $this->defaultReturn($this->read);
    }

    public function getFirst() {
        $this->read->ExeRead($this->table, SQLHelper::getFirst());
        return $this->defaultReturn($this->read);
    }

    public function getLast() {
        $this->read->ExeRead($this->table, SQLHelper::getLast());
        return $this->defaultReturn($this->read);
    }

    public function getNext($actually) {
        unset($actually);
    }

    public function getPrev($actually) {
        unset($actually);
    }

}
