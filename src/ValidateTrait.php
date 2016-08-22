<?php

namespace Elixir\Validator;

use Elixir\STDLib\MessagesCatalog;

/**
 * @author Cédric Tanghe <ced.tanghe@gmail.com>
 */
trait ValidateTrait
{
    /**
     * @var MessagesCatalog
     */
    protected $messagesCatalog;

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
     * @param MessagesCatalog $value
     */
    public function setMessagesCatalog(MessagesCatalog $value)
    {
        $this->messagesCatalog = clone $value;

        foreach ($this->getDefaultCatalogMessages() as $key => $value) {
            if (!$this->messagesCatalog->has($key)) {
                $this->messagesCatalog->set($key, $value);
            }
        }
    }

    /**
     * @return MessagesCatalog
     */
    public function getMessagesCatalog()
    {
        return $this->messagesCatalog;
    }

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
        return $this->globalErrorMessage ? [$this->globalErrorMessage] : $this->validationErrors;
    }

    /**
     * @return array
     */
    abstract protected function getDefaultCatalogMessages();
}
