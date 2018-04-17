<?php

namespace Accexs\Rules;

/**
*
*/
class MaxlenValidator implements \Accexs\ValidatorInterface
{
    public function validate($field, $input, $param = null)
    {
        if (!isset($input[$field])) {
            return;
        }

        if (function_exists('mb_strlen')) {
            if (mb_strlen($input[$field]) <= (int) $param) {
                return;
            }
        } else {
            if (strlen($input[$field]) <= (int) $param) {
                return;
            }
        }

        $rule = str_replace(__NAMESPACE__.'\\', '', __CLASS__);

        return array(
            'field' => $field,
            'value' => $input[$field],
            'rule'  => $rule,
            'param' => $param,
        );
    }
}
