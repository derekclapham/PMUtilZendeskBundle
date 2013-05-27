<?php
namespace PM\Util\ZendeskBundle\Model;
use JMS\Serializer\Annotation as Serializer;

/**
 * Represents a Zendesk user
 * 
 * @author Derek Clapham <derek.clapham@photomerchant.net>
 */
class User
{
    /**
     * Automatically assigned when creating users
     * @var integer $id
     * 
     * @Serializer\Type("integer")
     */
    private $id;
    
    /**
     * The API url of this user
     * @var string $url
     * 
     * @Serializer\Type("string")
     */
    private $url;
    
    /**
     * The name of the user
     * @var string $name
     * 
     * @Serializer\Type("string")
     */
    private $name;
    
    /**
     * A unique id you can set on a user
     * @var string $externalId
     *
     * @Serializer\SerializedName("external_id")
     * @Serializer\Type("string")
     */
    private $externalId;
    
    /**
     * Agents can have an alias that is displayed to end-users
     * @var string $alias
     * 
     * @Serializer\Type("string")
     */
    private $alias;
    
    /**
     * The time the user was created
     * @var \DateTime $createdAt
     *
     * @Serializer\SerializedName("created_at")
     * @Serializer\Type("DateTime")
     */
    private $createdAt;
    
    /**
     * The time of the last update of the user
     * @var \DateTime $updatedAt
     *
     * @Serializer\SerializedName("updated_at")
     * @Serializer\Type("DateTime")
     */
    private $updatedAt;
    
    /**
     * Users that have been deleted will have the value false here
     * @var boolean $active
     * 
     * @Serializer\Type("boolean")
     */
    private $active;
    
    /**
     * Zendesk has verified that this user is who he says he is
     * @var boolean $verified
     * 
     * @Serializer\Type("boolean")
     */
    private $verified;
    
    /**
     * If this user is shared from a different Zendesk, ticket sharing accounts only
     * @var boolean $shared
     * 
     * @Serializer\Type("boolean")
     */
    private $shared;
    
    /**
     * The language identifier for this user
     * @var integer $localeId
     *
     * @Serializer\SerializedName("locale_id")
     * @Serializer\Type("integer")
     */
    private $localeId;
    
    /**
     * The time-zone of this user
     * @var string $timezone
     * 
     * @Serializer\Type("string")
     */
    private $timezone;
    
    /**
     * A time-stamp of the last time this user logged in to Zendesk
     * @var \DateTime $lastLoginAt
     *
     * @Serializer\SerializedName("last_login_at")
     * @Serializer\Type("DateTime")
     */
    private $lastLoginAt;
    
    /**
     * The primary email address of this user
     * @var string $email
     * 
     * @Serializer\Type("string")
     */
    private $email;
    
    /**
     * The primary phone number of this user
     * @var string $phone
     * 
     * @Serializer\Type("string")
     */
    private $phone;
    
    /**
     * Array of user identities (e.g. email and Twitter) associated with this user. 
     * See http://developer.zendesk.com/documentation/rest_api/user_identities.html
     * @var Array $identities
     * 
     * @Serializer\Type("array")
     */
    private $identities;
    
    /**
     * The signature of this user. Only agents and admins can have signatures
     * @var string $signature
     * 
     * @Serializer\Type("string")
     */
    private $signature;
    
    /**
     * In this field you can store any details obout the user. e.g. the address
     * @var string $details
     * 
     * @Serializer\Type("string")
     */
    private $details;
    
    /**
     * In this field you can store any notes you have about the user
     * @var string $notes
     * 
     * @Serializer\Type("string")
     */
    private $notes;
    
    /**
     * The id of the organization this user is associated with
     * @var integer $organizationId
     * 
     * @Serializer\SerializedName("organization_id")
     * @Serializer\Type("integer")
     */
    private $organizationId;
    
    /**
     * The role of the user. Possible values: "end-user", "agent", "admin"
     * @var string $role
     * 
     * @Serializer\Type("string")
     */
    private $role;
    
    /**
     * A custom role on the user if the user is an agent on the entreprise plan
     * @var integer $customRoleId
     * 
     * @Serializer\SerializedName("custom_rold_id")
     * @Serializer\Type("integer")
     */
    private $customRoleId;
    
    /**
     * Designates whether this user has forum moderation capabilities
     * @var boolean $moderator
     * 
     * @Serializer\Type("boolean")
     */
    private $moderator;
    
    /**
     * Specified which tickets this user has access to. Possible 
     * values are: "organization", "groups", "assigned", "requested", null
     * @var string $ticketRestriction
     *
     * @Serializer\SerializedName("ticket_restriction")
     * @Serializer\Type("string")
     */
    private $ticketRestriction;
    
