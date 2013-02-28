<?php
namespace PM\Util\ZendeskBundle\Client;

use PM\Util\ZendeskBundle\Util\Util;
use PM\Util\ZendeskBundle\Exception\CommandException;
use PM\Util\ZendeskBundle\Exception\ObjectModificationException;
use PM\Util\ZendeskBundle\Exception\ObjectCreationException;
use Buzz\Message\RequestInterface;
use Buzz\Listener\BasicAuthListener;
use Buzz\Browser;
use Buzz\Client\FileGetContents;
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
    private $url;
    public function __construct(Serializer $serializer, $apiUrl, $apiKey, $apiUser)
    {
        $this->serializer = $serializer;
        $this->apiUrl = $apiUrl;
        $this->apiKey = $apiKey;
        $this->apiUser = $apiUser;
        
        $this->url = null;
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
     * Builds a Buzz\Browser object to be used in performing an API request
     * 
     * @param string: $endpoint
     *            A string representing the API endpoint to call
     * @return Buzz\Browser $browser: An instance of a Buzz Browser object
     */
    private function build($endpoint)
    {
        $this->url = 'https://' . $this->apiUrl . '/api/v2/' . $endpoint . '.json';
        
        $client = new FileGetContents();
        $browser = new Browser($client);
        $browser->addListener(new BasicAuthListener($this->apiUser, $this->apiKey));
        
        return $browser;
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
        $browser = $this->build($endpoint);
        
        switch($requestType)
        {
            case RequestInterface::METHOD_POST :
                $response = $browser->post($this->url, self::$HEADER_ARRAY, $this->_serializePayload($payload));
                break;
            
            case RequestInterface::METHOD_PUT :
                $response = $browser->put($this->url, self::$HEADER_ARRAY, $this->_serializePayload($payload));
                break;
            
            case RequestInterface::METHOD_GET :
                $response = $browser->get($this->url, self::$HEADER_ARRAY);
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
        
        throw new CommandException("There was an error while sending the command");
    }
}
