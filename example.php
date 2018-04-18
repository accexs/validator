<?php

require_once('vendor/autoload.php');

$validator = new Accexs\Validator;

// validation fails
var_dump('invalid data');
$data = [
    'username' => '22',
    'email' => 'test',
    'creditcard' => '40128888888818'];

$rules = [
    'username' => 'required|max_len:5|min_len:3|alpha',
    'email' =>  'minlen:6|email',
    'creditcard' => 'creditcard'
    ];

var_dump($validator->validate($data, $rules));


// validation ok
var_dump('Valid data');
$data = [
    'username' => 'test',
    'email' => 'test@test.com',
    'creditcard' => '4012888888881881'];

$rules = [
    'username' => 'required|max_len:5|min_len:3|alpha',
    'email' =>  'minlen:6|email',
    'creditcard' => 'creditcard'
    ];

var_dump($validator->validate($data, $rules));
