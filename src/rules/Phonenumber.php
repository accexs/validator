<?php

namespace Accexs\Rules;

/**
*
*/
class PhonenumberValidator implements \Accexs\ValidatorInterface
{
    public function validate($field, $input, $param = null)
    {
        if (!isset($input[$field]) || empty($input[$field])) {
            return;
        }

        $rule = str_replace(__NAMESPACE__.'\\', '', __CLASS__);

        $regex = '/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i';

        if (!preg_match($regex, $input[$field])) {
            return array(
              'field' => $field,
              'value' => $input[$field],
              'rule'  => $rule,
              'param' => $param,
            );
        }
    }
}
