<?php
namespace Crm\CrmBundle\Dao;

use Crm\CrmBundle\Entity\Client;
use Doctrine\ORM\EntityManager;
class ClientDaoImpl{
    
    public function __construct(EntityManager $em){
        $this->em = $em;
    }
    
    public function getEm(){
        return $this->em;
    }
    
    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    public function getRepository(){
        return $this->getEm()->getRepository('Crm\CrmBundle\Entity\Client');
    }
    
    public function find($id){
        return $this->getRepository()->find($id);
    }
    
    public function getAllClients(){
        return $this->getRepository()->findAll();
    }
    
    public function createClient(Client $client){
        $this->getEm()->persist($client);
        $this->getEm()->flush();
        return $client;
    }
    
    public function updateClient(Client $client){
        $this->getEm()->persist($client);
        $this->getEm()->flush();
        return $client;
    }
    
    public function deleteClient(Client $client){
        $this->getEm()->remove($client);
        $this->getEm()->flush();
        return $client;
    }
}