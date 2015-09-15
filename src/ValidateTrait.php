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
    protected $messagesCatalogue;
    
    /**
     * @var boolean
     */
    protected $validationErrorBreak = true;
    
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
        $this->messagesCatalogue = $value;
        
        foreach ($this->getDefaultCatalogMessages() as $key => $value)
        {
            if (!$this->messagesCatalogue->has($key))
            {
                $this->messagesCatalogue->set($key, $value);
            }
        }
    }
    
    /**
     * @return MessagesCatalog
     */
    public function getMessagesCatalog()
    {
        return $this->messagesCatalogue;
    }
    
    /**
     * @param boolean $value
     */
    public function setValidationErrorBreak($value)
    {
        $this->validationErrorBreak = $value;
    }
    
    /**
     * @return boolean
     */
    public function isValidationErrorBreak()
    {
        return $this->validationErrorBreak;
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
