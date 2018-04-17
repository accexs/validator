<?php

require_once('vendor/autoload.php');

// use Accexs\Rules as Rules;

$validator = new Accexs\Validator;
// $req = new Rules\RequiredValidator;
// print_r(get_declared_classes());
// die;


$data = [
    'username' => '22',
    'email' => 'test',
	'creditcard' => '12345678910'];

$rules = [
    'username' => 'required|maxlen:5|minlen:3|alpha',
    'email' =>  'minlen:6|email',
    'creditcard' => 'creditcard'
    ];

var_dump($validator->validate($data, $rules));
