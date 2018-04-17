<?php

namespace Accexs\Rules;

/**
*
*/
class NumericValidator implements \Accexs\ValidatorInterface
{
    public function validate($field, $input, $param = null)
    {
        if (!isset($input[$field]) || empty($input[$field])) {
            return;
        }

        $rule = str_replace(__NAMESPACE__.'\\', '', __CLASS__);

        if (!is_numeric($input[$field])) {
            return array(
                'field' => $field,
                'value' => $input[$field],
                'rule'  => $rule,
                'param' => $param,
            );
        }
    }
}
