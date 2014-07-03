<?php
namespace Crm\CrmBundle\Tests\Dao;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Crm\CrmBundle\Dao\ClientDaoImpl;
use Crm\CrmBundle\Entity\Client;
use Crm\CrmBundle\Entity\Contact;
use Doctrine\ORM\EntityManager;
class ClientDaoImplTest extends KernelTestCase{
    private $em;
    private $clientDaoImpl;
    private $repository;
    
    public function setUp(){
        parent::setUp();
        KernelTestCase :: bootKernel();
        $this->em = self::$kernel->getContainer()->get('Doctrine')->getManager();
        $this->repository = $this->em->getRepository('Crm\CrmBundle\Entity\Client');
        $this->clientDaoImpl = new ClientDaoImpl($this->em);
    }
    /**
     * @return EntityManager
     */
    public function getEm(){
        return $this->em;
    }
    
    public function getClientDaoImpl(){
        return $this->clientDaoImpl;
    }
    
    public function testCreateClient(){
        //given
        $client = new Client();
        $client->setName('Okok1');
        
        //when
        $clientExpected = $this->getClientDaoImpl()->createClient($client);
    
        //then
        $this->assertEquals($clientExpected->getName(), $client->getName());

        //clean
        $this->getEm()->remove($clientExpected);
        $this->getEm()->flush();
    }

    public function testCreateClientCascadeWithCommet(){
        //clean
        $this->clearTableContact();
        $this->clearTableUser();
        
        //given
        $client = new Client();
        $client->setName('Okok1');
        
        $contact1 = new Contact();
        $contact1->setDecription('Contact1 do klient Okok1');

        $contact2 = new Contact();
        $contact2->setDecription('Contact2 do klient Okok1');
        
        $client->addContact($contact1);
        $client->addContact($contact2);
        
        //when
        $clientExpected = $this->getClientDaoImpl()->createClient($client);
    
        //then
        $this->assertEquals($clientExpected->getName(), $client->getName());
    
        //clean
        $this->getEm()->remove($clientExpected);
        $this->getEm()->flush();
    }
    
    public function testFindUser(){
        //clean
        $this->clearTableContact();
        $this->clearTableUser();

        //given
        $client = new Client();
        $client->setName('Okok1');

        $contact1 = new Contact();
        $contact1->setDecription('Contact1 do klient Okok1');
        
        $contact2 = new Contact();
        $contact2->setDecription('Contact2 do klient Okok1');
        
        $client->addContact($contact1);
        $client->addContact($contact2);
        
        $this->getEm()->persist($client);
        $this->getEm()->flush();
        
        $id = $client->getId();

        //when
        $clientExpected = $this->getClientDaoImpl()->find($id);
        
        //then
        $this->assertEquals($clientExpected, $client);
        $this->assertEquals($client->getContacts()->toArray(), array($contact1, $contact2));
        
        //clean
        $this->clearTableContact();
        $this->clearTableUser();
    }
    
    public function testRemoveContactClient(){
        //clean
        $this->clearTableContact();
        $this->clearTableUser();
        
        //given
        $client = new Client();
        $client->setName('Okok 1');
        
        $contact1 = new Contact();
        $contact1->setDecription('Opis okok1');
        $client->addContact($contact1);
        
        
        $contact2 = new Contact();
        $contact2->setDecription('Opis okok2');
        $client->addContact($contact2);

        $client = $this->getClientDaoImpl()->createClient($client);
        
        $findClient = $this->getClientDaoImpl()->find($client->getId());
        
        //when
        $findClient->removeContact($contact1);
        $updateClient = $this->getClientDaoImpl()->updateClient($findClient);
        
        //then
        $findClient = $this->getClientDaoImpl()->find($updateClient->getId());
        $this->assertEquals($findClient->getContacts()->toArray(),  array(1=>$contact2));
    
        //clean
        $this->clearTableContact();
        $this->clearTableUser();
    }
    
    public function testDeleteUser(){
        //clean
        $this->clearTableContact();
        $this->clearTableUser();
        
        //given
        $client = new Client();
        $client->setName('Okok'.__METHOD__);
        
        $contact1 = new Contact();
        $contact1->setDecription('Contact Description ' . __METHOD__);
        
        $client->addContact($contact1);
        
        //when
        $clientExpected = $this->getClientDaoImpl()->deleteClient($client);
        
        //then
        $this->assertEquals($clientExpected->getContacts()->toArray(), array(0=>$contact1));
        $this->assertNull($clientExpected->getId());
    }
    
    private function clearTableUser(){
        $conn = $this->em->getConnection();
        $result = $conn->query("DELETE FROM client");
    }
    
    private function clearTableContact(){
        $conn = $this->em->getConnection();
        $result = $conn->query("DELETE FROM contact");
    }
}