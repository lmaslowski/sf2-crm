<?php
namespace Crm\CrmBundle\Tests\Dao;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Crm\CrmBundle\Dao\InvoiceDaoImpl;
use Doctrine\ORM\EntityManager;
use Crm\CrmBundle\Entity\Invoice;
use Crm\CrmBundle\Entity\Client;

class InvoiceDaoImplTest extends KernelTestCase{
    
    private $invoiceDaoImp;
    public function setUp(){
        parent::setUp();
        KernelTestCase :: bootKernel();
        $this->em = self::$kernel->getContainer()->get('Doctrine')->getManager();
        $this->invoiceDaoImp = new InvoiceDaoImpl(self::$kernel->getContainer()->get('Doctrine')->getManager());
    }
    
    /**
     * @return EntityManager
     */
    private function getEm(){
        return $this->em;
    }
    
    private function getInvoiceDaoImp(){
        return $this->invoiceDaoImp;
    }
    
    public function testCreateInvoiceWithoutClientAssocation(){
        //clean
        $this->clearInvoiceTable();
        $this->clearClientTable();
    
        //when
        $invoice = new Invoice();
        $invoice->setCreatedDate(new \DateTime(date('Y-m-d')));
        $invoice->setPaidDate(new \DateTime(date('Y-m-d')));
        $invoice->setPaymentTermDate(new \DateTime(date('Y-m-d')));
        $invoice->setNumber('1/2/3');
    
        $invoiceExpected = $this->getInvoiceDaoImp()->createInvoice($invoice);
    
        //then
        $this->assertNull($invoiceExpected->getClient());
        $this->assertEquals($invoiceExpected->getNumber(), '1/2/3');
    
        //clean
        $this->clearInvoiceTable();
        $this->clearClientTable();
    }
        
    public function testCreateInvoiceWithClientAssocation(){
        //clean
        $this->clearInvoiceTable();
        $this->clearClientTable();
    
        //when
        $client = new Client();
        $client->setName('Okok1');
    
        $dateTimeNow = new \DateTime('now', new \DateTimeZone('Europe/Warsaw'));
        
        $invoice = new Invoice();
        $invoice->setCreatedDate($dateTimeNow);
        $invoice->setPaidDate($dateTimeNow);
        $invoice->setPaymentTermDate($dateTimeNow);
        $invoice->setNumber('1/2/3');
       
        
        //assocation
        $invoice->setClient($client);
       
        $invoiceExpected = $this->getInvoiceDaoImp()->createInvoice($invoice);
    
        //then
        $this->assertEquals($invoiceExpected->getNumber(), '1/2/3');
        $clientExpected = $this->getEm()->find('Crm\CrmBundle\Entity\Client', $client->getId());

        foreach($clientExpected->getInvoices()->toArray() as $invoiceItem){
            $this->assertEquals($invoiceItem, $invoice);
        }
        
        //clean
        $this->clearInvoiceTable();
        $this->clearClientTable();
    }
    
    public function testDataTime(){
        
        $dateTime = new \DateTime('now', new \DateTimeZone('Europe/Warsaw'));
        $dateTime->add(new \DateInterval('P14D'));
    }
    
    
    private function clearInvoiceTable(){
        $conn = $this->getEm()->getConnection();
        $conn->query("DELETE FROM invoice");
    }
    
    private function clearClientTable(){
        $conn = $this->getEm()->getConnection();
        $conn->query("DELETE FROM client");
    }
}