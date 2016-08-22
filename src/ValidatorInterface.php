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
     *
     * @return bool
     */
    public function validate($value, array $options = []);

    /**
     * @return bool
     */
    public function hasError();

    /**
     * @return array
     */
    public function getErrors();
}
