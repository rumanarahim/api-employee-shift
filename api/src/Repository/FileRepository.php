<?php

namespace App\Repository;

use App\Entity\Employee;
use App\Entity\Role;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class FileRepository
 * @package App\Repository
 *
 * @method File|null find(int $id)
 */

class FileRepository extends ServiceEntityRepository
{

    /**
     * RoleRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Role::class);
    }
}
