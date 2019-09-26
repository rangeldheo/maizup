<?php

/**
 * CategoriaRepository
 * @author Dheo
 */
class CategoriaRepository extends AbsRepository {
    public function __construct() {
        parent::__construct(BDTables::getCategoriaTable());
    }
}
