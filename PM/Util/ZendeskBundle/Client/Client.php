<?php
namespace PM\Util\ZendeskBundle\Client;

use PM\Util\ZendeskBundle\Util\Util;
use PM\Util\ZendeskBundle\Exception\CommandException;
use PM\Util\ZendeskBundle\Exception\ObjectModificationException;
use PM\Util\ZendeskBundle\Exception\ObjectCreationException;
use Buzz\Message\Response;
use Buzz\Message\Request;
use Buzz\Client\Curl;
use Buzz\Message\RequestInterface;
use JMS\Serializer\Serializer;

/**
 * Zendesk Client
 * 
 * @author Derek Clapham <derek.clapham@photomerchant.net>
 */
class Client
{
    static $HEADER_ARRAY = [
        'Content-Type' => 'application/json' 
    ];
    private $serializer;
    private $apiUrl;
    private $apiKey;
    private $apiUser;
    private $resource;
    
    public function __construct(Serializer $serializer, $apiUrl, $apiKey, $apiUser)
    {
        $this->serializer = $serializer;
        $this->apiUrl = $apiUrl;
        $this->apiKey = $apiKey;
        $this->apiUser = $apiUser;
        
        $this->resource = null;
    }
    
    /**
     * Serializes a payload depending on what form the payload takes.
     * 
     * @param mixed: $payload
     *            Can be either an associative array or a Model object
     * @return string: A JSON encoded string representing the array or object
     */
    private function _serializePayload($payload)
    {
        if(is_object($payload))
            return "{\"" . Util::getObjectName($payload) . "\": {$this->serializer->serialize($payload, 'json')}}";
        elseif(is_array($payload))
            return json_encode($payload);
    }
    
    /**
     * Unserializes a JSON string returned from the Zendesk API
     * 
     * @param string: $rawContent
     *            The JSON string from Zendesk
     * @param mixed: $payload
     *            Either an array or object that was sent as the payload
     */
    private function _unSerializePayload($rawContent)
    {
        $rawContentArr = json_decode($rawContent, true);
        
        if(! is_array($rawContentArr))
            $rawContentArr = json_decode($rawContent);
        
        $depth = max(array_map('count', $rawContentArr));
        
        /*
         * If > 1 it's probably an object so we attempt to determine what type
         * of object it is
         */
        if($depth > 1)
        {
            // Use the array key of the first array object to 'guess' what
            // type of object we are deserializing
            $className = array_keys($rawContentArr)[0];
            
            $dataToDeserialize = json_encode($rawContentArr[$className]);
            
            return $this->serializer->deserialize($dataToDeserialize, 'PM\Util\ZendeskBundle\Model\\' . ucfirst($className), 'json');
        }
        
        return $rawContentArr;
    }
    
    /**
     * Builds a Buzz\Curl object to be used in performing an API request
     * 
     * @param string: $endpoint
     *            A string representing the API endpoint to call
     * @return Buzz\Client\Curl $client: An instance of a Buzz Curl object
     */
    private function build($endpoint, $payload = null)
    {
        $this->resource = '/api/v2/' . $endpoint . '.json';
        
        if(is_string($payload))
            $this->resource .= '?'.$payload;
        
        $response = new Response();
        $request = new Request(null, $this->resource, 'https://'.$this->apiUrl);
        $request->addHeader("Content-Type: application/json");

        $client = new Curl();
        $client->setMaxRedirects(10);
        $client->setTimeout(10);
        $client->setOption(CURLOPT_USERPWD, $this->apiUser.':'.$this->apiKey);
        $client->setOption(CURLOPT_RETURNTRANSFER, true);
        
        return [$client, $request, $response];
    }
    
    /**
     * Sends the command to the Zendesk API
     * 
     * @param integer: $requestType
     *            (Can be any of the METHOD_ constants in the
     *            Buzz\Message\RequestInterface class
     * @param string: $endpoint
     *            A string representing the API endpoint to call
     * @param mixed: $payload
     *            Either an array or object that was sent as the payload
     */
    public function sendCommand($requestType, $endpoint, $payload = null)
    {
        list($client, $request, $response) = $this->build($endpoint, $payload);
        
        switch($requestType)
        {
            case RequestInterface::METHOD_POST :
                $request->setMethod(RequestInterface::METHOD_POST);
                $client->setOption(CURLOPT_POSTFIELDS, $this->_serializePayload($payload));
                $client->send($request, $response);
                break;
            
            case RequestInterface::METHOD_PUT :
                $request->setMethod(RequestInterface::METHOD_PUT);
                $client->setOption(CURLOPT_POSTFIELDS, $this->_serializePayload($payload));
                $client->send($request, $response);
                break;
            
            case RequestInterface::METHOD_GET :
                $request->setMethod(RequestInterface::METHOD_GET);
                $client->send($request, $response);
                break;
            
            default :
                break;
        }
        
        if($response->isSuccessful())
        {
            $content = $response->getContent();
            
            if(strlen(trim($content)) > 0)
            {
                $result = $this->_unSerializePayload($response->getContent());
                
                return $result;
            }
            else
                return true;
        }
        else
        {
            $result = $this->_unSerializePayload($response->getContent());
            
            if(array_key_exists('error', $result))
            {
                if(array_key_exists('description', $result))
                    throw new CommandException($result['description'], $response->getStatusCode());
                
                throw new CommandException($result['error'], $response->getStatusCode());
            }
        }
        
        throw new CommandException("There was an error while sending the command");
    }
}
