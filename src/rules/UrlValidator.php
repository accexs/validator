<?php

namespace Accexs\Rules;

/**
*
*/
class UrlValidator implements \Accexs\ValidatorInterface
{
    public function validate($field, $input, $param = null)
    {
        if (!isset($input[$field]) || empty($input[$field])) {
            return;
        }

        $url = parse_url(strtolower($input[$field]));

        if (isset($url['host'])) {
            $url = $url['host'];
        }

        $rule = str_replace(__NAMESPACE__.'\\', '', __CLASS__);

        if (function_exists('checkdnsrr')  && function_exists('idn_to_ascii')) {
            if (checkdnsrr(idn_to_ascii($url), 'A') === false) {
                return array(
                    'field' => $field,
                    'value' => $input[$field],
                    'rule'  => $rule,
                    'param' => $param,
                );
            }
        } else {
            if (gethostbyname($url) == $url) {
                return array(
                    'field' => $field,
                    'value' => $input[$field],
                    'rule'  => $rule,
                    'param' => $param,
                );
            }
        }
    }
}
