<?php
namespace Crm\CrmBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="orders")
 *
 */
class Order{
    const STATUS_NEW = 'NEW';
    const STATUS_PENDING = 'PENDING';
    const STATUS_SHIPMENT = 'SHIPMENT';
    const STATUS_DELIVERED = 'DELIVERED';
    const STATUS_PAID = 'PAID'; 
    const STATUS_RETURNED = 'RETURNED';
    const STATUS_CANCELED = 'CANCELED';
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\OneToMany(targetEntity="OrderItem", mappedBy="order",cascade={"persist", "remove"})
     * INVERSE SIDE
     */
    private $orderItems;
    
    /**
     * @ORM\OneToOne(targetEntity="Invoice")
     */
    private $invoice;
    
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $status;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->orderItems = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set status
     *
     * @param string $status
     * @return Order
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
     * Add orderItems
     *
     * @param \Crm\CrmBundle\Entity\OrderItem $orderItems
     * @return Order
     */
    public function addOrderItem(\Crm\CrmBundle\Entity\OrderItem $orderItem)
    {
        $this->orderItems[] = $orderItem;

        return $this;
    }

    /**
     * Remove orderItems
     *
     * @param \Crm\CrmBundle\Entity\OrderItem $orderItems
     */
    public function removeOrderItem(\Crm\CrmBundle\Entity\OrderItem $orderItem)
    {
        $this->orderItems->removeElement($orderItem->setOrder(null));
    }

    /**
     * Get orderItems
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrderItems()
    {
        return $this->orderItems;
    }

    /**
     * Set invoice
     *
     * @param \Crm\CrmBundle\Entity\Invoice $invoice
     * @return Order
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
