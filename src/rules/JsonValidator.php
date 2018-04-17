<?php

namespace Accexs\Rules;

/**
*
*/
class JsonValidator implements \Accexs\ValidatorInterface
{
    public function validate($field, $input, $param = null)
    {
        if (!isset($input[$field]) || empty($input[$field])) {
            return;
        }

        $rule = str_replace(__NAMESPACE__.'\\', '', __CLASS__);

        if (!is_string($input[$field]) || !is_object(json_decode($input[$field]))) {
            return array(
              'field' => $field,
              'value' => $input[$field],
              'rule'  => $rule,
              'param' => $param,
            );
        }
    }
}
