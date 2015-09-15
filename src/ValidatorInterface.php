<?php

namespace Elixir\Validator;

/**
 * @author Cédric Tanghe <ced.tanghe@gmail.com>
 */

interface ValidatorInterface
{
    /**
     * @param mixed $value
     * @param array $options
     * @return boolean
     */
    public function validate($value, array $options = []);
    
    /**
     * @return boolean
     */
    public function hasError();
    
    /**
     * @return array
     */
    public function getErrors();
}
