<?php

namespace Elixir\Validator;

use Elixir\Validator\ValidatorInterface;

/**
 * @author Cédric Tanghe <ced.tanghe@gmail.com>
 */
interface ValidatableInterface
{
    /**
     * @param string $value
     */
    public function setGlobalErrorMessage($value);

    /**
     * @return string
     */
    public function getGlobalErrorMessage();
    
    /**
     * @param boolean $value
     */
    public function setBreakChainValidationOnFailure($value);
    
    /**
     * @return boolean
     */
    public function isBreakChainValidationOnFailure();
    
    /**
     * @param ValidatorInterface $validator
     * @param array $options
     */
    public function addValidator(ValidatorInterface $validator, array $options = []);
    
    /**
     * @return array
     */
    public function getValidators();
    
    /**
     * @return boolean
     */
    public function hasError();
    
    /**
     * @param array $messages
     */
    public function setErrorMessages(array $messages);
    
    /**
     * @return array
     */
    public function getErrorMessages();
    
    /**
     * @param mixed $data
     * @param array $options
     * @return boolean
     */
    public function validate($data = null, array $options = []);
    
    /**
     * @return void
     */
    public function resetValidation();
}
