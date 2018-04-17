<?php

namespace Accexs\Rules;

/**
*
*/
class BooleanValidator implements \Accexs\ValidatorInterface
{
    public function validate($field, $input, $param = null)
    {
        if (!isset($input[$field]) || empty($input[$field]) && $input[$field] !== 0) {
            return;
        }

        $booleans = array('1','true',true,1,'0','false',false,0,'yes','no','on','off');
        if (in_array($input[$field], $booleans, true)) {
            return;
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
