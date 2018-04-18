<?php

namespace Accexs;

/**
*
*/
class Message
{
    protected $errors;

    public function __construct($errors)
    {
        $this->errors = $errors;
    }

    public function getMessages($errors, $lang)
    {

        $langFile = __DIR__.DIRECTORY_SEPARATOR.'lang'.DIRECTORY_SEPARATOR.$lang.'.php';

        $messages = require $langFile;
        foreach ($errors as $key => $error) {
            $param = $error['param'];
            $rule = strtolower($error['rule']);
            // var_dump($error);
            if (isset($messages[$rule])) {
                // var_dump($messages[$rule]);
                if (is_array($param)) {
                    $param = implode(', ', $param);
                }
                $message = str_replace('{param}', $param, $messages[$rule]);
                $message = str_replace('{field}', $error['field'], $message);
                $errors[$key]['message'] = $message;
            } else {
                throw new \Exception('Rule '. $rule. ' does not have an error message');
            }
        }

        // var_dump($errors);die;

        return $errors;
    }
}
