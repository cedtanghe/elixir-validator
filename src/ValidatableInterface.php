<?php

namespace Elixir\Validator;

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
     * @param bool $value
     */
    public function setBreakChainValidationOnFailure($value);

    /**
     * @return bool
     */
    public function isBreakChainValidationOnFailure();

    /**
     * @param ValidatorInterface $validator
     * @param array              $options
     */
    public function addValidator(ValidatorInterface $validator, array $options = []);
    
    /**
     * @param array $validators
     */
    public function setValidators(array $validators);

    /**
     * @return array
     */
    public function getValidators();

    /**
     * @return bool
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
     *
     * @return bool
     */
    public function validate($data = null, array $options = []);

    public function resetValidation();
}
