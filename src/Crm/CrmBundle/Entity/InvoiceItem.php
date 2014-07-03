<?php
namespace Crm\CrmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity @ORM\Table(name="invoice_item") 
 */
class InvoiceItem{
    /**
     * @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Invoice", inversedBy="items")
     * OWNER SIDE 
     */
    private $invoice;
    
    /**
     * @ORM\Column(type="string", length=150)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $count;
    
    /**
     * @ORM\Column(type="float")
     */
    private $unitPrice;
    
    /**
     * @ORM\Column(type="float")
     */
    private $netPrice;

    /**
     * @ORM\Column(type="float")
     */
    private $taxPrice;
    
    /**
     * @ORM\Column(type="float")
     */
    private $grossPrice;

    /**
     * @ORM\Column(type="float")
     */
    private $taxRate;


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
     * Set description
     *
     * @param string $description
     * @return InvoiceItem
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set count
     *
     * @param integer $count
     * @return InvoiceItem
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return integer 
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set unitPrice
     *
     * @param float $unitPrice
     * @return InvoiceItem
     */
    public function setUnitPrice($unitPrice)
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }

    /**
     * Get unitPrice
     *
     * @return float 
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    /**
     * Set netPrice
     *
     * @param float $netPrice
     * @return InvoiceItem
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
     * @return InvoiceItem
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
     * Set grossPrice
     *
     * @param float $grossPrice
     * @return InvoiceItem
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
     * Set taxRate
     *
     * @param float $taxRate
     * @return InvoiceItem
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
     * Set invoice
     *
     * @param \Crm\CrmBundle\Entity\Invoice $invoice
     * @return InvoiceItem
     */
    public function setInvoice(\Crm\CrmBundle\Entity\Invoice $invoice = null)
    {
        $this->invoice = $invoice;

        return $this;
    }

    /**
     * Get invoice
     *
     * @return \Crm\CrmBundle\Entity\Invoice 
     */
    public function getInvoice()
    {
        return $this->invoice;
    }
}
