<?php
namespace PM\Util\ZendeskBundle\Util;

/**
 * @author Derek Clapham <derek.clapham@photomerchant.net>
 */
class Util
{
    /**
     * Converts a PM\Util\ZendeskBundle\Model\* object to a simple string. 
     * Eg: "PM\Util\ZendeskBundle\Model\User" becomes "user"
     * 
     * @param object: $object An instance of a Model object
     * @return string: The simple string representation of the object
     */
    public static function getObjectName($object)
    {
        $className = get_class($object);
        
        return strtolower(join('', array_slice(explode('\\', $className), -1)));
    }
}
