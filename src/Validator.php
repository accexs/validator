<?php

namespace Accexs;

/**
* Validator main class
*/
class Validator
{
    protected $validationRules = array();

    protected $errors = array();

    protected $validationMethods = array();

    protected $validationMethodsErrors = array();

    protected $lang;

    public function __construct($lang = 'en')
    {
        if ($lang) {
            $langFile = __DIR__.DIRECTORY_SEPARATOR.'lang'.DIRECTORY_SEPARATOR.$lang.'.php';

            if (file_exists($langFile)) {
                $this->lang = $lang;
            } else {
                throw new \Exception('Language with key "'.$lang.'" does not exist');
            }
        }
    }

    public function validate(array $input, array $ruleSet)
    {
        $errors = array();

        foreach ($ruleSet as $field => $rules) {
            $rules = explode('|', $rules);

            $lookFor = array('required_file', 'required');

            if (count(array_intersect($lookFor, $rules)) > 0 || (isset($input[$field]))) {
                if (isset($input[$field])) {
                    if (is_array($input[$field]) && in_array('required_file', $ruleSet)) {
                        $inputArray = $input[$field];
                    } else {
                        $inputArray = array($input[$field]);
                    }
                } else {
                    $inputArray = array('');
                }

                foreach ($inputArray as $value) {
                    $input[$field] = $value;
                    foreach ($rules as $rule) {
                        $class = null;
                        $param = null;

                        if (strstr($rule, ':') !== false) {
                            $rule   = explode(':', $rule);
                            $class  = $rule[0].'Validator';
                            $param  = $rule[1];
                            $rule   = $rule[0];
                            if (preg_match('/(?:(?:^|;)_([a-z_]+))/', $param, $matches)) {
                                if (isset($input[$matches[1]])) {
                                    $param = str_replace('_'.$matches[1], $input[$matches[1]], $param);
                                }
                            }
                        } else {
                            $class = $rule.'Validator';
                        }

                        $class = ucfirst($class);

                        //instance class and validate
                        $classDir = __DIR__.DIRECTORY_SEPARATOR.'rules'.DIRECTORY_SEPARATOR. $class.'.php';
                        if (file_exists($classDir)) {
                            $class = 'Accexs\\Rules\\'.$class;
                            if (class_exists($class)) {
                                $reflectionClass = new \ReflectionClass($class);
                                $class = $reflectionClass->newInstanceArgs();
                                $result = $class->validate($field, $input, $param);
                                $errors[] = $result;
                                /*if (is_array($result)) {
                                    if (array_search($result['field'], array_column($errors, 'field')) === false) {
                                        //$errors[] = $result;
                                        var_dump('match');
                                    }
                                }*/
                            } else {
                                throw new \Exception('Error loading '. $class .' class');
                            }
                        } else {
                            throw new \Exception('Error loading '. $classDir .' file');
                        }
                    }
                }
            }
        }
        return (count($errors) > 0) ? array_filter($errors) : true;
    }
}
