<?php
namespace Crm\CrmBundle\Dao;

use Doctrine\ORM\EntityManager;
use Crm\CrmBundle\Entity\Order;
use Doctrine\ORM\EntityRepository;
class OrderDaoImpl{
    
    private $em;
    
    public function __construct(EntityManager $em){
        $this->em = $em;
    }
    
    /**
     * @return EntityManager
     */
    protected function getEm(){
        return $this->em;
    }
    /**
     * 
     * @return EntityRepository
     */
    protected function getRepository(){
        return $this->getEm()->getRepository('Crm\CrmBundle\Entity\Order');
    }

    /**
     * 
     * @param Order $entity
     * @return Order
     */
    public function create(Order $entity){
        $this->getEm()->persist($entity);
        $this->getEm()->flush();
        return $entity;
    }

    public function find($id){
        return $this->getEm()->find('Crm\CrmBundle\Entity\Order', $id);
    }
    
   public function findAll(){
       $this->getRepository()->findAll(); 
    }
}
