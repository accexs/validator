<?php

namespace Accexs\Rules;

/**
*
*/
class RequiredValidator implements \Accexs\ValidatorInterface
{
    
    public function validate($field, $input, $param = null)
    {
        if (isset($input[$field]) && ($input[$field] === false || $input[$field] === 0 ||
         $input[$field] === 0.0 || $input[$field] === '0' || !empty($input[$field]))) {
            return;
        }

        $rule = str_replace(__NAMESPACE__.'\\', '', __CLASS__);

        return array(
            'field' => $field,
            'value' => null,
            'rule'  => $rule,
            'param' => $param,
        );
    }
}
