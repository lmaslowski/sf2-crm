<?php
namespace Crm\CrmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="client")
 *
 */
class Client{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;
    
    /**
     * @ORM\OneToMany(targetEntity="Contact", mappedBy="client", cascade={"persist", "remove"})
     * INVERSE SIDE
     */
    private $contacts;
    
    /**
     * @ORM\OneToMany(targetEntity="Invoice", mappedBy="client", cascade={"persist", "remove"})
     * @var unknown
     */
    private $invoices;
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contacts = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     * @return Client
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add contacts
     *
     * @param \Crm\CrmBundle\Entity\Contact $contacts
     * @return Client
     */
    public function addContact(\Crm\CrmBundle\Entity\Contact $contact)
    {
        $this->contacts[] = $contact->setClient($this);

        return $this;
    }

    /**
     * Remove contacts
     *
     * @param \Crm\CrmBundle\Entity\Contact $contacts
     */
    public function removeContact(\Crm\CrmBundle\Entity\Contact $contact)
    {
        $this->contacts->removeElement($contact->setClient(null));
    }

    /**
     * Get contacts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * Add invoices
     *
     * @param \Crm\CrmBundle\Entity\Invoice $invoices
     * @return Client
     */
    public function addInvoice(\Crm\CrmBundle\Entity\Invoice $invoices)
    {
        $this->invoices[] = $invoices;

        return $this;
    }

    /**
     * Remove invoices
     *
     * @param \Crm\CrmBundle\Entity\Invoice $invoices
     */
    public function removeInvoice(\Crm\CrmBundle\Entity\Invoice $invoices)
    {
        $this->invoices->removeElement($invoices);
    }

    /**
     * Get invoices
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInvoices()
    {
        return $this->invoices;
    }
}
