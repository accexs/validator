<?php

namespace Accexs\Rules;

/**
 * Determine if the provided input is a valid date (ISO 8601)
 * or specify a custom format.
 *
 * @param string $field
 * @param string $input date ('Y-m-d') or datetime ('Y-m-d H:i:s')
 * @param string $param Custom date format
 *
 * @return mixed
 */
class DateValidator implements \Accexs\ValidatorInterface
{
    public function validate($field, $input, $param = null)
    {
        if (!isset($input[$field]) || empty($input[$field])) {
            return;
        }

        $rule = str_replace(__NAMESPACE__.'\\', '', __CLASS__);

        // Default
        if (!$param) {
            $cdate1 = date('Y-m-d', strtotime($input[$field]));
            $cdate2 = date('Y-m-d H:i:s', strtotime($input[$field]));

            if ($cdate1 != $input[$field] && $cdate2 != $input[$field]) {
                return array(
                    'field' => $field,
                    'value' => $input[$field],
                    'rule'  => $rule,
                    'param' => $param,
                );
            }
        } else {
            $date = \DateTime::createFromFormat($param, $input[$field]);

            if ($date === false || $input[$field] != date($param, $date->getTimestamp())) {
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
