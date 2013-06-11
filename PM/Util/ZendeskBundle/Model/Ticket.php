<?php
namespace PM\Util\ZendeskBundle\Model;
use JMS\Serializer\Annotation as Serializer;

/**
 * Represents a Zendesk ticket
 * 
 * @author Derek Clapham <derek.clapham@photomerchant.net>
 */
class Ticket
{
    /**
     * Automatically assigned when creating tickets
     * @var integer $id
     * 
     * @Serializer\Type("integer")
     */
    private $id;
    
    /**
     * The API url of this ticket
     * @var string $url
     * 
     * @Serializer\Type("string")
     */
    private $url;
    
    /**
     * A unique external id, you can use this to link 
     * Zendesk tickets to local records
     * @var string $externalId
     *
     * @Serializer\SerializedName("external_id")
     * @Serializer\Type("string")
     */
    private $externalId;
    
    /**
     * The type of this ticket, i.e. "problem", "incident", "question" or "task"
     * @var string $type
     * 
     * @Serializer\Type("string")
     */
    private $type;
    
    /**
     * The value of the subject field for this ticket
     * @var string $subject
     *
     * @Serializer\Type("string")
     */
    private $subject;
    
    /**
     * The first comment on the ticket
     * @var string $description
     *
     * @Serializer\Type("string")
     */
    private $description;
    
    /**
     * Priority, defines the urgency with which the ticket should be addressed: "urgent", "high", "normal", "low"
     * @var string $priority
     *
     * @Serializer\Type("string")
     */
    private $priority;
    
    /**
     * The state of the ticket, "new", "open", "pending", "hold", "solved", "closed"
     * @var string $status
     *
     * @Serializer\Type("string")
     */
    private $status;
    
    /**
     * The original recipient e-mail address of the ticket
     * @var string $recipient
     *
     * @Serializer\Type("string")
     */
    private $recipient;
    
    /**
     * The user who requested this ticket
     * @var integer $requesterId
     * 
     * @Serializer\SerializedName("requester_id")
     * @Serializer\Type("integer")
     */
    private $requesterId;
    
    /**
     * The user who submitted the ticket; The submitter always 
     * becomes the author of the first comment on the ticket.
     * @var integer $submitterId
     *
     * @Serializer\SerializedName("submitter_id")
     * @Serializer\Type("integer")
     */
    private $submitterId;
    
    /**
     * What agent is currently assigned to the ticket
     * @var integer $assigneeId
     *
     * @Serializer\SerializedName("assignee_id")
     * @Serializer\Type("integer")
     */
    private $assigneeId;
    
    /**
     * The organization of the requester
     * @var integer $organizationId
     *
     * @Serializer\SerializedName("organization_id")
     * @Serializer\Type("integer")
     */
    private $organizationId;
    
    /**
     * The group this ticket is assigned to
     * @var integer $groupId
     *
     * @Serializer\SerializedName("group_id")
     * @Serializer\Type("integer")
     */
    private $groupId;
    
    /**
     * Who are currently CC'ed on the ticket
     * @var Array $collaboratorIds
     *
     * @Serializer\SerializedName("collaborator_ids")
     * @Serializer\Type("array")
     */
    private $collaboratorIds;
    
    /**
     * The topic this ticket originated from, if any
     * @var integer $forumTopicId
     *
     * @Serializer\SerializedName("forum_topic_id")
     * @Serializer\Type("integer")
     */
    private $forumTopicId;
    
    /**
     * The problem this incident is linked to, if any
     * @var integer $problemId
     *
     * @Serializer\SerializedName("problem_id")
     * @Serializer\Type("integer")
     */
    private $problemId;
    
    /**
     * Is true of this ticket has been marked as a problem, false otherwise
     * @var boolean $hasIncidents
     * 
     * @Serializer\SerializedName("has_incidents")
     * @Serializer\Type("boolean")
     */
    private $hasIncidents;
    
    /**
     * If this is a ticket of type "task" it has a due date. Due date format uses ISO 8601 format.
     * @var \DateTime $dueAt
     *
     * @Serializer\SerializedName("due_at")
     * @Serializer\Type("DateTime")
     */
    private $dueAt;
    
    /**
     * The array of tags applied to this ticket
     * @var Array $tags
     *
     * @Serializer\Type("array")
     */
    private $tags;
    
    /**
     * This object explains how the ticket was created
     * @var string $via
     *
     * @Serializer\Type("PM\Util\ZendeskBundle\Model\Via")
     */
    private $via;
    
    /**
     * The custom fields of the ticket
     * @var Array $customFields
     *
     * @Serializer\SerializedName("custom_fields")
     * @Serializer\Type("array")
     */
    private $customFields;
    
    /**
     * The satisfaction rating of the ticket, if it exists
     * @var string $satisfactionRating
     *
     * @Serializer\SerializedName("satisfaction_rating")
     * @Serializer\Type("array")
     */
    private $satisfactionRating;
    
    /**
     * The ids of the sharing agreements used for this ticket
     * @var Array $sharingAgreementIds
     *
     * @Serializer\SerializedName("sharing_agreement_ids")
     * @Serializer\Type("array")
     */
    private $sharingAgreementIds;
    
