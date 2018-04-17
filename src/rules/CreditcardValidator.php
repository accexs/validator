<?php

namespace Accexs\Rules;

/**
*
*/
class CreditcardValidator implements \Accexs\ValidatorInterface
{
    public function validate($field, $input, $param = null)
    {
        if (!isset($input[$field]) || empty($input[$field])) {
            return;
        }

        $number = preg_replace('/\D/', '', $input[$field]);

        if (function_exists('mb_strlen')) {
            $number_length = mb_strlen($number);
        } else {
            $number_length = strlen($number);
        }

        $rule = str_replace(__NAMESPACE__.'\\', '', __CLASS__);

        /**
         * Bail out if $number_length is 0.
         * This can be the case if a user has entered only alphabets
         *
         */
        if ($number_length == 0) {
            return array(
                'field' => $field,
                'value' => $input[$field],
                'rule'  => $rule,
                'param' => $param,
            );
        }


        $parity = $number_length % 2;

        $total = 0;

        for ($i = 0; $i < $number_length; ++$i) {
            $digit = $number[$i];

            if ($i % 2 == $parity) {
                $digit *= 2;

                if ($digit > 9) {
                    $digit -= 9;
                }
            }

            $total += $digit;
        }

        if ($total % 10 == 0) {
            return; // Valid
        }

        return array(
            'field' => $field,
            'value' => $input[$field],
            'rule'  => $rule,
            'param' => $param,
        );
    }
}
