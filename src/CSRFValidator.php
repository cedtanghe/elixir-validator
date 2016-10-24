<?php

namespace Elixir\Filter;

use Elixir\Security\CSRF as CSRFContext;
use Elixir\STDLib\Facade\I18N;
use Elixir\STDLib\MessagesCatalog;

/**
 * @author Cédric Tanghe <ced.tanghe@gmail.com>
 */
class CSRFValidator extends ValidatorAbstract
{
    /**
     * @var CSRFContext 
     */
    protected $CSRF;
    
    /**
     * {@inheritdoc}
     */
    public function getDefaultCatalogMessages()
    {
        return [
            self::ERROR => I18N::__('Possibility of attack CSRF flaw.', ['context' => 'elixir']),
        ];
    }

    /**
     * @param CSRFContext $CSRF
     * @param array $options
     */
    public function __construct(CSRFContext $CSRF, array $options = [])
    {
        $this->CSRF = $CSRF;
        $this->setDefaultOptions($options);
    }
    
    /**
     * @return Context
     */
    public function createToken($name, array $config = [])
    {
        return $this->CSRF->create($name, $config);
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
        
        if (!$this->CSRF->isValid($value, $options))
        {
            $this->validationErrors[] = $this->messagesCatalog->get(self::ERROR);
        }
    }
}
