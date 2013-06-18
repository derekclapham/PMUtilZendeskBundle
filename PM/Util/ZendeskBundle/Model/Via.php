<?php
namespace PM\Util\ZendeskBundle\Model;
use JMS\Serializer\Annotation as Serializer;

/**
 * The via object of a ticket audit or audit event tells you how or why the audit or event was created.
 * 
 * @author Derek Clapham <derek.clapham@photomerchant.net>
 */
class Via
{
    /**
     * This tells you how the ticket or event was created
     * @var string $channel
     * 
     * @Serializer\Type("string")
     */
    private $channel;
    
    /**
     * For some channels a source object gives more information 
     * about how or why the ticket or event was created
     * @var array $source
     *
     * @Serializer\Type("array")
     */
    private $source;
    
    public function __construct()
    {
        
    }
}