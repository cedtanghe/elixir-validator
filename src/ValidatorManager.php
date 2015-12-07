<?php

namespace Elixir\Validator;

use Elixir\DI\ContainerInterface;

/**
 * @author Cédric Tanghe <ced.tanghe@gmail.com>
 */
class ValidatorManager
{
    /**
     * @var ContainerInterface
     */
    protected $container;
    
    /**
     * @var array 
     */
    protected $aliases = [];
    
    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container) 
    {
        $this->container = $container;
        
        foreach ($this->aliases as $alias => $original)
        {
            $this->container->addAlias($original, $alias);
        }
    }
    
    /**
     * @return ContainerInterface
     */
    public function getContainer()
    {
        return $this->container;
    }
    
    /**
     * @ignore
     */
    public function __call($method, $arguments)
    {
        return call_user_func([$this->container, $method], $arguments);
    }
}