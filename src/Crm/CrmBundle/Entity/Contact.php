<?php
namespace Crm\CrmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="contact") 
  */
class Contact{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string")
     */
    private $decription;

    /**
     * @ORM\ManyToOne(targetEntity="Client",inversedBy="comments") 
     * OWNER SIDE 
     */
    private $client;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set client
     *
     * @param \Crm\CrmBundle\Entity\Client $client
     * @return Contact
     */
    public function setClient(\Crm\CrmBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \Crm\CrmBundle\Entity\Client 
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set decription
     *
     * @param string $decription
     * @return Contact
     */
    public function setDecription($decription)
    {
        $this->decription = $decription;

        return $this;
    }

    /**
     * Get decription
     *
     * @return string 
     */
    public function getDecription()
    {
        return $this->decription;
    }
}
