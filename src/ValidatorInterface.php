<?php

namespace Accexs;

interface ValidatorInterface
{
    public function validate($field, $input, $param = null);
}
