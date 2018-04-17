<?php

namespace Accexs\Rules;

/**
*
*/
class IntegerValidator implements \Accexs\ValidatorInterface
{
    public function validate($field, $input, $param = null)
    {
        if (!isset($input[$field]) || empty($input[$field])) {
            return;
        }

        $rule = str_replace(__NAMESPACE__.'\\', '', __CLASS__);

        if (filter_var($input[$field], FILTER_VALIDATE_INT) === false) {
            return array(
                'field' => $field,
                'value' => $input[$field],
                'rule'  => $rule,
                'param' => $param,
            );
        }
    }
}
