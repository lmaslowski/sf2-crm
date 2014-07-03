<?php
namespace Crm\CrmBundle\Dao;

use Doctrine\ORM\EntityManager;
use Crm\CrmBundle\Entity\Invoice;
class InvoiceDaoImpl{
    private $em;
    public function __construct(EntityManager $em){
        $this->em = $em;
    }
    
    private function getEm(){
        return $this->em;
    }
    
    public function createInvoice(Invoice $invoice){
        $this->getEm()->persist($invoice);
        $this->getEm()->flush();
        return $invoice;
    }
}