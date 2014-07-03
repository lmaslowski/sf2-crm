<?php
namespace Crm\CrmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity @ORM\Table(name="order_item")
 */
class OrderItem{

    /**
     * @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Order",inversedBy="orderItems",cascade={"persist", "remove"})
     * OWNER SIDE
     */
    private $order;
    
    /**
     * @ORM\OneToOne(targetEntity="Product", cascade={"persist", "remove"})
     */
    private $product;
    
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $name;
    
    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $count;
    
    /**
     * @ORM\Column(type="decimal",nullable=true)
     */
    private $netPrice;
    
    
    /**
     * @ORM\Column(type="decimal",nullable=true)
     */
    private $grossPrice;
    
    /**
     * @ORM\Column(type="decimal",nullable=true)
     */
    private $taxPrice;
    

    /**
     * @ORM\Column(type="decimal",nullable=true)
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
     * Set name
     *
     * @param string $name
     * @return OrderItem
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
     * Set count
     *
     * @param integer $count
     * @return OrderItem
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
     * Set netPrice
     *
     * @param string $netPrice
     * @return OrderItem
     */
    public function setNetPrice($netPrice)
    {
        $this->netPrice = $netPrice;

        return $this;
    }

    /**
     * Get netPrice
     *
     * @return string 
     */
    public function getNetPrice()
    {
        return $this->netPrice;
    }

    /**
     * Set grossPrice
     *
     * @param string $grossPrice
     * @return OrderItem
     */
    public function setGrossPrice($grossPrice)
    {
        $this->grossPrice = $grossPrice;

        return $this;
    }

    /**
     * Get grossPrice
     *
     * @return string 
     */
    public function getGrossPrice()
    {
        return $this->grossPrice;
    }

    /**
     * Set taxPrice
     *
     * @param string $taxPrice
     * @return OrderItem
     */
    public function setTaxPrice($taxPrice)
    {
        $this->taxPrice = $taxPrice;

        return $this;
    }

    /**
     * Get taxPrice
     *
     * @return string 
     */
    public function getTaxPrice()
    {
        return $this->taxPrice;
    }

    /**
     * Set taxRate
     *
     * @param string $taxRate
     * @return OrderItem
     */
    public function setTaxRate($taxRate)
    {
        $this->taxRate = $taxRate;

        return $this;
    }

    /**
     * Get taxRate
     *
     * @return string 
     */
    public function getTaxRate()
    {
        return $this->taxRate;
    }

    /**
     * Set order
     *
     * @param \Crm\CrmBundle\Entity\Order $order
     * @return OrderItem
     */
    public function setOrder(\Crm\CrmBundle\Entity\Order $order = null)
    {
        if($order !== null){
            $order->addOrderItem($this);
        }
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \Crm\CrmBundle\Entity\Order 
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set product
     *
     * @param \Crm\CrmBundle\Entity\Product $product
     * @return OrderItem
     */
    public function setProduct(\Crm\CrmBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Crm\CrmBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }
}
