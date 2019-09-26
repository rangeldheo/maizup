<?php

$request = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$objUser = new UserController();
$objUser->add($request);
