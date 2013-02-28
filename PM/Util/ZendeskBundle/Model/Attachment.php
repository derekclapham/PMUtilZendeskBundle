<?php
namespace PM\Util\ZendeskBundle\Model;

/**
 * Represents a Zendesk attachment
 * 
 * @author Derek Clapham <derek.clapham@photomerchant.net>
 */
class Attachment
{
    /**
     * Automatically assigned when created
     * @var integer $id
     */
    private $id;
    
    /**
     * The name of the image file
     * @var string $id
     */
    private $fileName;
    
    /**
     * A full URL where the attachment image file can be downloaded
     * @var string $id
     */
    private $contentUrl;
    
    /**
     * The content type of the image. Example value: image/png
     * @var string $id
     */
    private $contentType;
    
    /**
     * The size of the image file in bytes
     * @var integer $id
     */
    private $size;
    
    /**
     * An array of PM\Util\ZendeskBundle\Model\Photo objects. Note that thumbnails do not have thumbnails.
     * @var Array $id
     */
    private $thumbnails;

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
     * @return the $fileName
     */
    public function getFileName()
    {
        return $this->fileName;
    }

	/**
     * @param string $fileName
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

	/**
     * @return the $contentUrl
     */
    public function getContentUrl()
    {
        return $this->contentUrl;
    }

	/**
     * @param string $contentUrl
     */
    public function setContentUrl($contentUrl)
    {
        $this->contentUrl = $contentUrl;
    }

	/**
     * @return the $contentType
     */
    public function getContentType()
    {
        return $this->contentType;
    }

	/**
     * @param string $contentType
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
    }

	/**
     * @return the $size
     */
    public function getSize()
    {
        return $this->size;
    }

	/**
     * @param number $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

	/**
     * @return the $thumbnails
     */
    public function getThumbnails()
    {
        return $this->thumbnails;
    }

	/**
     * @param multitype: $thumbnails
     */
    public function setThumbnails($thumbnails)
    {
        $this->thumbnails = $thumbnails;
    }

}