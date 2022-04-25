<?php

namespace App\Repository;

use App\Entity\Salesperson;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Customer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Customer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Customer[]    findAll()
 * @method Customer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SalespersonRepository extends ServiceEntityRepository
{
	private $manager;

	public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
	{
		parent::__construct($registry, Salesperson::class);
		$this->manager = $manager;
	}
}    