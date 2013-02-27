<?php
namespace PM\Util\ZendeskBundle\Service;
use PM\Util\ZendeskBundle\Util\Util;
use PM\Util\ZendeskBundle\Exception\ObjectCreationException;
use PM\Util\ZendeskBundle\Client\ModelMapping;
use PM\Util\ZendeskBundle\Client\Client;
use Buzz\Message\RequestInterface;

/**
 * Core Zendesk service
 *
 * @author Derek Clapham <derek.clapham@photomerchant.net>
 */
class Core
{
    protected $client;
    
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    
    public function post(&$object)
    {
        $class = get_class($object);
        $singularObject = Util::getObjectName($object);
        
        try
        {
            $result = $this->client->sendCommand(RequestInterface::METHOD_POST, "{$singularObject}s", $object);
        
            if(is_a($result, $class))
            {
                $object = $result;
                return true;
            }
        }
        catch(CommandException $ce)
        {
            throw new ObjectCreationException("The '{$singularObject}' could not be created.");
        }
    }
    
    public function put(&$object)
    {
        $class = get_class($object);
        $singularObject = Util::getObjectName($object);
        
        $this->client->sendCommand(RequestInterface::METHOD_PUT, "{$singularObject}s/{$object->getId()}", $object);
    }
    
    public function get($id, &$object)
    {
        $class = get_class($object);
        $singularObject = Util::getObjectName($object);
        
        $this->client->sendCommand(RequestInterface::METHOD_GET, "{$singularObject}s/{$object->getId()}");
    }
    
    public function set(&$object, $parameters = null)
    {
        foreach($parameters as $key => $value)
        {
            $endpoint = $key;
            $payload = $value;
            break;
        }
        
        $this->client->sendCommand(RequestInterface::METHOD_POST, "users/{$object->getId()}/{$endpoint}", $payload);
    }
}
