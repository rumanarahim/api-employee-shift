<?php

namespace App\Repository;

use App\Entity\Area;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class AreaRepository
 * @package App\Repository
 *
 * @method Area|null find(int $id)
 */

class AreaRepository extends ServiceEntityRepository
{

    /**
     * EmployeeRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Area::class);
    }
}
