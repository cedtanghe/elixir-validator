<?php

namespace Elixir\Filter;

use Elixir\STDLib\MessagesCatalog;

/**
 * @author Cédric Tanghe <ced.tanghe@gmail.com>
 */
class CallbackValidator extends ValidatorAbstract
{
    /**
     * @var callable
     */
    protected $callback;

    /**
     * @param callable $callback
     * @param array    $options
     */
    public function __construct(callable $callback, array $options = [])
    {
        $this->callback = $callback;
        $this->setDefaultOptions($options);
    }

    /**
     * {@inheritdoc}
     */
    public function validate($value, array $options = [])
    {
        $options = $this->mergeOptions($options);
        $this->validationErrors = [];

        if (!$this->messagesCatalog) {
            $this->setMessagesCatalog(MessagesCatalog::instance());
        }

        $result = call_user_func_array($this->callback, [$value, $options]);

        if (is_array($result)) {
            $valid = $result['valid'];
            $this->validationErrors = isset($result['error']) ? (array) $result['error'] : ($valid ? [] : [$this->messagesCatalog->get(self::ERROR)]);
        } else {
            $valid = (bool) $result;
            $this->validationErrors = $valid ? [] : [$this->messagesCatalog->get(self::ERROR)];
        }

        return $valid;
    }
}
