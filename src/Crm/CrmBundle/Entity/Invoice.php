<?php
namespace Crm\CrmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity @ORM\Table(name="invoice")
 */
class Invoice{
    /**
     * @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=140) 
     */
    private $number;
    
    /**
     * @ORM\Column(type="datetime", name="created_date",nullable=true)
     */
    private $createdDate;
    
    /**
     * @ORM\Column(type="datetime", name="payment_term_date",nullable=true)
     */
    private $paymentTermDate;
    
    /**
     * @ORM\Column(type="datetime", name="paid_date", nullable=true)
     */
    private $paidDate;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Crm\CrmBundle\Entity\Client", inversedBy="invoices", cascade={"persist", "remove"}) 
     */
    private $client;

    /**
     * @ORM\OneToMany(targetEntity="InvoiceItem", mappedBy="invoice", cascade={"persist", "remove"})
     */
    private $items;
    
    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $netPrice;
    
    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $taxPrice;
    
    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $taxRate;
    
    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $grossPrice;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $status;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $paymentMethod;
    
    
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
     * Set number
     *
     * @param string $number
     * @return Invoice
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     * @return Invoice
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * Get createdDate
     *
     * @return \DateTime 
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Set paymentTermDate
     *
     * @param \DateTime $paymentTermDate
     * @return Invoice
     */
    public function setPaymentTermDate($paymentTermDate)
    {
        $this->paymentTermDate = $paymentTermDate;

        return $this;
    }

    /**
     * Get paymentTermDate
     *
     * @return \DateTime 
     */
    public function getPaymentTermDate()
    {
        return $this->paymentTermDate;
    }

    /**
     * Set paidDate
     *
     * @param \DateTime $paidDate
     * @return Invoice
     */
    public function setPaidDate($paidDate)
    {
        $this->paidDate = $paidDate;

        return $this;
    }

    /**
     * Get paidDate
     *
     * @return \DateTime 
     */
    public function getPaidDate()
    {
        return $this->paidDate;
    }

    /**
     * Set client
     *
     * @param \Crm\CrmBundle\Entity\Client $client
     * @return Invoice
     */
    public function setClient(Client $client = null)
    {
        $this->client = $client->addInvoice($this);

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
     * Constructor
     */
    public function __construct()
    {
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add items
     *
     * @param \Crm\CrmBundle\Entity\InvoiceItem $items
     * @return Invoice
     */
    public function addItem(\Crm\CrmBundle\Entity\InvoiceItem $item)
    {
        $this->items[] = $item;
        $item->setInvoice($this);
        return $this;
    }

    /**
     * Remove items
     *
     * @param \Crm\CrmBundle\Entity\InvoiceItem $items
     */
    public function removeItem(\Crm\CrmBundle\Entity\InvoiceItem $item)
    {
        $item->setInvoice(null);
        $this->items->removeElement($item);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Set netPrice
     *
     * @param float $netPrice
     * @return Invoice
     */
    public function setNetPrice($netPrice)
    {
        $this->netPrice = $netPrice;

        return $this;
    }

    /**
     * Get netPrice
     *
     * @return float 
     */
    public function getNetPrice()
    {
        return $this->netPrice;
    }

    /**
     * Set taxPrice
     *
     * @param float $taxPrice
     * @return Invoice
     */
    public function setTaxPrice($taxPrice)
    {
        $this->taxPrice = $taxPrice;

        return $this;
    }

    /**
     * Get taxPrice
     *
     * @return float 
     */
    public function getTaxPrice()
    {
        return $this->taxPrice;
    }

    /**
     * Set taxRate
     *
     * @param float $taxRate
     * @return Invoice
     */
    public function setTaxRate($taxRate)
    {
        $this->taxRate = $taxRate;

        return $this;
    }

    /**
     * Get taxRate
     *
     * @return float 
     */
    public function getTaxRate()
    {
        return $this->taxRate;
    }

    /**
     * Set grossPrice
     *
     * @param float $grossPrice
     * @return Invoice
     */
    public function setGrossPrice($grossPrice)
    {
        $this->grossPrice = $grossPrice;

        return $this;
    }

    /**
     * Get grossPrice
     *
     * @return float 
     */
    public function getGrossPrice()
    {
        return $this->grossPrice;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Invoice
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set paymentMethod
     *
     * @param string $paymentMethod
     * @return Invoice
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    /**
     * Get paymentMethod
     *
     * @return string 
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }
}
