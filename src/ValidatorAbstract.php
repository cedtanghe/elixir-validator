<?php

namespace Elixir\Filter;

use Elixir\STDLib\Facade\I18N;
use Elixir\STDLib\MessagesCatalogAwareTrait;
use Elixir\Validator\ValidatorInterface;

/**
 * @author Cédric Tanghe <ced.tanghe@gmail.com>
 */
abstract class ValidatorAbstract implements ValidatorInterface
{
    use MessagesCatalogAwareTrait;

    /**
     * @param string
     */
    const ERROR = 'error';

    /**
     * @var array
     */
    protected $validationErrors = [];
    
    /**
     * @var array
     */
    protected $options = [];

    /**
     * {@inheritdoc}
     */
    public function getDefaultCatalogMessages()
    {
        return [
            self::ERROR => I18N::__('Validation failed.', ['context' => 'elixir']),
        ];
    }
    
    /**
     * @param array $values
     */
    public function setDefaultOptions(array $values)
    {
        $this->options = $values;
    }
    
    /**
     * @return array
     */
    public function getDefaultOptions()
    {
        return $this->options;
    }
    
    /**
     * @param array $options
     * @return array
     */
    protected function mergeOptions(array $options)
    {
        return array_merge($this->options, $options);
    }
    
    /**
     * {@inheritdoc}
     */
    public function hasError()
    {
        return count($this->validationErrors) > 0;
    }

    /**
     * {@inheritdoc}
     */
    public function getErrors()
    {
        return $this->hasError() ? $this->validationErrors : [];
    }
}
