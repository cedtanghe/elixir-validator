<?php

namespace Elixir\Validator;

/**
 * @author Cédric Tanghe <ced.tanghe@gmail.com>
 */
trait ValidatableTrait
{
    /**
     * @var string
     */
    protected $globalErrorMessage;

    /**
     * @var bool
     */
    protected $breakChainValidationOnFailure = true;

    /**
     * @var array
     */
    protected $validationErrors = [];

    /**
     * @var array
     */
    protected $validators = [];

    /**
     * {@inheritdoc}
     */
    public function setGlobalErrorMessage($value)
    {
        $this->globalErrorMessage = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getGlobalErrorMessage()
    {
        return $this->globalErrorMessage;
    }

    /**
     * {@inheritdoc}
     */
    public function setBreakChainValidationOnFailure($value)
    {
        $this->breakChainValidationOnFailure = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function isBreakChainValidationOnFailure()
    {
        return $this->breakChainValidationOnFailure;
    }

    /**
     * {@inheritdoc}
     */
    public function addValidator(ValidatorInterface $validator, array $options = [])
    {
        $this->validators[] = ['validator' => $validator, 'options' => $options];
    }

    /**
     * {@inheritdoc}
     */
    public function getValidators()
    {
        return $this->validators;
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
    public function resetValidation()
    {
        $this->validationErrors = [];
    }

    /**
     * {@inheritdoc}
     */
    public function setErrorMessages(array $messages)
    {
        $this->validationErrors = $messages;
    }

    /**
     * {@inheritdoc}
     */
    public function getErrorMessages()
    {
        return $this->globalErrorMessage && $this->hasError() ? [$this->globalErrorMessage] : $this->validationErrors;
    }
}
