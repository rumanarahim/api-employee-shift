<?php

namespace App\Repository;

use App\Entity\Employee;
use App\Entity\Role;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class ShiftRepository
 * @package App\Repository
 *
 * @method Shift|null find(int $id)
 */

class ShiftRepository extends ServiceEntityRepository
{

    /**
     * RoleRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Shift::class);
    }
}
