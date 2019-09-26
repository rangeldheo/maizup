<?php

/**
 * IRepository
 * @author Dheo
 */
interface IRepository {

    public function getAll();

    public function getList($limit = 10, $offset = 0);

    public function getById($id);

    public function getByField($fieldName, $value);

    public function getLast();

    public function getFirst();

    public function getNext($actually);

    public function getPrev($actually);
}
