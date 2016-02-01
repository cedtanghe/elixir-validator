<?php

namespace Elixir\Validator;

use Elixir\STDLib\MessagesCatalog;
use Elixir\Validator\ValidatorInterface;

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
     * @var boolean
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
        
        foreach ($this->getDefaultCatalogMessages() as $key => $value)
        {
            if (!$this->messagesCatalog->has($key))
            {
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
     * @param boolean $value
     */
    public function setBreakChainValidationOnFailure($value)
    {
        $this->breakChainValidationOnFailure = $value;
    }
    
    /**
     * @return boolean
     */
    public function isBreakChainValidationOnFailure()
    {
        return $this->breakChainValidationOnFailure;
    }
    
    /**
     * @param ValidatorInterface $validator
     * @param array $options
     */
    public function addValidator(ValidatorInterface $validator, array $options = [])
    {
        $this->validators[] = ['validator' => $validator, 'options' => $options];
    }
    
    /**
     * @return array
     */
    public function getValidators()
    {
        return $this->validators;
    }
    
    /**
     * @return boolean
     */
    public function hasValidationError()
    {
        return count($this->validationErrors) > 0;
    }
    
    /**
     * @return array
     */
    public function getValidationErrorMessages()
    {
        return $this->validationErrors;
    }
    
    /**
     * @return array
     */
    abstract protected function getDefaultCatalogMessages();
    
    /**
     * @return boolean
     */
    abstract public function validate();
}
