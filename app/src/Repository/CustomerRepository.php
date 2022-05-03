<?php

namespace App\Repository;

use App\Entity\Customer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Customer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Customer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Customer[]    findAll()
 * @method Customer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerRepository extends ServiceEntityRepository
{
	private $manager;

	public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
	{
		parent::__construct($registry, Customer::class);
		$this->manager = $manager;
	}

	public function removeCustomer(Customer $customer)
	{
		$this->manager->remove($customer);
		$this->manager->flush();
	}

	public function addCustomer(Customer $customer)
	{
		$this->manager->persist($customer);
		$this->manager->flush();
	}

	public function updateCustomer(Customer $customer, array $data)
	{
		$customer
			->setSociety($data['Society'])
			->setIdsalesperson($data['IdSalesperson'])
			->setCredit($data['Credit']);

		$this->manager->flush();
	}

	/**
	 * Get the value of manager
	 */ 
	public function getManager()
	{
		return $this->manager;
	}

	/**
	 * Set the value of manager
	 *
	 * @return  self
	 */ 
	public function setManager($manager)
	{
		$this->manager = $manager;

		return $this;
	}
}