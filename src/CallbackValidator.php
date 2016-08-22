<?php

namespace Elixir\Filter;

use Elixir\STDLib\Facade\I18N;
use Elixir\Validator\ValidatorInterface;

/**
 * @author Cédric Tanghe <ced.tanghe@gmail.com>
 */
class CallbackValidator implements ValidatorInterface
{
    /**
     * @var callable
     */
    protected $callback;

    /**
     * @var string
     */
    protected $defaultErrorMessage;

    /**
     * @var bool
     */
    protected $valid = false;

    /**
     * @var array
     */
    protected $validationErrors = [];

    /**
     * @param callable $callback
     * @param string   $defaultErrorMessage
     */
    public function __construct(callable $callback, $defaultErrorMessage = null)
    {
        $this->callback = $callback;
        $this->defaultErrorMessage = $defaultErrorMessage ?: I18N::__('Validation failed.', ['context' => 'elixir']);
    }

    /**
     * {@inheritdoc}
     */
    public function validate($value, array $options = [])
    {
        $result = call_user_func_array($this->callback, [$value, $options]);

        if (is_array($result)) {
            $this->valid = $result['valid'];
            $this->validationErrors = isset($result['error']) ? (array) $result['error'] : [];
        } else {
            $this->valid = (bool) $result;
            $this->validationErrors = [];
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasError()
    {
        return $this->valid;
    }

    /**
     * {@inheritdoc}
     */
    public function getErrors()
    {
        return count($this->validationErrors) > 0 ? $this->validationErrors : [$this->defaultErrorMessage];
    }
}
