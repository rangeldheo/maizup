<?php

/**
 * UserRepository
 * @author Dheo
 */
class UserRepository extends AbsRepository {

    public function __construct() {
        parent::__construct(BDTables::getMembrosTable());
    }

}