    /**
     * The ids of the followups created from this ticket - only applicable for closed tickets
     * @var Array $followupIds
     *
     * @Serializer\SerializedName("followup_ids")
     * @Serializer\Type("array")
     */
    private $followupIds;
    
    /**
     * The id of the ticket form to render for this ticket - only applicable for enterprise accounts
     * @var integer $ticketFormId
     *
     * @Serializer\SerializedName("ticket_form_id")
     * @Serializer\Type("integer")
     */
    private $ticketFormId;
    
    /**
     * When this record was created
     * @var \DateTime $createdAt
     *
     * @Serializer\SerializedName("created_at")
     * @Serializer\Type("DateTime")
     */
    private $createdAt;
    
    /**
     * When this record last got updated
     * @var \DateTime $updatedAt
     *
     * @Serializer\SerializedName("updated_at")
     * @Serializer\Type("DateTime")
     */
    private $updatedAt;

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
     * @return the $type
     */
    public function getType()
    {
        return $this->type;
    }

	/**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

	/**
     * @return the $subject
     */
    public function getSubject()
    {
        return $this->subject;
    }

	/**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

	/**
     * @return the $description
     */
    public function getDescription()
    {
        return $this->description;
    }

	/**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

	/**
     * @return the $priority
     */
    public function getPriority()
    {
        return $this->priority;
    }

	/**
     * @param string $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

	/**
     * @return the $status
     */
    public function getStatus()
    {
        return $this->status;
    }

	/**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

	/**
     * @return the $recipient
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

	/**
     * @param string $recipient
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
    }

	/**
     * @return the $requesterId
     */
    public function getRequesterId()
    {
        return $this->requesterId;
    }

	/**
     * @param number $requesterId
     */
    public function setRequesterId($requesterId)
    {
        $this->requesterId = $requesterId;
    }

	/**
     * @return the $submitterId
     */
    public function getSubmitterId()
    {
        return $this->submitterId;
    }

	/**
     * @param number $submitterId
     */
    public function setSubmitterId($submitterId)
    {
        $this->submitterId = $submitterId;
    }

	/**
     * @return the $assigneeId
     */
    public function getAssigneeId()
    {
        return $this->assigneeId;
    }

	/**
     * @param number $assigneeId
     */
    public function setAssigneeId($assigneeId)
    {
        $this->assigneeId = $assigneeId;
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
     * @return the $collaboratorIds
     */
    public function getCollaboratorIds()
    {
        return $this->collaboratorIds;
    }

	/**
     * @param multitype: $collaboratorIds
     */
    public function setCollaboratorIds($collaboratorIds)
    {
        $this->collaboratorIds = $collaboratorIds;
    }

	/**
     * @return the $forumTopicId
     */
    public function getForumTopicId()
    {
        return $this->forumTopicId;
    }

	/**
     * @param number $forumTopicId
     */
    public function setForumTopicId($forumTopicId)
    {
        $this->forumTopicId = $forumTopicId;
    }

	/**
     * @return the $problemId
     */
    public function getProblemId()
    {
        return $this->problemId;
    }

	/**
     * @param number $problemId
     */
    public function setProblemId($problemId)
    {
        $this->problemId = $problemId;
    }

	/**
     * @return the $hasIncidents
     */
    public function getHasIncidents()
    {
        return $this->hasIncidents;
    }

	/**
     * @param boolean $hasIncidents
     */
    public function setHasIncidents($hasIncidents)
    {
        $this->hasIncidents = $hasIncidents;
    }

	/**
     * @return the $dueAt
     */
    public function getDueAt()
    {
        return $this->dueAt;
    }

	/**
     * @param DateTime $dueAt
     */
    public function setDueAt($dueAt)
    {
        $this->dueAt = $dueAt;
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
     * @return the $via
     */
    public function getVia()
    {
        return $this->via;
    }

	/**
     * @param string $via
     */
    public function setVia($via)
    {
        $this->via = $via;
    }

	/**
     * @return the $customFields
     */
    public function getCustomFields()
    {
        return $this->customFields;
    }

	/**
     * @param multitype: $customFields
     */
    public function setCustomFields($customFields)
    {
        $this->customFields = $customFields;
    }

	/**
     * @return the $satisfactionRating
     */
    public function getSatisfactionRating()
    {
        return $this->satisfactionRating;
    }

	/**
     * @param string $satisfactionRating
     */
    public function setSatisfactionRating($satisfactionRating)
    {
        $this->satisfactionRating = $satisfactionRating;
    }

	/**
     * @return the $sharingAgreementIds
     */
    public function getSharingAgreementIds()
    {
        return $this->sharingAgreementIds;
    }

	/**
     * @param multitype: $sharingAgreementIds
     */
    public function setSharingAgreementIds($sharingAgreementIds)
    {
        $this->sharingAgreementIds = $sharingAgreementIds;
    }

	/**
     * @return the $followupIds
     */
    public function getFollowupIds()
    {
        return $this->followupIds;
    }

	/**
     * @param multitype: $followupIds
     */
    public function setFollowupIds($followupIds)
    {
        $this->followupIds = $followupIds;
    }

	/**
     * @return the $ticketFormId
     */
    public function getTicketFormId()
    {
        return $this->ticketFormId;
    }

	/**
     * @param number $ticketFormId
     */
    public function setTicketFormId($ticketFormId)
    {
        $this->ticketFormId = $ticketFormId;
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
}