<?php
namespace PM\Util\ZendeskBundle\Service;
use PM\Util\ZendeskBundle\Exception\UnprocessableEntityException;
use PM\Util\ZendeskBundle\Exception\CommandException;
use PM\Util\ZendeskBundle\Exception\ObjectRetrievalException;
use PM\Util\ZendeskBundle\Exception\ObjectModificationException;
use PM\Util\ZendeskBundle\Exception\ObjectCreationException;
use PM\Util\ZendeskBundle\Util\Util;
use PM\Util\ZendeskBundle\Client\ModelMapping;
use PM\Util\ZendeskBundle\Client\Client;
use Buzz\Message\RequestInterface;

/**
 * Core Zendesk service
 * 
 * @author Derek Clapham <derek.clapham@photomerchant.net>
 */
class Zendesk
{
    protected $client;
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    
    /**
     * Saves an object to Zendesk
     * 
     * @param object $object            
     * @throws ObjectCreationException
     * @return object: An instance of the created object
     */
    public function post(&$object)
    {
        $class = get_class($object);
        $singularObject = Util::getObjectName($object);
        
        try
        {
            $object = $this->client->sendCommand(RequestInterface::METHOD_POST, "{$singularObject}s", $object);
            
            if(is_a($object, $class))
                return $object;
        }
        catch(CommandException $ce)
        {
            // Status: 422 Unprocessable Entity 
            if($ce->getCode() == 422)
                throw new UnprocessableEntityException();
            
            throw new ObjectCreationException("The '{$singularObject}' could not be created.");
        }
    }
    
    /**
     * Modifies an object in Zendesk
     * 
     * @param object $object            
     * @throws ObjectModificationException
     * @return object: An instance of the modified object
     */
    public function put(&$object)
    {
        try
        {
            $class = get_class($object);
            $singularObject = Util::getObjectName($object);
            
            $object = $this->client->sendCommand(RequestInterface::METHOD_PUT, "{$singularObject}s/{$object->getId()}", $object);
            
            return $object;
        }
        catch(CommandException $ce)
        {
            throw new ObjectModificationException("The '{$singularObject}' could not be modified. The error was: {$ce->getMessage()}");
        }
    }
    
    /**
     * Get an instance of an object from Zendesk
     * 
     * @param string $objectName
     *            The simple name of the object to be retrieved (eg: user,
     *            organization, etc)
     * @param integer $id
     *            The id of the object to be retrieved
     * @throws ObjectRetrievalException
     * @return An instance of the requested object
     */
    public function get($objectName, $id)
    {
        try
        {
            $objectName = strtolower($objectName);
            
            $object = $this->client->sendCommand(RequestInterface::METHOD_GET, "{$objectName}s/{$id}");
            
            return $object;
        }
        catch(CommandException $ce)
        {
            throw new ObjectRetrievalException("The '{$objectName}' could not be retrieved.");
        }
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
    
    public function query($queryString)
    {
        try
        {
            return $this->client->sendCommand(RequestInterface::METHOD_GET, 'search', 'query='.$queryString);
        }
        catch(Exception $e)
        {
            
        }
    }
}
