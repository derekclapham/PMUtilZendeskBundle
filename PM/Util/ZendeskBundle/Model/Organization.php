<?php
namespace PM\Util\ZendeskBundle\Model;
use JMS\Serializer\Annotation as Serializer;

/**
 * Represents a Zendesk organization
 * 
 * @author Derek Clapham <derek.clapham@photomerchant.net>
 */
class Organization
{
    /**
     * @Serializer\Type("string")
     * 
     * Automatically assigned when created
     * @var integer $id
     */
    private $id;
    
    /**
     * @Serializer\SerializedName("external_id")
     * @Serializer\Type("string")
     * 
     * A unique external id, you can use this to associate organizations to an external record
     * @var string 
     */
    private $externalId;
    
    /**
     * @Serializer\Type("string")
     * 
     * The name of the organization
     * @var string
     */
    private $name;
    
    /**
     * @Serializer\SerializedName("created_at")
     * @Serializer\Type("DateTime")
     * 
     * The time the organization was created
     * @var \DateTime
     */
    private $createdAt;
    
    /**
     * @Serializer\SerializedName("updated_at")
     * @Serializer\Type("DateTime")
     * 
     * The time of the last update of the organization
     * @var \DateTime
     */
    private $updatedAt;
    
    /**
     * @Serializer\SerializedName("domain_names")
     * @Serializer\Type("array")
     * 
     * An array of domain names associated with this organization
     * @var array
     */
    private $domainNames;
    
    /**
     * @Serializer\Type("string")
     * 
     * In this field you can store any details obout the organization. e.g. the address
     * @var string
     */
    private $details;
    
    /**
     * @Serializer\Type("string")
     * 
     * In this field you can store any notes you have about the organization
     * @var string
     */
    private $notes;
    
    /**
     * @Serializer\SerializedName("group_id")
     * @Serializer\Type("integer")
     * 
     * New tickets from users in this organization will automatically be put in this group
     * @var integer
     */
    private $groupId;
    
    /**
     * @Serializer\SerializedName("shared_tickets")
     * @Serializer\Type("boolean")
     * 
     * End users in this organization are able to see eachother's tickets
     * @var boolean
     */
    private $sharedTickets;
    
    /**
     * @Serializer\SerializedName("shared_comments")
     * @Serializer\Type("boolean")
     * 
     * End users in this organization are able to see eachother's comments on tickets
     * @var boolean
     */
    private $sharedComments;
    
    /**
     * @Serializer\Type("array")
     * 
     * The tags of the organization
     * @var array
     */
    private $tags;    

    public function __construct()
    {
        
    }
    
	/**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

	/**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

	/**
     * @return the $externalId
     */
    public function getExternalId()
    {
        return $this->externalId;
    }

	/**
     * @param string $externalId
     */
    public function setExternalId($externalId)
    {
        $this->externalId = $externalId;
    }

	/**
     * @return the $name
     */
    public function getName()
    {
        return $this->name;
    }

	/**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

	/**
     * @return the $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

	/**
     * @param DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

	/**
     * @return the $updatedAt
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

	/**
     * @param DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

	/**
     * @return the $domainNames
     */
    public function getDomainNames()
    {
        return $this->domainNames;
    }

	/**
     * @param multitype: $domainNames
     */
    public function setDomainNames($domainNames)
    {
        $this->domainNames = $domainNames;
    }

	/**
     * @return the $details
     */
    public function getDetails()
    {
        return $this->details;
    }

	/**
     * @param string $details
     */
    public function setDetails($details)
    {
        $this->details = $details;
    }

	/**
     * @return the $notes
     */
    public function getNotes()
    {
        return $this->notes;
    }

	/**
     * @param string $notes
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

	/**
     * @return the $groupId
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

	/**
     * @param number $groupId
     */
    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;
    }

	/**
     * @return the $sharedTickets
     */
    public function getSharedTickets()
    {
        return $this->sharedTickets;
    }

	/**
     * @param boolean $sharedTickets
     */
    public function setSharedTickets($sharedTickets)
    {
        $this->sharedTickets = $sharedTickets;
    }

	/**
     * @return the $sharedComments
     */
    public function getSharedComments()
    {
        return $this->sharedComments;
    }

	/**
     * @param boolean $sharedComments
     */
    public function setSharedComments($sharedComments)
    {
        $this->sharedComments = $sharedComments;
    }

	/**
     * @return the $tags
     */
    public function getTags()
    {
        return $this->tags;
    }

	/**
     * @param multitype: $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }
}