    /**
     * true if this user only can create private comments
     * @var boolean $onlyPrivateComments
     *
     * @Serializer\SerializedName("only_private_comments")
     * @Serializer\Type("boolean")
     */
    private $onlyPrivateComments;
    
    /**
     * The tags of the user. Only present if your account has user tagging enabled
     * @var Array $tags
     * 
     * @Serializer\Type("array")
     */
    private $tags;
    
    /**
     * Tickets from suspended users are also suspended, and these users cannot log in to the end-user portal
     * @var boolean $suspended
     * 
     * @Serializer\Type("boolean")
     */
    private $suspended;
    
    /**
     * The user's profile picture represented as an Attachment object
     * See: http://developer.zendesk.com/documentation/rest_api/attachments.html
     * @var PM\Util\ZendeskBundle\Model\Photo $photo
     * 
     * @Serializer\Type("string")
     */
    private $photo;

    public function __construct()
    {
        $this->role = "end-user";
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
     * @return the $url
     */
    public function getUrl()
    {
        return $this->url;
    }

	/**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
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
     * @return the $alias
     */
    public function getAlias()
    {
        return $this->alias;
    }

	/**
     * @param string $alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
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
     * @return the $active
     */
    public function getActive()
    {
        return $this->active;
    }

	/**
     * @param boolean $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

	/**
     * @return the $verified
     */
    public function getVerified()
    {
        return $this->verified;
    }

	/**
     * @param boolean $verified
     */
    public function setVerified($verified)
    {
        $this->verified = $verified;
    }

	/**
     * @return the $shared
     */
    public function getShared()
    {
        return $this->shared;
    }

	/**
     * @param boolean $shared
     */
    public function setShared($shared)
    {
        $this->shared = $shared;
    }

	/**
     * @return the $localeId
     */
    public function getLocaleId()
    {
        return $this->localeId;
    }

	/**
     * @param number $localeId
     */
    public function setLocaleId($localeId)
    {
        $this->localeId = $localeId;
    }

	/**
     * @return the $timezone
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

	/**
     * @param string $timezone
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
    }

	/**
     * @return the $lastLoginAt
     */
    public function getLastLoginAt()
    {
        return $this->lastLoginAt;
    }

	/**
     * @param DateTime $lastLoginAt
     */
    public function setLastLoginAt($lastLoginAt)
    {
        $this->lastLoginAt = $lastLoginAt;
    }

	/**
     * @return the $email
     */
    public function getEmail()
    {
        return $this->email;
    }

	/**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

	/**
     * @return the $phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

	/**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

	/**
     * @return the $identities
     */
    public function getIdentities()
    {
        return $this->identities;
    }

	/**
     * @param multitype: $identities
     */
    public function setIdentities($identities)
    {
        $this->identities = $identities;
    }

	/**
     * @return the $signature
     */
    public function getSignature()
    {
        return $this->signature;
    }

	/**
     * @param string $signature
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;
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
     * @return the $organizationId
     */
    public function getOrganizationId()
    {
        return $this->organizationId;
    }

	/**
     * @param number $organizationId
     */
    public function setOrganizationId($organizationId)
    {
        $this->organizationId = $organizationId;
    }

	/**
     * @return the $role
     */
    public function getRole()
    {
        return $this->role;
    }

	/**
     * @param string $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

	/**
     * @return the $customRoleId
     */
    public function getCustomRoleId()
    {
        return $this->customRoleId;
    }

	/**
     * @param number $customRoleId
     */
    public function setCustomRoleId($customRoleId)
    {
        $this->customRoleId = $customRoleId;
    }

	/**
     * @return the $moderator
     */
    public function getModerator()
    {
        return $this->moderator;
    }

	/**
     * @param boolean $moderator
     */
    public function setModerator($moderator)
    {
        $this->moderator = $moderator;
    }

	/**
     * @return the $ticketRestriction
     */
    public function getTicketRestriction()
    {
        return $this->ticketRestriction;
    }

	/**
     * @param string $ticketRestriction
     */
    public function setTicketRestriction($ticketRestriction)
    {
        $this->ticketRestriction = $ticketRestriction;
    }

	/**
     * @return the $onlyPrivateComments
     */
    public function getOnlyPrivateComments()
    {
        return $this->onlyPrivateComments;
    }

	/**
     * @param boolean $onlyPrivateComments
     */
    public function setOnlyPrivateComments($onlyPrivateComments)
    {
        $this->onlyPrivateComments = $onlyPrivateComments;
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

	/**
     * @return the $suspended
     */
    public function getSuspended()
    {
        return $this->suspended;
    }

	/**
     * @param boolean $suspended
     */
    public function setSuspended($suspended)
    {
        $this->suspended = $suspended;
    }

	/**
     * @return the $photo
     */
    public function getPhoto()
    {
        return $this->photo;
    }

	/**
     * @param \PM\Util\ZendeskBundle\Model\Attachment $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }
}