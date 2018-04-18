<?php

require_once('vendor/autoload.php');

$validator = new Accexs\Validator;

$rules = array(
    'missing'               => 'required',
    'email'                 => 'email',
    'max_len'               => 'max_len:1',
    'min_len'               => 'min_len:4',
    //'exact_len'             => 'exact_len:10',
    'alpha'                 => 'alpha',
    'alpha_numeric'         => 'alpha_num',
    'alpha_dash'            => 'alpha_dash',
    'alpha_numeric_space'   => 'alpha_num_space',
    'alpha_space'           => 'alpha_space',
    'numeric'               => 'numeric',
    'integer'               => 'integer',
    'boolean'               => 'boolean',
    'float'                 => 'float',
    'valid_url'             => 'url',
    //'url_exists'            => 'url_exists',
    'valid_ip'              => 'ip',
    'valid_ipv4'            => 'ipv4',
    'valid_ipv6'            => 'ipv6',
    //'contains'              => 'contains,free pro basic',
    //'array_size_equal'      => 'valid_array_size_equal,2',
    //'array_size_greater'    => 'valid_array_size_greater,2',
    //'array_size_lesser'     => 'valid_array_size_lesser,2'
);

$invalidData = array(
    'missing'               => '',
    'email'                 => "not a valid email\r\n",
    'max_len'               => "1234567890",
    'min_len'               => "1",
    //'exact_len'             => "123456",
    'alpha'                 => "*(^*^*&",
    'alpha_numeric'         => "abcdefg12345+\r\n\r\n\r\n",
    'alpha_dash'            => "ab<script>alert(1);</script>cdefg12345-_+",
    'alpha_numeric_space'   => 'abcdefg12345_$^%%&TGY',
    'alpha_space'           => 'abcdefg12345 ',
    'numeric'               => "one, two\r\n",
    'integer'               => "1,003\r\n\r\n\r\n\r\n",
    'boolean'               => "this is not a boolean\r\n\r\n\r\n\r\n",
    'float'                 => "not a float\r\n",
    'url'                   => "\r\n\r\nhttp://add",
    'valid_ip'              => "google.com",
    'valid_ipv4'            => "google.com",
    'valid_ipv6'            => "google.com",
    //'contains'              => 'premium',
    //'array_size_equal'      => array("1"),
    //'array_size_greater'    => array("1"),
    //'array_size_lesser'     => array("1","2","3")
);

$validData = array(
    'missing'               => 'This is not missing',
    'email'                 => 'sean@wixel.net',
    'max_len'               => '1',
    'min_len'               => '1234',
    //'exact_len'             => '1234567890',
    'alpha'                 => 'ÈÉÊËÌÍÎÏÒÓÔasdasdasd',
    'alpha_numeric'         => 'abcdefg12345',
    'alpha_dash'            => 'abcdefg-_',
    'alpha_numeric_space'   => 'abcdefg12345 ',
    'alpha_space'           => 'abcdefg ',
    'numeric'               => 2.00,
    'integer'               => 3,
    'boolean'               => false,
    'float'                 => 10.10,
    'valid_url'             => 'https://wixelhq.com',
    'url_exists'            => 'https://wixelhq.com',
    'valid_ip'              => '69.163.138.23',
    'valid_ipv4'            => "255.255.255.255",
    'valid_ipv6'            => "2001:0db8:85a3:08d3:1319:8a2e:0370:7334",
    //'contains'              => 'free',
    //'array_size_equal'      => array("1","2"),
    //'array_size_greater'    => array("1","2","3"),
    //'array_size_lesser'     => array("1")
);

echo "\nVALIDATION OK\n\n";
$ok = $validator->validate($validData, $rules);
var_dump($ok);

echo "\nVALIDATION ERRORS\n\n";
$fail = $validator->validate($invalidData, $rules);
var_dump($fail);
