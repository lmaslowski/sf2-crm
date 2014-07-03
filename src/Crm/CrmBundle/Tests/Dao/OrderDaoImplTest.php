<?php
namespace Crm\CrmBundle\Tests\Dao;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\ORM\EntityManager;
use Crm\CrmBundle\Dao\OrderDaoImpl;
use Crm\CrmBundle\Entity\Product;
use Crm\CrmBundle\Entity\Order;
use Crm\CrmBundle\Entity\OrderItem;

class OrderDaoImplTest extends KernelTestCase{
    
    private $em;
    private $orderDaoImpl;
    
    public function setUp(){
        parent :: setUp();
        KernelTestCase :: bootKernel();
        $this->em = self::$kernel->getContainer()->get('Doctrine')->getManager();
        $this->orderDaoImpl = new OrderDaoImpl($this->em);
    }
    /**
     * @return EntityManager
     */
    protected function getEm(){
        return $this->em;
    }
    
    /**
     * 
     * @return \Crm\CrmBundle\Dao\OrderDaoImpl
     */
    protected function getOrderDaoImpl(){
        return $this->orderDaoImpl;
    }
    
    public function testCreateOrderWithProducts(){
        //clean
        $this->clearAssociatedTables();
        
        //given
        $order = new Order();
        
        
        $produc1 = new Product();
        $produc1->setName('Product 1');
        
        $orderItem1 = new OrderItem();
        $orderItem1->setName('order item1');
        $orderItem1->setCount(10);
        $orderItem1->setOrder($order);
        $orderItem1->setProduct($produc1);

        $product2 = new Product();
        $product2->setName('Product 2');
        
        $orderItem2 = new OrderItem();
        $orderItem2->setName('order item2');
        $orderItem2->setCount(20);
        $orderItem2->setOrder($order);
        $orderItem2->setProduct($product2);

        $product3 = new Product();
        $product3->setName('Product 3');
        $orderItem3 = new OrderItem();
        $orderItem3->setName('order item3');
        $orderItem3->setProduct($product3);
        $orderItem3->setCount(20);
        $orderItem3->setOrder($order);
                
        $order = $this->getOrderDaoImpl()->create($order);
        
        //when
        $id = $order->getId();
        $orderResult = $this->getOrderDaoImpl()->find($id);
        var_dump($order->getOrderItems()->toArray());
        
        //then
        
        //clean
//         $this->clearAssociatedTables();
    }
    
    private function clearAssociatedTables(){
        $this->clearOrderItemTable();
        $this->clearOrderTable();
        $this->clearProductTable();
    }
    
    private function clearOrderTable(){
        $this->getEm()->getConnection()->query('DELETE FROM orders');
    }
    
    private function clearOrderItemTable(){
        $this->getEm()->getConnection()->query('DELETE FROM order_item');
    }
    
    private function clearProductTable(){
        $this->getEm()->getConnection()->query('DELETE FROM product');
    }
}